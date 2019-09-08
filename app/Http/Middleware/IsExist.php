<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;

class IsExist
{
    public function can($id)
    {
        return Post::findOrFail($id);
    }
    public function handle($request, Closure $next)
    {
        try {
            if($this->can($request->route('id'))->id)
               return $next($request);
            else
                abort(404);
        }catch (\Exception $e)
        {
            abort(404);
        }
    }
}
