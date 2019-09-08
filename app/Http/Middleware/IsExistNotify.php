<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class IsExistNotify
{
    public function can($id)
    {
        return DB::table('notifications')->where('id' , $id)->get()->isNotEmpty();
    }
    public function handle($request, Closure $next)
    {
        try {
            if($this->can($request->route('id')))
                return $next($request);
            else
                abort(404);
        }catch (\Exception $e)
        {
            abort(404);
        }
    }
}
