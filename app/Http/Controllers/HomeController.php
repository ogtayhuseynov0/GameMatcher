<?php

namespace App\Http\Controllers;

use App\Club;
use App\ClubPost;
use App\ClubUsers;
use App\Follow;
use App\Match;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sarr=$this->suggest();
       $mclbs= ClubUsers::where(
            [
                'user_id'=>Auth::user()->id
            ]
        )->get();
        $arr= array();
        foreach ($mclbs as $clb){
            $cc= Club::find($clb->club_id);
            array_push($arr,$cc);
        }

        $lows = Follow::where([
                'user_id' => Auth::user()->id
            ])->orderBy('club_id')->pluck('club_id')->all();

        $clbpsots= ClubPost::whereIn('club_id',$lows)->orderBy('created_at','desc')->get();

        $mats = Match::whereIn('club_idx',$lows)->orWhereIn('club_idy',$lows)->orderBy('created_at','desc')->get();
        $fpst= array_merge($mats->toArray(),$clbpsots->toArray());
        usort($fpst, array("App\Http\Controllers\HomeController", "sortArray"));
        return view('feed',compact('arr','clbpsots','mats','fpst','sarr'));
    }

    public function sortArray($a1, $a2){
        if ($a1['created_at'] == $a2['created_at']) return 0;
        return ($a1['created_at'] > $a2['created_at']) ? -1 : 1;
    }

    public function search()
    {

        return view('search');
    }

    public function suggest()
    {
        $clbs= Club::where(
            'id', '>',0
        )->limit(5)->get();
        $arr=array();
        foreach ($clbs as $cls)
        {
            $isex=ClubUsers::where([
                'user_id' => Auth::user()->id,
                'club_id' =>$cls['id']
            ])->get();
            if (!isset($isex[0])){
                array_push($arr,$cls);
            }
        }
        return $arr;
    }

    public function searchid(Request $request){
        $clbs=Club::where("name","like","%".$request["query"]."%")->get();
        $usrs=User::where("name","like","%".$request["query"]."%")
            ->orWhere('surname',"like","%".$request["query"]."%")->get();
        $arr=array();
        $arr =array_merge($clbs->toArray(),$usrs->toArray());
        return view('search',compact('arr'));
//        return $arr;
    }
}
