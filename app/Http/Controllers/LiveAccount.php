<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

// for excel export
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
// end for excel export
 
use Session;
use DB;
use URL;
use Image;
use Excel;
use File;
use PDF;
use Illuminate\Support\Facades\Storage;

class LiveAccount extends Controller
{

public function index()
{
    //
}

public function FCBMonth($type)
{


 
           

  $Type=$type;

            $monthname = DB::table('monthname')->get();
            $branch = DB::table('branch')->get();

            return view ('fcb_month',compact('monthname','branch','Type'))->with('error','Select month name first')->with('class','danger');
        

}

public function FCBPrint(request $request)
{

 $fcb = DB::table('v_fcb')->where('MonthName',$request->MonthName)->where('BranchID',$request->BranchID)->get();


$MonthName = $request->MonthName;

 $branch = DB::table('branch')->where('BranchID',$request->BranchID)->get();
          return view('fcb_print',compact('fcb','branch','MonthName'));

}

public function FCBView(){

  $branch = DB::table('branch')->get();
  return view ('fcb_view',compact('branch'));
}

public function Ajax_FCBMonthName(request $request)
{
  $MonthName = DB::table('v_fcb')->distinct()->where('BranchID',$request->BranchID)->get(['MonthName']);

   return view ('ajax',compact( 'MonthName'));
}

public function FCBSetMonthName(request $request)
{


   $this->validate($request,[
                 'BranchID'=>'required',
                 'MonthName'=>'required',
                
              ],
            [
              'BranchID.required' => 'Branch is required',
              'MonthName.required' => 'Month Name is required',
               
                
                   
            ]);
 
    session::put('FCBMonthName',$request->input('MonthName'));
    session::put('FCBBranchID',$request->input('BranchID'));


    $down = $request->input('Action'); 

    if($down=='Download')
      {
          return redirect('DepositExport/xls');
      }


      if($request->Action=='Input')
      {
          return redirect('FCB')->with('error','Month name set')->with('class','success');
      }
      else
      {
          $branch = DB::table('branch')->where('BranchID',$request->BranchID)->get();
          $fcb = DB::table('v_fcb')->where('MonthName',$request->MonthName)->where('BranchID',$request->BranchID)->get();
          return view('fcb_print',compact('fcb','branch'));

      }
    
 }

    public function LiveAccountAdd()
    {   

        ///////////////////////USER RIGHT & CONTROL ////////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $branch_id = session::get('BranchID');

        $branch = DB::table('branch')->get();

        $today_date = date('d/m/Y');

        $employee = DB::table('employee')->where('BranchID',$branch_id)->orderBy('FirstName','ASC')->get();

        return view ('live_account_add',compact('employee','branch','branch_id','today_date')); 
    }

    public function liveAccountListing(Request $request)
    {   
      ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
      $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

      if($allow[0]->Allow=='N')
      {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
      }
      // dd(session::get('BranchID'));
      ////////////////////////////END SCRIPT ////////////////////////////////////////////////
      $active_monthYear = date('Y-m');
      $branch = DB::table('branch')->get();
      $branch_id = session::get('BranchID');
      $employees = DB::table('employee')->where('BranchID',$branch_id)->orderBy('FirstName','ASC')->get();

      if ($request->ajax()) {
            $current_monYear = date('M-Y');
            $live_accounts = DB::table('v_live_account')->where('MonthName', $current_monYear)->where('BranchID',$branch_id)->get();
            return Datatables::of($live_accounts)
            ->addIndexColumn()
            ->addColumn('agent', function($row){
              $full_name = $row->FirstName.' '.$row->MiddleName.' '.$row->LastName;

              return $full_name;
            })
            ->addColumn('action', function($row){
               $btn = '<a href="'.route('live_account.edit',['id' => $row->LiveAccountID ]).'"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2(`LiveAccountDelete`,'.$row->LiveAccountID .')"><i class="bx bx-trash  align-middle me-1"></i></a>';

                return $btn;
            })
            ->rawColumns(['agent','action'])
            ->make(true);
        }

      
       
      return view ('live_account_listing',compact('employees','branch','branch_id','active_monthYear'));
    }

