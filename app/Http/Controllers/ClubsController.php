<?php

namespace App\Http\Controllers;

use App\Club;
use App\ClubPost;
use App\ClubUsers;
use App\Follow;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        //
        $isFolowed= false;
        $isCmember = false;
        $clubusers=ClubUsers::where('club_id',$id)->get();
        $mainusers=array();
        $clubPosts=ClubPost::where('club_id',$id)->orderBy('created_at', 'desc')->simplePaginate(5);

        foreach ($clubusers as $user){
            $musr=User::find($user['user_id']);
            array_push($mainusers,$musr);
        }
        if (ClubUsers::where([
            'club_id'=> $id,
            'user_id'=> Auth::user()->id,
        ])->first()
        ) {
            $isCmember=true;
        } else {
            $isCmember=false;
        }
        if (Follow::where([
            'club_id'=> $id,
            'user_id'=> Auth::user()->id,
        ])->first()
        ) {
            $isFolowed=true;
        } else {
            $isFolowed=false;
        }
        $club= Club::findOrFail($id);
        $owner=User::findOrFail($club->user_id);
        return view('club.index',compact('club','isFolowed','isCmember','owner','mainusers','clubPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valDate = $this->validatorClub($request->all());
        $owns = ClubUsers::where(['user_id'=>$request['user_id']])->get();
        if (count($owns)>=3){
            $valDate->after(function ($validator) {
                $validator->errors()->add('name', 'You are already part of 3 (max) clubs!');
            }
            );
            $valDate->validate();
        }else{
            $valDate->validate();
            $clb= Club::create($request->all());
            $clbid=$clb->id;
            $ss=true;

            ClubUsers::create(
                [
                    'user_id' => $request['user_id'],
                    'club_id' => $clb['id']
                ]
            );
            Follow::create(
                [
                    'user_id' => $request['user_id'],
                    'club_id' => $clb['id']
                ]
            );
            return redirect('club/'.$clbid);

        }
    }
    public function validatorClub(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:20|unique:clubs'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {


    }
    public function showcclub()
    {
        return view('club.create');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public static function edit($id)
    {
        $nameexist=false;

        $exist=false;
        $isMember=false;
        $isFree=false;
        $clubusers=ClubUsers::where('club_id',$id)->get();
        $mainusers=array();
        foreach ($clubusers as $user){
            $musr=User::find($user['user_id']);
            array_push($mainusers,$musr);
        }
        $club= Club::findOrFail($id);
        $owner=User::findOrFail($club->user_id);
        if (Auth::user()->id == $owner->id){
            return view('club.edit',compact('club','owner','nameexist','exist','isMember','mainusers','isFree'));
        }else
        {
           return redirect('club/'.$id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' =>'max:20|min:1',
            'coverpath' =>'image|mimes:jpg,png,jpeg|max:50',
            'logopath' =>'image|mimes:jpg,png,jpeg|max:50',

        ]);

        $nameexist=false;
        $exist=false;
        $ntfng=false;
        $isFree=false;
        $isMember = false;
        $club =Club::findOrFail($id);
        $clubusers=ClubUsers::where('club_id',$id)->get();
        $mainusers=array();
        $club= Club::findOrFail($id);
        $owner=User::findOrFail($club->user_id);
        foreach ($clubusers as $user){
            $musr=User::find($user['user_id']);
            array_push($mainusers,$musr);
        }

        $existClub= Club::where(
          'name', $request->name
        )->get();
        if (count($existClub)>0){
            $nameexist =true;
            return view('club.edit',compact('nameexist','club','owner','exist','isMember','mainusers','isFree'));

        }else{

            $club->update($request->all());

            if ($request->hasFile('coverpath')) {
                if($request->file('coverpath')->isValid()) {
                    $file = $request->file('coverpath');
                    $name = time() . '1.' . $file->getClientOriginalExtension();

                    $request->file('coverpath')->move("images", $name);
                    $club->update(['coverpath'=>$name]);
                }
            }
            if ($request->hasFile('logopath')) {
                if($request->file('logopath')->isValid()) {
                    $file = $request->file('logopath');
                    $name = time() . '2.' . $file->getClientOriginalExtension();

                    $request->file('logopath')->move("images", $name);
                    $club->update(['logopath'=>$name]);
                }
            }
            $club= Club::findOrFail($id);
            $owner=User::findOrFail($club->user_id);
            if (Auth::user()->id == $owner->id){
                return view('club.edit',compact('club','owner','nameexist','exist','isMember','mainusers','isFree'));
            }else
            {
                return redirect('club/'.$id);
            }
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        //
    }
}
