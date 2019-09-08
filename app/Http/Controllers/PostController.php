<?php

namespace App\Http\Controllers;

use App\Command;
use App\Events\DeletePostCommand;
use App\Events\DeletePostLike;
use App\Events\PostCommand;
use App\Events\PostCreate;
use App\Events\PostDelete;
use App\Events\PostLike;
use App\Http\Requests\PostRequest;
use App\Like;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        event(new PostCreate($request));
            return back()->withStatus(__('Post successfully updated.'));
    }

    public function likePost($id)
    {
        if (like::isMyLike($id , Auth::user()->id))
           event(new PostLike(['post_id' => $id , 'user_id' => Auth::user()->id]));
        else
            event(new DeletePostLike(['post_id' => $id , 'user_id' => Auth::user()->id]));
         return response()->json(['size' => sizeof(Post::find($id)->like)]);
    }

    public function commandPost(Request $request)
    {
        $event = new PostCommand(['post_id' => $request->input('id') ,'command'=> $request->input('command'),'user_id' => Auth::user()->id]);
        event($event);
        $command = Command::findOrFail($event->command_id);
        return response()->json(['command' => $command->command ,
            'id'=>$command->id ,
            'post_id'=>$command->post_id,
            'size' => sizeof(Post::find($command->post_id)->command),
            'date'=>Carbon::now()->diffForHumans($command->created_at)
        ]);
    }

    public function delelteCommand(Request $request)
    {
         event(new DeletePostCommand($request->route('id') , $request->input('post_id')));
        return response()->json([
            'size' => sizeof(Post::find($request->input('post_id'))->command)
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);$i = 0;
        return view('users.showpost' , compact(['post' , 'i']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       event(new PostDelete(Post::findOrfail($id)));
        return back()->withStatus(__('Post successfully deleted.'));
    }
}
