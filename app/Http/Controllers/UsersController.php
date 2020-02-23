<?php

namespace App\Http\Controllers;

use App\Club;
use App\ClubUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $clubs= ClubUsers::where(
            'user_id', $id
        )->get();
        $clbs= array();
        foreach ($clubs as $club){
            $cc= Club::find($club['club_id']);
            array_push($clbs,$cc);
        }
        $user =User::find($id);
        return view('profile.index', compact('user','clbs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all());
        $user = User::findOrFail($id);
        $request['password'] = bcrypt($request['password']);
        $user->update($request->all());
        return view('profile.edit', compact('user'));

    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:25',
            'surname' => 'required|string|max:25',
            'gender' => 'required|string|max:25|min:4',
            'birthDate' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'confirmed',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function pass($id){
        $done=false;

        $error=array();
        $user= Auth::user();
        return view('profile.pasedit',compact('user','id','error','done'));
    }

    public function changePass(Request $request,$id){
        $error=array();
        $done=false;
        $user= Auth::user();
        if(Auth::Check())
        {
            $request_data = $request->All();
            $validator = $this->checkPass($request_data);
            if($validator->fails())
            {
                $error=array($validator->getMessageBag()->toArray());
                return view('profile.pasedit',compact('error','user','done'));
            }
            else
            {
                $current_password = Auth::User()->password;
                if(Hash::check($request_data['currpass'], $current_password))
                {
                    $user_id = Auth::User()->id;
                    $obj_user = User::find($user_id);
                    $obj_user->password = Hash::make($request_data['password']);;
                    $obj_user->save();
                    $done=true;
                    return view('profile.pasedit',compact('error','user','done'));;
                }
                else
                {
                    $error = array('currpass' => 'Please enter correct current password');
                    return view('profile.pasedit',compact('error','user','done'));
                }
            }
        }
        else
        {
            return redirect()->to('login');
        }
    }

    public function checkPass(array $data)
    {
        $messages = [
            'currpass.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'currpass' => 'required|min:6',
            'password' => 'required|same:password|min:6',
            'password_confirmation' => 'required|same:password|min:6',
        ], $messages);

        return $validator;
    }
}