    public function searchLiveAccountListing(Request $request)
    {
      if ($request->ajax()) {
          if(!is_null($request->month))
          $current_monYear = $request->month;
          else
          $current_monYear = date('M-Y');

          $current_monYear = date('M-Y', strtotime($current_monYear));

          if(!is_null($request->branch_id))
          $branch_id = $request->branch_id;
          else
          $branch_id = session::get('BranchID');

          if(!is_null($request->agent_id))
          $live_accounts = DB::table('v_live_account')->where('MonthName', $current_monYear)->where('EmployeeID', $request->agent_id)->where('BranchID',$branch_id)->get();
          else
          $live_accounts = DB::table('v_live_account')->where('MonthName', $current_monYear)->where('BranchID',$branch_id)->get();
          
          return Datatables::of($live_accounts)
          ->addIndexColumn()
          ->addColumn('agent', function($row){
            $full_name = $row->FirstName.' '.$row->MiddleName.' '.$row->LastName;

            return $full_name;
          })
          ->addColumn('action', function($row){
             $btn = '<a href="'.route('live_account.edit',['id' => $row->LiveAccountID ]).'"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2(`LiveAccountDelete`,'.$row->LiveAccountID.')"><i class="bx bx-trash  align-middle me-1"></i></a>';

              return $btn;
          })
          ->rawColumns(['agent','action'])
          ->make(true);
      }
    }

    public function getBranchWiseEmployees(Request $request)
    {
      if(!is_null($request->branch_id))
      $branch_id = $request->branch_id;
      else
      $branch_id = session::get('BranchID');

      $employees = DB::table('employee')->select('EmployeeID','FirstName','MiddleName','LastName')->where('BranchID',$branch_id)->orderBy('FirstName','ASC')->get();
      return response()->json($employees);
    }

    public function checkDuplicateIdsInLiveAccounts(Request $request)
    {
      $check_entry = DB::table('v_live_account')->where('ID',trim($request->liveAccountID))->get();
      return response()->json($check_entry);
    }


    public function saveLiveAccount(Request $request)
    {   

      ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
      $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');
      if($allow[0]->Allow=='N')
      {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
      }
      ////////////////////////////END SCRIPT ////////////////////////////////////////////////

      $this->validate($request, [
      'ID' => 'required',
      'BranchID' => 'required',
      'EmployeeID' => 'required',
      'Date' => 'required | date_format:d/m/Y',
       ],
       [
        'ID.required' => 'ID is required',
        'BranchID.required' => 'Branch is required',
        'EmployeeID.required' => 'Employee is required',
        'Date.required' => 'Date is required',
       ] );


       $data = array ( 
       "ID" => $request->input('ID'),
       "EmployeeID" => $request->input('EmployeeID'),
       "Date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('Date')))),
       "Dialer" => $request->input('Dialer'),
       "Remarks" => $request->input('Remarks'),
       "BranchID" => $request->input('BranchID'),
        );
          
        $id= DB::table('live_account')->insertGetId($data);
        return redirect('LiveAccountAdd')->with('error','Saved Successfully')->with('class','success');
        
    }

      public function editLiveAccount($id)
      {   
      ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
          $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Update');
          if($allow[0]->Allow=='N')
          {
            return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
          }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////
         $live_account = DB::table('v_live_account')->where('LiveAccountID',$id)->first();  
         $employees = DB::table('employee')->where('BranchID',$live_account->BranchID)->orderBy('FirstName','ASC')->get();

         $branch = DB::table('branch')->get();
                      
         return view ('edit_live_account',compact('live_account','employees','branch')); 
        }

public function updateLiveAccount(Request $request)
{   

          ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
          $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Update');
          if($allow[0]->Allow=='N')
          {
            return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
          }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////


$this->validate($request, [
          'ID' => 'required',
          'EmployeeID' => 'required',
          'Date' => 'required | date_format:d/m/Y',
           ],
           [
            'ID.required' => 'ID is required',
            'EmployeeID.required' => 'Employee is required',
            'Date.required' => 'Date is required',
           ] );

           $data = array ( 
           "ID" => $request->input('ID'),
           "EmployeeID" => $request->input('EmployeeID'),
           "Date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('Date')))),
           "Dialer" => $request->input('Dialer'),
           "Remarks" => $request->input('Remarks'),
           "BranchID" => $request->input('BranchID'),
            );

        $id= DB::table('live_account')->where('LiveAccountID' , $request->LiveAccountID)->update($data);
        return redirect()->back()->with('error','Updated Successfully')->with('class','success');
        }

        public function LiveAccountDelete($id)
        {   

          ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
            $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Delete');
            if($allow[0]->Allow=='N')
            {
              return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
            }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////


            $id = DB::table('live_account')->where('LiveAccountID',$id)->delete();
            return redirect()->back()->with('error','Deleted Successfully')->with('class','success');
            
        }

 
}