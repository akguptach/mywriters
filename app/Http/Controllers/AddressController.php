<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\AddressModel as Address;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index(){
        $tutor_id           =   Auth::id();
        $data['address']    =   Address::where('tutor_id',$tutor_id)->first();
        return view('tutor/address',$data);
    }
    public function store(Request $request){
        $tutor_id            =   Auth::id();
        $validator = Validator::make($request->all(), [
            'country' => 'required|min:2',
            'state' => 'required|min:2',
            'city' => 'required|min:2',
            'zip_code' => 'required|min:2',
        ]);
        if($validator->fails()){
            return redirect('address')->withErrors($validator)->withInput();     
        }
        $check                      = Address::where('tutor_id',$tutor_id)->first();
        if(!empty($check)){
            $address               = Address::where('tutor_id',$tutor_id)->first();
        }
        else{
            $address               = new Address();
        }
        $address->tutor_id         = $tutor_id;
        $address->country          = $request->country;
        $address->state            = $request->state;
        $address->city             = $request->city;
        $address->zip_code         = $request->zip_code;
        $address->save();
        return redirect('education')->with('status', 'Address updated successfully');
    }
}
