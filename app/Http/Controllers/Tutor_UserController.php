<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Tutor_user;
use Illuminate\Support\Facades\Auth;

class Tutor_UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $user = Auth::user();
        if($user->status != 'active')
        {
            return redirect('account_info');     
        }
        $tutor_id = Auth::id();
        if(isset($_GET) && !empty($_GET['columns'])){
            $req_record['data'] = array();
            $query = Tutor_user::query();
            $searchValue = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

            if(!empty($searchValue)){
                $query->where(function ($subquery) use ($searchValue) {
                    $subquery->orwhere('first_name', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchValue . '%');
                });
            }
            $query->where('tutor_id',$tutor_id);
            $query->orderBy('id', 'desc');
            $req_record['data'] = $query->skip($_GET['start'])->take($_GET['length'])->get()->toArray();
            $users = $query->get()->toArray();
            if(!empty($users))
			    $req_record['recordsFiltered'] = $req_record['recordsTotal'] = count($users);
		    else
                $req_record['recordsFiltered'] = $req_record['recordsTotal'] = 0;
            $del_msg = '"'.'Are you want to delete?'.'"';
            $i = 0;
            if(!empty($req_record['data'])){
                foreach($req_record['data'] as $user){
                    $edit_page = 'tutor_user/'.$user['id'].'/edit';
                    $del_page = route('tutor_user.destroy', ['tutor_user' => $user['id']]);
                    
                    $req_user_id = '"'.$user['id'].'"';
                    
                    $req_record['data'][$i]['action'] = "<a href='".url($edit_page)."' ><i class='mdi mdi-grease-pencil' title='Edit'></i></a>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='delete_user(".$del_msg.",".$req_user_id.")' ><i class='mdi mdi-delete'  title='Delete'></i></a><form method='POST' action=' ".$del_page." ' class='form-delete' style='display: none;' id='user_form_".$user['id']."'>
                        <input type='hidden' value='".csrf_token() ."'  id='csrf_".$user['id']."'>
                    </form>";
                    $i++;
                }
            }
            echo json_encode($req_record);
        }
        else{
            return view('user/list');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tutor_id = Auth::id();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:150|min:2',
            'last_name' => 'required|max:150|min:2',
            'email' => 'required|email|unique:tutor_user,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|min:5',
        ]);
        if($validator->fails()){
            return redirect('tutor_user/create')->withErrors($validator)->withInput();     
        }
        $user                      = new Tutor_user();
        $user->first_name          = $request->first_name;
        $user->last_name           = $request->last_name;
        $user->tutor_id            = $tutor_id;
        $user->email               = $request->email;
        $user->password            = bcrypt($request->password);
        $user->save();
        return redirect('/tutor_user')->with('status', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datas = Tutor_user::find($id);
        return view('user/edit',array('formAction' => route('tutor_user.update', ['tutor_user' => $id]),'data'=>$datas));
        return view('user/edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:150|min:2',
            'last_name' => 'required|max:150|min:2',
            'email' => 'required|email|unique:tutor_user,email,'.$id,
        ]);
        if($validator->fails()){
            return redirect('tutor_user/'.$id.'/edit')->withErrors($validator)->withInput();     
        }
        $tutor_id = Auth::id();
        $user                      = Tutor_user::find($id);
        $user->first_name          = $request->first_name;
        $user->last_name           = $request->last_name;
        $user->email               = $request->email;
        $user->tutor_id            = $tutor_id;
        if(!empty($request->password))
            $user->password        = bcrypt($request->password);
        $user->save();
        return redirect('/tutor_user')->with('status', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Tutor_user::find($id);
        if(!empty($user)){
            $user->delete();
            return redirect('/tutor_user')->with('status', 'User deleted successfully');
        }
        else{
            return redirect('/tutor_user');
        }
    }
}
