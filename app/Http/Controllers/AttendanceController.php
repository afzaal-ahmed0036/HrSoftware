<?php

namespace App\Http\Controllers;

use App\Models\T1;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function checkIN()
    {
        return view('checkIN');
    }
    public function saveCheckIN(Request $request)
    {
        if (Session::has('EmployeeID')) {
            // dd($request->all());
            try {
                DB::beginTransaction();
                $request->validate([
                    'checkInTime' => 'required'
                ]);

                $data = [
                    'EmployeeID' => Session::get('EmployeeID'),
                    'EmployeeName' => Session::get('FullName'),
                    'date' => date("Y-m-d"),
                    'CheckIn' => $request->checkInTime,
                    'Status' => 'CheckedIN',
                ];
                T1::create($data);
                DB::commit();
                return redirect('StaffDashboard')->with('error', 'Checked IN')->with('class', 'success');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', $e->getMessage())->with('class', 'danger');
            }
        } else {
            return redirect('/')->with('error', 'Session expired')->with('class', 'danger');
        }
    }
    public function checkOut()
    {
        return view('checkOut');
    }
    public function savecheckOut(Request $request)
    {
        if (Session::has('EmployeeID')) {
            // dd($request->all());
            try {
                DB::beginTransaction();
                $request->validate([
                    'checkOutTime' => 'required'
                ]);
                $data = T1::where('EmployeeID', Session::get('EmployeeID'))
                    ->whereDate('date', date("Y-m-d"))
                    ->where('Status', 'CheckedIN')
                    ->latest()
                    ->first();
                // dd($data);
                $data->update([
                    'CheckOut' => $request->checkOutTime,
                    'Status' => 'CheckedOut'
                ]);
                DB::commit();
                Session::flush(); // removes all Session data
                return redirect('/')->with('error', 'Checked Out and Logout Successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', $e->getMessage())->with('class', 'danger');
            }
        } else {
            return redirect('/')->with('error', 'Session expired')->with('class', 'danger');
        }
    }
}
