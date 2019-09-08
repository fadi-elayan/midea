<?php

namespace App\Http\Controllers;

use App\Events\AcceptFrindRequest;
use App\Events\AddFrindRequest;
use App\Events\CancelFrindRequest;
use App\Events\NotificationEvent;
use App\Events\RollBackFrindRequest;
use App\Listeners\DeleteFrindReques;
use App\User;
use App\Http\Requests\UserRequest;
use DemeterChain\A;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('user.index');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }
    public function updateInformation(\Illuminate\Http\Request  $request)
    {
        User::updateInformation($request , Auth::user()->id);
    }
    public function showUser($id)
    {
        $user = User::getUser($id);
        $posts = $user->post;
        $i = 0;
        return view('users.pageForUser' , compact(['posts' , 'i' , 'user']));
    }

    public function frindRequest($id)
    {
         if((User::isAddFrindRequest($id)->isNotEmpty()))
             event(new RollBackFrindRequest($id, Auth::user()->id));
         elseif(User::isMyFrind($id))
             event(new CancelFrindRequest($id ,Auth::user()->id));
         else
            event(new AddFrindRequest($id , Auth::user()->id));
         return back();
    }
    public function search($id)
    {
        $users = User::getUsers($id);
        if($users->isEmpty())
            abort(404);
        else
            return view('users.resultOfSerceh' , compact(['users']));
    }
    public function destroy(User  $user)
    {
        if ($user->id == 1) {
            return abort(403);
        }

        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }

    public function showFrindRequest()
    {
        $class = array();
        $notifications = User::getNotificationFrindPaginat(Auth::user()->id);
        return view('profile.userNotificationFrind' , compact(['notifications']));
    }

    public function showNotification()
    {
        $class = array();
        $notifications = User::getNotificationlikeAndCommint(Auth::user()->id);
        return view('profile.userNotificationLikeCommand' , compact(['notifications']));
    }

    public function acceptFrindRequest($id)
    {
          $notify = DB::table('notifications')->where('type' , 'App\Notifications\FrindRequestNotification')->where('id' , $id)->get()[0];
          event(new AcceptFrindRequest(json_decode($notify->data)->user_id , json_decode($notify->data)->frind_id));
          return back();
    }

    public function rejectFrindRequest($id)
    {
        DB::table('notification')->where('id' , $id)->where('notifiable_id' ,Auth::user()->id)->delete();
        return back();
    }
}
