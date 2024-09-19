<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\TutorSubject;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderAssign;
use App\Models\OrderRequest;
use App\Models\QcAssign;
use Carbon\Carbon;
use App\Models\Notification;

class AccountinfoController extends Controller
{
    public function dashboard(){
        $tutor_id    =   Auth::id();
        $tutors     =   Tutor::find($tutor_id);
        if(!empty($tutors->profile_status)){
            if($tutors->profile_status == 'incompelte'){
                return redirect('account_info');     
                exit;
            }
        }


        $currentMonthTutorOrders = OrderAssign::where('tutor_id', $tutor_id)
        ->whereBetween('created_at', 
        [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ])
        ->where('status', 'PENDING')
        ->count();

        $currentMonthQcOrders = QcAssign::addSelect(['id'])
        ->whereBetween('created_at', 
        [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ])
        ->with(['order'])->where('qc_id', $tutor_id)
        ->where('status', 'PENDING')
        ->count();

        $currentMonthPendingCount = $currentMonthTutorOrders+$currentMonthQcOrders;

        ///


        $currentMonthTutorOrders = OrderAssign::where('tutor_id', $tutor_id)
        ->whereBetween('created_at', 
        [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ])
        ->where('status', 'COMPLETED')
        ->count();

        $currentMonthQcOrders = QcAssign::addSelect(['id'])
        ->whereBetween('created_at', 
        [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ])
        ->with(['order'])->where('qc_id', $tutor_id)
        ->where('status', 'COMPLETED')
        ->count();

        $currentMonthtotalCount = $currentMonthTutorOrders+$currentMonthQcOrders;



        $currentMonthTutorOrders = OrderAssign::where('tutor_id', $tutor_id)
        ->whereBetween('created_at', 
        [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ])
        ->where('status', 'COMPLETED')
        ->sum('tutor_price');

        $currentMonthQcOrders = QcAssign::addSelect(['id'])
        ->whereBetween('created_at', 
        [
            Carbon::now()->startOfMonth(), 
            Carbon::now()->endOfMonth()
        ])
        ->with(['order'])->where('qc_id', $tutor_id)
        ->where('status', 'COMPLETED')
        ->sum('qc_price');

        $currentMonthtotalEarning = $currentMonthTutorOrders+$currentMonthQcOrders;
        $data['currentMonthtotalEarning'] = $currentMonthtotalEarning;
        $tutorOrders = OrderAssign::where('tutor_id', $tutor_id)->where('status', 'COMPLETED')->sum('tutor_price');
        $qcOrders = QcAssign::addSelect(['id'])->with(['order'])->where('qc_id', $tutor_id)->where('status', 'COMPLETED')->sum('qc_price');
        $totalEarning = $tutorOrders+$qcOrders;



        $tutorOrdersPending = OrderAssign::where('tutor_id', $tutor_id)
        ->where('status', 'PENDING')
        ->count();
        
        $qcOrdersPending = QcAssign::addSelect(['id'])->with(['order'])
        ->where('qc_id', $tutor_id)->where('status', 'PENDING')
        ->count();
        $inprocess = $tutorOrdersPending+$qcOrdersPending;



        $tutorOrdersCompleted = OrderAssign::where('tutor_id', $tutor_id)
        ->where('status', 'COMPLETED')
        ->count();
        
        $qcOrdersCompleted = QcAssign::addSelect(['id'])->with(['order'])
        ->where('qc_id', $tutor_id)->where('status', 'COMPLETED')
        ->count();
        $completed = $tutorOrdersCompleted+$qcOrdersCompleted;



        $newOrderRequests = OrderRequest::doesntHave('order.teacherAssigned')->doesntHave('order.qcAssigned')
        ->where('tutor_id', $tutor_id)
        ->whereNot('status', 'REJECTED')
        ->where('type', 'TUTOR')
        ->count();

        $data['notifications'] = Notification::orderBy('created_at', 'desc')
        ->where('receivertable_type','App\Models\Tutor')
        ->where('receivertable_id',AUTH::user()->id)->count();

        $data['newOrderRequests'] = $newOrderRequests;
        $data['completed'] = $completed;
        $data['inprocess'] = $inprocess;
        $data['total_earning'] = $totalEarning;
        $data['currentMonthtotalCount'] = $currentMonthtotalCount;
        $data['currentMonthPendingCount'] = $currentMonthPendingCount;

        
        
        return view('dashboard',$data);

    }
    public function index(){
        $tuto_id            =   Auth::id();
        $data['subjects']   =   Subject::all();
        $data['tutors']     =   Tutor::find($tuto_id);
        //echo "<pre>"; print_r($data['tutors']);die;
        return view('tutor/account_info',$data);
    }
    public function store(Request $request){

        //echo "<pre>"; print_r($request->all()); die;
        $tuto_id            =   Auth::id();
        $validator = Validator::make($request->all(), [
            'tutor_first_name' => 'required|min:2',
            'tutor_last_name' => 'required|min:2',
            'tutor_email' => 'required|email|unique:tutor,tutor_email,'.$tuto_id,
            'tutor_contact_no' => 'required|numeric|unique:tutor,tutor_contact_no,'.$tuto_id,
            'tutor_subject' => 'required',
        ]);
        if($validator->fails()){
            return redirect('account_info')->withErrors($validator)->withInput();     
        }
        $tutor                      = Tutor::find($tuto_id);
        $tutor->tutor_first_name    = $request->tutor_first_name;
        $tutor->tutor_last_name     = $request->tutor_last_name;
        $tutor->tutor_email         = $request->tutor_email;
        $tutor->tutor_contact_no    = $request->country_code.$request->tutor_contact_no;

        //$tutor->tutor_subject       = $request->tutor_subject;
        $tutor->save();

        TutorSubject::where('tutor_id',$tutor->id)->delete();
        foreach ($request->tutor_subject as $subject) {
            TutorSubject::Create([
                'tutor_id' => $tutor->id,
                'subject_id' => $subject
            ]);
        }

        return redirect()->back()->with('status', 'Account information updated successfully');
    } 
}
