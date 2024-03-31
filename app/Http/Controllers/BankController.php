<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Bank;
use App\Models\Education;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function index(){
        $tutor_id           =   Auth::id();
        $education          =   Education::where('tutor_id',$tutor_id)->first();
        if(empty($education)){
            return redirect('education');     
            exit;
        }
        $data['bank']       =   Bank::where('tutor_id',$tutor_id)->first();
        return view('tutor/bank',$data);
    }
    public function store(Request $request){
        $tutor_id            =   Auth::id();
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|min:2|max:150',
            'account_no' => 'required|min:2|max:150',
            'branch' => 'required|min:2|max:150',
            'ifsc_code' => 'required|min:2|max:150',
        ]);
        if($validator->fails()){
            return redirect('bank')->withErrors($validator)->withInput();     
        }
        $check_bank = Bank::where('tutor_id',$tutor_id)->first();
        if(!empty($check_bank)){
            $bank               = Bank::where('tutor_id',$tutor_id)->first();
        }
        else{
            $bank               = new Bank();
        }
        $bank->bank_name        = $request->bank_name;
        $bank->account_no       = $request->account_no;
        $bank->tutor_id         = $tutor_id;
        $bank->branch           = $request->branch;
        $bank->ifsc_code        = $request->ifsc_code;
        $bank->save();
        return redirect('kyc')->with('status', 'Bank details updated successfully');
    }
}
