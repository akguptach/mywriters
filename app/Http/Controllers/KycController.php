<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Tutor;
use App\Models\Kyc;
use App\Models\Bank;
use Illuminate\Support\Facades\Validator;

class KycController extends Controller
{
    public function index(){
        $tutor_id           =   Auth::id();
        $bank               =   Bank::where('tutor_id',$tutor_id)->first();
        if(empty($bank)){
            //return redirect('bank');     
            //exit;
        }
        $data['kyc']       =   Kyc::where('tutor_id',$tutor_id)->first();
        return view('tutor/kyc',$data);
    }
    public function store(Request $request){
        $tutor_id            =   Auth::id();
        $validator = Validator::make($request->all(), [
            'id_proof' => 'max:2048',
            'address_proof' => 'max:2048',

        ]);
        if($validator->fails()){
            return redirect('kyc')->withErrors($validator)->withInput();     
        }
        if(!empty($request->id_proof) || !empty($request->address_proof) ){
            $check      = Kyc::where('tutor_id',$tutor_id)->first();
            if(!empty($check)){
                $kyc    = Kyc::where('tutor_id',$tutor_id)->first();
            }
            else{
                $kyc    = new Kyc();
            }
            $kyc->tutor_id          = $tutor_id;
            if(!empty($request->id_proof)){
                $this->remove_img($kyc->id_proof);
                $image              =   $request->file('id_proof');
                $imageUrl           =   $this->upload_img('id_proof',$image);
                $kyc->id_proof      =   $imageUrl;
            }
            if(!empty($request->address_proof)){
                $this->remove_img($kyc->address_proof);
                $image              =   $request->file('address_proof');
                $imageUrl           =   $this->upload_img('address_proof',$image);
                $kyc->address_proof =   $imageUrl;
            }
            $kyc->save();
        }
        $tutor_pro                      = Tutor::find($tutor_id);
        $tutor_pro->profile_status      = 'approved';
        $tutor_pro->save();
        //return redirect('dashboard')->with('status', 'KYC updated successfully');
        return redirect()->back()->with('status', 'KYC updated successfully');
    }
    private function remove_img($proof){
        if(!empty($proof) && file_exists(public_path($proof))){
            unlink(public_path($proof));
        }
        return true;
    }
    private function upload_img($folder,$image){
        $imageName          =   time().'.'.$image->extension();
        $image->move(public_path('images/'.$folder), $imageName);
        $imageUrl           =   'images/'.$folder.'/'.$imageName;
        return $imageUrl;
    }
}
