<?php

namespace App\Http\Middleware;

use App\Models\T1;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Session::has('UserID'));
        $today = Carbon::today()->format('Y-m-d');
        // $yesterday = Carbon::yesterday()->format('Y-m-d');
        T1::where('date', '!=',  $today)->where('Status', 'CheckedIN')->update([
            'CheckOut' => '19:00',
            'Status' => 'CheckedOut',
        ]);
        if (Session::has('EmployeeID') && Session::has('StaffType') && Session::get('StaffType') == 'Regular') {
            $data = T1::where('date', $today)->where('EmployeeID', Session::get('EmployeeID'))->latest()->first();
            // dd($data);
            if (!$data) {
                // dd($today);
                return redirect('/CheckIN')->with(['error' => "You haven't checked in today, Please Check In"])->with('class', 'danger');
            } elseif ($data->Status == 'CheckedOut') {
                return redirect('/CheckIN')->with(['error' => "You checked out earlier today, Please Check In Again"])->with('class', 'danger');
            } else {
                return $next($request);
            }
        } else
            return $next($request);
    }
}
