<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Auth;
use DB;
use Artisan;

class SlugGenerate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     if(session()->get('student')){
        $id = session()->get('student')->id;
        $getdata = DB::table('students')->where('id',$id)->first();
        if(!empty($getdata)){
            if($getdata->status == 1){
                session()->forget('student');
                return redirect('https://www.coachingselect.com');
            }
        }

     }
        if(
            request()->has('name')
        ) {
            $name = '';
            request(['name' => $name]);
        }
    
        return $next($request);
    }
}
