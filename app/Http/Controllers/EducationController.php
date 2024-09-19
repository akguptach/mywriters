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
            //return redirect('address');     
            //exit;
        }
        $data['education']                  =   Education::where('tutor_id',$tutor_id)->first();
        $data['additional_educations']      =   AdditionalEducation::where('tutor_id',$tutor_id)->get();
        return view('tutor/education',$data);
    }


    public function fileUpload(Request $request, $id){

        try{
            $education                          = Education::where('tutor_id',$id)->first();
            if(!$education){
                $education                  = new Education();
            }
            if(!empty($request->file)){
                $this->remove_img($education->file);
                $image              =   $request->file('file');
                $imageUrl           =   $this->upload_img($image,$request->name.$id);
                $education->tutor_id   =   $id;
                if($request->name == 'cv_file')
                $education->cv_file   =   $imageUrl;
                else if($request->name == 'proof')
                $education->proof   =   $imageUrl;
                else if($request->name == 'graduation_degree')
                $education->graduation_degree   =   $imageUrl;
                else if($request->name == 'samples_of_previous_work')
                $education->samples_of_previous_work   =   $imageUrl;





            }
            $education->save();
            return response(['url'=>$imageUrl,'msg'=>'File uploaded successfully']);
        }
        catch(\Exception $e){
            return response(['url'=>'','msg'=>'There is an error']);
        }
    }

    public function store(Request $request){
        $tutor_id            =   Auth::id();
        //echo $tutor_id; die;
        //echo "<pre>"; print_r($request->all()); die;
        /*$validator = Validator::make($request->all(), [
            'highest_education' => 'required|min:2',
            'university' => 'required|min:2',
            'year' => 'required|min:2',
            'proof' => 'max:2048',

        ]);
        if($validator->fails()){
            return redirect('education')->withErrors($validator)->withInput();     
        }*/
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


        $education->linkedin_url                = $request->linkedin_url;
        $education->score                = $request->score;
        $education->years_of_experience                = $request->years_of_experience;
        $education->tasks_can_handle_in_month                = $request->tasks_can_handle_in_month;
        $education->turnaround_time                = $request->turnaround_time;
        $education->charges                = $request->charges;


        $education->know_how_to_write_essays                = $request->know_how_to_write_essays;
        $education->familiar_with_plagiarism                = $request->familiar_with_plagiarism;
        $education->comfortable_with_tight_deadlines                = $request->comfortable_with_tight_deadlines;
        $education->provide_revisions                = $request->provide_revisions;
        $education->offer_refund                = $request->offer_refund;


        $education->anything_else                = $request->anything_else;


        
        

        if(!empty($request->proof)){
            $this->remove_img($education->proof);
            $image              =   $request->file('proof');
            $imageUrl           =   $this->upload_img($image,'proof_'.$tutor_id);
            $education->proof   =   $imageUrl;
        }


        if(!empty($request->cv_file)){
            $this->remove_img($education->cv_file);
            $image              =   $request->file('cv_file');
            $imageUrl           =   $this->upload_img($image,'cv_file_'.$tutor_id);
            $education->cv_file   =   $imageUrl;
        }


        if(!empty($request->samples_of_previous_work)){
            $this->remove_img($education->samples_of_previous_work);
            $image              =   $request->file('samples_of_previous_work');
            $imageUrl           =   $this->upload_img($image,'samples_of_previous_work_'.$tutor_id);
            $education->samples_of_previous_work   =   $imageUrl;
        }

        if(!empty($request->graduation_degree)){
            $this->remove_img($education->graduation_degree);
            $image              =   $request->file('graduation_degree');
            $imageUrl           =   $this->upload_img($image,'graduation_degree_'.$tutor_id);
            $education->graduation_degree   =   $imageUrl;
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
        return redirect()->back()->with('status', 'Education updated successfully');
        // if(Auth::user()->status == 'active')
        //     return redirect('bank')->with('status', 'Education updated successfully');
        // else
        // return redirect('dashboard')->with('status', 'Education updated successfully');
    }
    private function remove_img($proof){
        try{
            if(!empty($proof) && file_exists(public_path($proof))){
                unlink(public_path($proof));
            }
        }catch(\Exception $e){

        }
        return true;
    }
    // private function upload_img($image){
    //     $imageName          =   time().'.'.$image->extension();
    //     $image->move(public_path('images/proof'), $imageName);
    //     $imageUrl           =   'images/proof/'.$imageName;
    //     return $imageUrl;
    // }

    private function upload_img($image,$uniqueName=''){

        try{
            if ($image == null) {
                // Log or handle the error appropriately
                error_log('No file uploaded.');
                return null;
            }
        
            $imageName = $uniqueName.time().'.'.$image->extension();
            $image->move(public_path('images/proof'), $imageName);
            $imageUrl = 'images/proof/'.$imageName;
            return $imageUrl;
        }catch(\Exception $e){
            
            return '';
        }
    }
}