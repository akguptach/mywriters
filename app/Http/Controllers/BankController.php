<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Bank;
use App\Models\Education;
use Illuminate\Support\Facades\Validator;
use App\Models\AddressModel as Address;

class BankController extends Controller
{
    public function index(){
        $tutor_id           =   Auth::id();
        $education          =   Education::where('tutor_id',$tutor_id)->first();
        if(empty($education)){
            //return redirect('education');     
            //exit;
        }
        $data['bank']       =   Bank::where('tutor_id',$tutor_id)->first();
        $data['address']    =   Address::where('tutor_id',$tutor_id)->first();
        return view('tutor/bank',$data);
    }
    public function store(Request $request){
        $tutor_id            =   Auth::id();

        /*echo "<pre>"; print_r($request->all()); die;
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|min:2|max:150',
            'account_no' => 'required|min:2|max:150',
            'branch' => 'required|min:2|max:150',
            'ifsc_code' => 'required|min:2|max:150',
        ]);
        if($validator->fails()){
            return redirect('bank')->withErrors($validator)->withInput();     
        }*/
        

        $check_bank = Bank::where('tutor_id',$tutor_id)->first();
        if(!empty($check_bank)){
            $bank               = Bank::where('tutor_id',$tutor_id)->first();
        }
        else{
            $bank               = new Bank();
        }

        $bank->ibn_number               = $request->ibn_number;
        $bank->account_holder_name      = $request->account_holder_name;
        $bank->short_code               = $request->short_code;

        $bank->bank_name        = $request->bank_name;
        $bank->account_no       = $request->account_no;
        $bank->tutor_id         = $tutor_id;
        $bank->branch           = $request->branch;
        $bank->ifsc_code        = $request->ifsc_code;
        $bank->save();

        
        $addressObj = Address::where('tutor_id',$tutor_id)->first();
        if(!$addressObj){
            $addressObj               = new Address();
        }
        
        $addressObj->tutor_id         = $tutor_id;
        $addressObj->country          = $request->country;
        $addressObj->state            = $request->state;
        $addressObj->city             = $request->city;
        $addressObj->zip_code         = $request->zip_code;
        $addressObj->save();
        return redirect('kyc')->with('status', 'Bank details updated successfully');
    }
}
