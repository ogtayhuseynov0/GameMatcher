<?php

namespace App\Http\Controllers;

use App\Club;
use App\ClubUsers;
use App\Follow;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClubUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $nameexist=false;
        $user = User::find($request['user_id']);
        $isMember = false;
        $isFree = false;
        $mainusers = array();
        $exist = false;
        $owns = ClubUsers::where(['user_id'=>$request['user_id']])->get();

        if (count($owns)>=3){
            $valDate=Validator::make([],[]);
            $valDate->after(function ($validator) {
                $validator->errors()->add('user_id', 'User is already part of 3 (max) clubs!');
            }
            );
            $valDate->validate();
        }
        $clubusers = ClubUsers::where('club_id', $request['club_id'])->get();
        foreach ($clubusers as $user2) {
            $musr = User::find($user2['user_id']);
            array_push($mainusers, $musr);
        }
        if ($user==null) {
            $exist = true;
            $club = Club::findOrFail($id);
            $owner = User::findOrFail($club->user_id);
            return view('club.edit', compact('club', 'nameexist','owner', 'exist', 'isMember', 'mainusers', 'isFree'));
        } else {
            if (count($clubusers) == 11) {
                $isFree = true;
                $ntfng = true;
                $club = Club::findOrFail($id);
                $owner = User::findOrFail($club->user_id);
                return view('club.edit', compact('club', 'nameexist','isFree', 'owner', 'exist', 'isMember', 'mainusers'));

            } else {

                if (ClubUsers::where([
                    ['club_id', $request['club_id']],
                    ['user_id', $request['user_id']],
                ])->first()
                ) {
                    $isMember =true;
                    $club = Club::findOrFail($id);
                    $owner = User::findOrFail($club->user_id);
                    return view('club.edit', compact('club', 'nameexist','owner', 'exist', 'isMember', 'mainusers', 'isFree'));
                } else {
                    ClubUsers::create($request->all(['user_id', 'club_id']));
                    Follow::create(
                        $request->all(['user_id', 'club_id'])
                    );
                    $mainusers = array();
                    $clubusers = ClubUsers::where('club_id', $request['club_id'])->get();
                    foreach ($clubusers as $user) {
                        $musr = User::find($user['user_id']);
                        array_push($mainusers, $musr);
                    }
                    $club = Club::findOrFail($id);
                    $owner = User::findOrFail($club->user_id);
                    return view('club.edit', compact('club', 'nameexist','owner', 'exist', 'isMember', 'mainusers', 'isFree'));
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClubUsers $clubUsers
     * @return \Illuminate\Http\Response
     */
    public function show(ClubUsers $clubUsers)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClubUsers $clubUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(ClubUsers $clubUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\ClubUsers $clubUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClubUsers $clubUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClubUsers $clubUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id2)
    {
        $nameexist=false;

        $club = Club::findOrFail($id);
        $owner = User::findOrFail($club->user_id);
        if (Auth::user()->id == $owner->id){
            $tmp = ClubUsers::where(
                [
                    'club_id' => $id,
                    'user_id' => $id2
                ]
            );
            $ds= Follow::where([
                'club_id' => $id,
                'user_id' => $id2
            ]);
            $ds->delete();
            $tmp->delete();
            $exist = false;
            $ntfng = false;
            $isFree = false;
            $isMember = false;

            $clubusers = ClubUsers::where('club_id', $id)->get();
            $mainusers = array();
            foreach ($clubusers as $user) {
                $musr = User::find($user['user_id']);
                array_push($mainusers, $musr);
            }
            if (Auth::user()->id == $owner->id) {
                return view('club.edit', compact('club','nameexist', 'owner', 'exist', 'isMember', 'mainusers', 'isFree'));
            } else {
                return redirect('club/' . $id);
            }
            return view('club.edit',compact('club','nameexist','owner','exist','ntfng','mainusers','isFree'));
        }else
        {
            return redirect('club/'.$id);
        }

    }
}
