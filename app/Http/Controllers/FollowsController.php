<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {

        Follow::create(
            [
                'user_id' => Auth::user()->id,
                'club_id' => $id
            ]
        );
        return 'true';
    }

    public function isfollowing($id){
        if (Follow::where([
            'club_id'=> $id,
            'user_id'=> Auth::user()->id,
        ])->first()){
            return 'true';
        }
        else{
            return 'false';
        }
    }
    public function followCount($id){
        return count(Follow::where(['club_id'=>$id])->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flw= Follow::where(
            [
                'club_id' => $id,
                'user_id' =>Auth::user()->id
            ]
        );
        $flw->delete();
        return 'true';
    }
}
