<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Datatables;

 
use Session;
use DB;
use URL;
use Image;
use Excel;
use File;

class GM extends Controller
{
    
     public function Dashboard()
    {
         
 		 if(session::get('UserType')!='GM')
              {

                return redirect('Login')->with('error','Access Denied!')->with('class','success');
                
              }

	  $pagetitle='Dashboard';
      $data = DB::table('v_employee')->where('BranchID',session::get('BranchID'))->get();
      $visaexpiry = DB::table('v_visaexpiry')->where('BranchID',session::get('BranchID'))->get();
      $passportexpiry = DB::table('v_passportexpiry')->where('BranchID',session::get('BranchID'))->get();
      $leave_alert = DB::table('v_leave')->where('HRStatus','Pending')->where('BranchID',session::get('BranchID'))->get();
        return view ('gm.dashboard',compact('pagetitle','visaexpiry','passportexpiry','leave_alert'));
    }



}
