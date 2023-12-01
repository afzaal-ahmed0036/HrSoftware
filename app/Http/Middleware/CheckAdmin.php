<?php

namespace App\Http\Middleware;

use Closure;

use URL;
use DB;
use Illuminate\Support\Facades\Session;

class CheckAdmin
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
        // dd(Session::has('EmployeeID'));
        if (Session::get('UserID') == null && Session::get('EmployeeID') == null) {
            return redirect('/')->with('error', 'Session expired')->with('class', 'danger');
        } else {
            return $next($request);
        }
    }
}


/*   if(Session::get('UserType')!='Admin')
         {
         // Session::flash('error', 'Invalid Rollno or Password. Try again');
        return redirect()->back()->with('error', 'Access denied!!!')->with('class','danger');
         }
         else
         {
            return $next($request);
         }


         */




         /*

         orginal


          public function handle($request, Closure $next)
    {

             return $next($request);




}

      */
