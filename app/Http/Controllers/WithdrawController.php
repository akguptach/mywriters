<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\OrderAssign;
use App\Models\QcAssign;
use DataTables;
use App\Models\Bank;
use App\Models\TutorWithdrawal;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WithdrawaAmountRequest;
class WithdrawController extends Controller
{

    public function withdraw(){
        $tutorOrders = OrderAssign::where('tutor_id', Auth::user()->id)->where('status', 'COMPLETED')->sum('tutor_price');
            $qcOrders = QcAssign::addSelect(['id'])->with(['order'])->where('qc_id', Auth::user()->id)->where('status', 'COMPLETED')->sum('qc_price');
            $totalEarning = $tutorOrders+$qcOrders;

            $totalWithdrawal = TutorWithdrawal::where('tutor_id', Auth::user()->id)
            ->where('status','COMPLETED')
            ->sum('amount');
            $balance = $totalEarning-$totalWithdrawal;
        return view('withdraw/withdraw',compact('balance'));
    }

    public function withdrawaAmount(WithdrawaAmountRequest $request)
    {
        try{

            
            

            $paymentMethod = Bank::where('tutor_id', Auth::user()->id)->first();
            if(!$paymentMethod){
                return redirect()->back()->withInput($request->all())
                ->with('error', 'Please add a payment method first');
            }

            $pending = TutorWithdrawal::where('tutor_id', Auth::user()->id)
            ->where('status','PENDING')
            ->first();
            if($pending){
                return redirect()->back()->withInput($request->all())
                ->with('error', 'Your last withdraw request is pending');
            }


            $tutorOrders = OrderAssign::where('tutor_id', Auth::user()->id)->where('status', 'COMPLETED')->sum('tutor_price');
            $qcOrders = QcAssign::addSelect(['id'])->with(['order'])->where('qc_id', Auth::user()->id)->where('status', 'COMPLETED')->sum('qc_price');
            $totalEarning = $tutorOrders+$qcOrders;

            $totalWithdrawal = TutorWithdrawal::where('tutor_id', Auth::user()->id)
            ->where('status','COMPLETED')
            ->sum('amount');
            $balance = $totalEarning-$totalWithdrawal;
            

            if($balance == 0){
                return redirect()->back()
                ->withInput($request->all())
                ->with('error', 'Your balance is £'.$balance);
            }

            if($balance < $request->amount){
                return redirect()->back()
                ->withInput($request->all())
                ->with('error', 'You can not withdraw more than £'.$balance);
            }

            TutorWithdrawal::Create([
                'tutor_id'=>Auth::user()->id,
                'amount'=>$request->amount,
                'balance'=>(float) $balance
            ]);
            return redirect()->back()->with('success', 'Your withdrawal request has been sent successfully!');
        }catch(\Exception $e){
            return redirect()->back()
            ->withInput($request->all())
            ->with('error', $e->getMessage());
        }
        
    }

    public function withdrawHistory()
    {

        if (isset($_GET) && !empty($_GET['columns'])) {
            $studentWithdrawal = TutorWithdrawal::where('tutor_id', Auth::user()->id)->orderBy('id', 'desc');
            return DataTables::eloquent($studentWithdrawal)
            ->addIndexColumn()
            ->addColumn('created_at', function($row) {
                return \Carbon\Carbon::parse($row->created_at)->format('d/m/Y');
            })

            ->addColumn('amount', function($row) {
                return '£'.$row->amount;
            })

            ->addColumn('status', function($row) {
                if ($row->status == 'COMPLETED') {
                    return '<span class="badge bg-success" style="min-width: 80px;">Completed</span>';
                }else if ($row->status == 'DECLINED') {
                    return '<span class="badge bg-danger" style="min-width: 80px;">Declined</span>';
                }
                else {
                    return '<span class="badge bg-primary" style="min-width: 80px;">Pending</span>';
                } 
            })
            
            
            ->filterColumn('status', function($query, $keyword) {
                $query->where('status', $_GET['columns'][3]['search']['value']);
            })
            ->rawColumns(['status'])
            ->toJson();
        }else{
            return view('withdraw/history');
        }
    }


}