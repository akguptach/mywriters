<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\TutorSubject;
use App\Models\Tutor;
use App\Models\PasswordResetModel as PasswordReset;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Password;


class SignupController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('signup', array('subjects' => $subjects));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tutor_first_name' => 'required|min:2',
            'tutor_last_name' => 'required|min:2',
            'tutor_email' => 'required|unique:tutor,tutor_email',
            'tutor_contact_no' => 'required|unique:tutor,tutor_contact_no',
            'tutor_subject' => 'required',
            'password' => 'required|min:5',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        $tutor = new Tutor();
        $tutor->tutor_first_name = $request->tutor_first_name;
        $tutor->tutor_last_name = $request->tutor_last_name;
        $tutor->tutor_email = $request->tutor_email;
        $tutor->tutor_contact_no = $request->tutor_contact_no;
        //$tutor->tutor_subject = $request->tutor_subject;
        $tutor->status = 'inactive';
        $tutor->password = Hash::make($request->password);
        $tutor->save();
        foreach ($request->tutor_subject as $subject) {
            TutorSubject::Create([
                'tutor_id' => $tutor->id,
                'subject_id' => $subject
            ]);
        }
        $token = Auth::attempt(['tutor_email' => $request->input('tutor_email'), 'password' => $request->input('password')]);
        session()->flash('success', 'Tutor details added successfully.');

        return $this->sendResponse([], 'Tutor details added successfully.');
    }
    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tutor_email' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        $check_tutor    =   Tutor::where('tutor_email', $request->tutor_email)->first();
        if (empty($check_tutor)) {
            return $this->sendError('Validation Error.', trans('User does not exist'), 422);
        }
        $password_reset = new PasswordReset();
        $password_reset->email = $request->tutor_email;
        $password_reset->token = sha1(time());
        $password_reset->created_at = Carbon::now();
        $password_reset->save();
        $tokenData = PasswordReset::where('email', $request->tutor_email)->first();
        if ($this->sendResetEmail($request->tutor_email, $tokenData->token)) {
            session()->flash('success', trans('A reset link has been sent to your email address.'));
        } else {
            return $this->sendError('Validation Error.', trans('User does not exist'), 422);
        }
    }
    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $array_data['email'] = $email;
        $user = Tutor::where('tutor_email', $email)->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->tutor_email);
        try {
            $status = Password::sendResetLink(
                $array_data
            );

            exit;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
