<?php

namespace App\Http\Controllers;

use App\Club;
use App\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MatchsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clubs = \App\Club::where(
            [
                'user_id' => \Illuminate\Support\Facades\Auth::user()->id
            ]
        )->get();

        return view('match.create',compact('clubs'));
    }

    public function readall(){
        $cluvs= Club::all();
        $addlar=array();
        foreach ($cluvs as $c)
        {
            if ($c->user_id !=Auth::user()->id) {
                array_push($addlar, $c->name);
            }
        }
        return $addlar;
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
        $idy=Club::where(['name'=>$request['club_idy']])->first();
        if ($idy!=null) {
            $request['club_idy'] = $idy->id;
            $request['club_idx'] = intval($request['club_idx']);
            $mtime = $request['day'] . " " . $request['dtime'] . ':55';
            $finarr = array_merge($request->all('club_idy', 'club_idx', 'location'), ['mtime' => $mtime]);
            $match = Match::create($finarr);
            return redirect('feed');
        }else{
            $valDate = $this->validatorMatch($request->all());
            $valDate->after(function ($validator) {
                $validator->errors()->add('club_idy', 'Given club no not exists!');
            }
            );
            $valDate->validate();
        }
    }
    public function validatorMatch(array $data)
    {
        return Validator::make($data, [
            'club_idy' => 'required|string|max:20|'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        //
    }

    public function schedule(){
        $mts=Match::where("id",">",0)->orderBy("mtime","Desc")->simplePaginate(5);
        return view('match.schedule',compact('mts'));
    }
}
