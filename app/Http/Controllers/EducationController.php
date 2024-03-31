<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Education;
use Illuminate\Support\Facades\Validator;
use App\Models\AddressModel as Address;
use App\Models\AdditionalEducationModel as AdditionalEducation;

class EducationController extends Controller
{
    public function index(){
        $tutor_id               =   Auth::id();
        $address                =   Address::where('tutor_id',$tutor_id)->first();
        if(empty($address)){
            return redirect('address');     
            exit;
        }
        $data['education']                  =   Education::where('tutor_id',$tutor_id)->first();
        $data['additional_educations']      =   AdditionalEducation::where('tutor_id',$tutor_id)->get();
        return view('tutor/education',$data);
    }
    public function store(Request $request){
        $tutor_id            =   Auth::id();
        $validator = Validator::make($request->all(), [
            'highest_education' => 'required|min:2',
            'university' => 'required|min:2',
            'year' => 'required|min:2',
            'proof' => 'max:2048',

        ]);
        if($validator->fails()){
            return redirect('education')->withErrors($validator)->withInput();     
        }
        $check                          = Education::where('tutor_id',$tutor_id)->first();
        if(!empty($check)){
            $education                  = Education::where('tutor_id',$tutor_id)->first();
        }
        else{
            $education                  = new Education();
        }
        $education->highest_education   = $request->highest_education;
        $education->tutor_id            = $tutor_id;
        $education->university          = $request->university;
        $education->year                = $request->year;
        if(!empty($request->proof)){
            $this->remove_img($education->proof);
            $image              =   $request->file('proof');
            $imageUrl           =   $this->upload_img($image);
            $education->proof   =   $imageUrl;
        }
        $education->save();
        AdditionalEducation::where('tutor_id', $tutor_id)->delete();
        if(!empty($request->addional_education)){
            foreach($request->addional_education as $additional1){
                $additional_education                   = new AdditionalEducation();
                $additional_education->education_name   = $additional1;
                $additional_education->tutor_id         = $tutor_id;       
                $additional_education->save();
            }
        }
        return redirect('bank')->with('status', 'Education updated successfully');
    }
    private function remove_img($proof){
        if(!empty($proof) && file_exists(public_path($proof))){
            unlink(public_path($proof));
        }
        return true;
    }
    private function upload_img($image){
        $imageName          =   time().'.'.$image->extension();
        $image->move(public_path('images/proof'), $imageName);
        $imageUrl           =   'images/proof/'.$imageName;
        return $imageUrl;
    }
}
