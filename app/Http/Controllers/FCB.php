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

class FCB extends Controller
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

    public function FCBAdd()
    {   

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
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

        return view ('fcb_add',compact('employee','branch','branch_id','today_date')); 
    }

    public function fcbListing(Request $request)
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
            $fcb = DB::table('v_fcb')->where('MonthName', $current_monYear)->where('BranchID',$branch_id)->get();
            return Datatables::of($fcb)
            ->addIndexColumn()
            ->addColumn('agent', function($row){
              $full_name = $row->FirstName.' '.$row->MiddleName.' '.$row->LastName;

              return $full_name;
            })
            ->addColumn('action', function($row){
               $btn = '<a href="'.route('fcb.edit',['id' => $row->FCBID]).'"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2(`fcbDelete`,'.$row->FCBID.')"><i class="bx bx-trash  align-middle me-1"></i></a>';

                return $btn;
            })
            ->rawColumns(['agent','action'])
            ->make(true);
        }

      
       
      return view ('fcb_listing',compact('employees','branch','branch_id','active_monthYear'));
    }

    public function searchFcbListing(Request $request)
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
          $fcb = DB::table('v_fcb')->where('MonthName', $current_monYear)->where('EmployeeID', $request->agent_id)->where('BranchID',$branch_id)->get();
          else
          $fcb = DB::table('v_fcb')->where('MonthName', $current_monYear)->where('BranchID',$branch_id)->get();
          
          return Datatables::of($fcb)
          ->addIndexColumn()
          ->addColumn('agent', function($row){
            $full_name = $row->FirstName.' '.$row->MiddleName.' '.$row->LastName;

            return $full_name;
          })
          ->addColumn('action', function($row){
             $btn = '<a href="'.route('fcb.edit',['id' => $row->FCBID]).'"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2(`fcbDelete`,'.$row->FCBID.')"><i class="bx bx-trash  align-middle me-1"></i></a>';

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

    public function checkDuplicateIds(Request $request)
    {
      $check_entry = DB::table('v_fcb')->where('ID',trim($request->fcbID))->get();
      return response()->json($check_entry);
    }


    public function saveFCB(Request $request)
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
      'FTDAmount' => 'required',
      'Date' => 'required | date_format:d/m/Y',
      'Compliant' => 'required',
      'KYCSent' => 'required',
       ],
       [
        'ID.required' => 'ID is required',
        'BranchID.required' => 'Branch is required',
        'EmployeeID.required' => 'Employee is required',
        'FTDAmount.required' => 'FTD Amount is required',
        'Date.required' => 'Date is required',
        'Compliant.required' => 'Compliant is required',
        'KYCSent.required' => 'KYC Sent is required',
       ] );


       $data = array ( 
       "ID" => $request->input('ID'),
       "EmployeeID" => $request->input('EmployeeID'),
       "FTDAmount" => $request->input('FTDAmount'),
       "Date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('Date')))),
       "Compliant" => $request->input('Compliant'),
       "KYCSent" => $request->input('KYCSent'),
       "Dialer" => $request->input('Dialer'),
       "Remarks" => $request->input('Remarks'),
       "BranchID" => $request->input('BranchID'),
        );
          
        $id= DB::table('fcb')->insertGetId($data);
        return redirect('FCBAdd')->with('error','Saved Successfully')->with('class','success');
        
    }

      public function editFcb($id)
      {   
      ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
          $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Update');
          if($allow[0]->Allow=='N')
          {
            return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
          }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////
         $fcb = DB::table('v_fcb')->where('FCBID',$id)->first();  
         $employees = DB::table('employee')->where('BranchID',$fcb->BranchID)->orderBy('FirstName','ASC')->get();

         $branch = DB::table('branch')->get();
                      
         return view ('fcb_edit',compact('fcb','employees','branch')); 
        }

public function updateFcb(Request $request)
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
          'FTDAmount' => 'required',
          'Date' => 'required | date_format:d/m/Y',
          'Compliant' => 'required',
          'KYCSent' => 'required',
           ],
           [
            'ID.required' => 'ID is required',
            'EmployeeID.required' => 'Employee is required',
            'FTDAmount.required' => 'FTD Amount is required',
            'Date.required' => 'Date is required',
            'Compliant.required' => 'Compliant is required',
            'KYCSent.required' => 'KYC Sent is required',
           ] );

           $data = array ( 
           "ID" => $request->input('ID'),
           "EmployeeID" => $request->input('EmployeeID'),
           "FTDAmount" => $request->input('FTDAmount'),
           "Date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('Date')))),
           "Compliant" => $request->input('Compliant'),
           "KYCSent" => $request->input('KYCSent'),
           "Dialer" => $request->input('Dialer'),
           "Remarks" => $request->input('Remarks'),
           "BranchID" => $request->input('BranchID'),
            );

        $id= DB::table('fcb')->where('FCBID' , $request->FCBID)->update($data);
        return redirect()->back()->with('error','Updated Successfully')->with('class','success');
        }

        public function fcbDelete($id)
        {   

          ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
            $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Delete');
            if($allow[0]->Allow=='N')
            {
              return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
            }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////


            $id = DB::table('fcb')->where('FCBID',$id)->delete();
            return redirect()->back()->with('error','Deleted Successfully')->with('class','success');
            
        }

 
}