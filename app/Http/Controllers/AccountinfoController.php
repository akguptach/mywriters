<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Tutor;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

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
        return view('dashboard');

    }
    public function index(){
        $tuto_id            =   Auth::id();
        $data['subjects']   =   Subject::all();
        $data['tutors']     =   Tutor::find($tuto_id);
        return view('tutor/account_info',$data);
    }
    public function store(Request $request){
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
        $tutor->tutor_contact_no    = $request->tutor_contact_no;
        $tutor->tutor_subject       = $request->tutor_subject;
        $tutor->save();
        return redirect('address')->with('status', 'Account information updated successfully');
    }
}
