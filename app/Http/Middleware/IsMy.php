<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;
use Illuminate\Support\Facades\Auth;

class IsMy
{
    public function can($id)
    {
        if(Post::findOrfail($id)->user_id == Auth::user()->id)
            return true;
        return false;
    }
    public function handle($request, Closure $next)
    {
        try {
            if($this->can($request->route('id')))
               return $next($request);
            else
                abort(404);
        }catch (Exception $e)
        {
            abort(404);
        }
    }
}
