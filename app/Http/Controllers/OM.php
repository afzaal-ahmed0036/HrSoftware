<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Datatables;

 
 
use Session;
use DB;
use URL;
use Image;
use Excel;
use File;

class OM extends Controller
{
     public function Dashboard()
    {
         
         if(session::get('UserType')!='OM')
              {

                return redirect('Login')->with('error','Access Denied!')->with('class','success');
                
              }

      $pagetitle='Dashboard';
      $data = DB::table('v_employee')->where('BranchID',session::get('BranchID'))->get();

      $visaexpiry = DB::table('v_visaexpiry')->where('BranchID',session::get('BranchID'))->get();

      $passportexpiry = DB::table('v_passportexpiry')->where('BranchID',session::get('BranchID'))->get();
      $leave_alert = DB::table('v_leave')->where('OMStatus','Pending')->where('BranchID',session::get('BranchID'))->get();
        return view ('om.dashboard',compact('pagetitle','visaexpiry','passportexpiry','leave_alert'));
    }

}
