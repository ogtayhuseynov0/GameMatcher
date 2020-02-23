<?php

namespace App\Http\Controllers;

use App\Club;
use App\ClubPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClubPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $club= Club::findOrFail($id);
        $owner=User::findOrFail($club->user_id);
        if (Auth::user()->id == $owner->id){


            return view('post.create',compact('id'));
        }else
        {
            return redirect('club/'.$id);
        }
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
    public function store(Request $request,$id)
    {
        $club= Club::findOrFail($id);
        $owner=User::findOrFail($club->user_id);
        $request->validate([
            'text' =>'required|max:1000|min:1',
            'imagePath' =>'image|mimes:jpg,png,jpeg|max:50',
        ]);

        $post= ClubPost::create($request->all());

        if ($request->hasFile('imagePath')) {
            if($request->file('imagePath')->isValid()) {
                $file = $request->file('imagePath');
                $name = time() . '.' . $file->getClientOriginalExtension();

                $request->file('imagePath')->move("images", $name);
                $post->update(['imagePath'=>$name]);
            }
        }

        return redirect('club/'.$id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClubPost  $clubPost
     * @return \Illuminate\Http\Response
     */
    public function show(ClubPost $clubPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClubPost  $clubPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$id2)
    {
        $clubpost= ClubPost::where(
            [
                'id' => $id2,
                'club_id' =>$id
            ]
        )->get();
            return view('post.edit', compact('clubpost','id','id2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClubPost  $clubPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$id2)
    {
        $this->validatorClub($request->all())->validate();
         $clubpost= ClubPost::where(
        [
            'id' => $id2,
            'club_id' =>$id
        ]

            );
        $clubpost->update($request->except(['_token','_method', 'submit']));
        if ($request->hasFile('imagePath')) {
            if($request->file('imagePath')->isValid()) {
                $file = $request->file('imagePath');
                $name = time() . '.' . $file->getClientOriginalExtension();

                $request->file('imagePath')->move("images", $name);
                $clubpost->update(['imagePath'=>$name]);
            }
        }
        return redirect('club/'.$id);

    }
    public function validatorClub(array $data)
    {
        return Validator::make($data, [
            'text' => 'required|string|max:1000',
            'imagePath' =>'image|mimes:jpg,png,jpeg|max:50',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClubPost  $clubPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$id2)
    {
        $clubpost= ClubPost::where(
            [
                'id' => $id2,
                'club_id' =>$id
            ]
        );
        $clubpost->delete();
        return redirect('club/'.$id);
    }


}
