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

use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyTarget extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function CurrentTarget()
    {   
        
          ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
          $allow= check_role(session::get('UserID'),session::get('BranchID'),'Branch','Create/List');
          if($allow[0]->Allow=='N')
          {
            return redirect('Dashboard')->with('error', 'You access is limited')->with('class','danger');
          }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////
         $branch = DB::table('branch')->get();
         $branch_id = @$branch[0]->BranchID;
         $no_of_agents = DB::table('employee')->where('BranchID',$branch_id)->count();
         $active_monthYear = date('Y-m');

        return view ('current_target',compact('branch','active_monthYear','no_of_agents')); 
    }

    public function MonthlyTargetSave(Request $request)
    {
      $this->validate($request,[
           'BranchID'=>'required',
           'no_of_agents'=>'required',
           'month'=>'required',
           'low_target'=>'required',
           'medium_target'=>'required',
           'high_target'=>'required',
           'manual_target'=>'required',
           'low_average'=>'required',
           'medium_average'=>'required',
           'high_average'=>'required',
           'manual_average'=>'required',
           'btnRadio'=>'required',
          
        ],
      [
        'BranchID.required' => 'Branch is required',
        'no_of_agents.required' => 'No of agents is required',   
        'month.required' => 'Month is required',   
        'low_target.required' => 'Low Target is required',   
        'medium_target.required' => 'Medium Target is required',   
        'high_target.required' => 'High Target is required',   
        'manual_target.required' => 'Manual Target is required',   
        'low_average.required' => 'Low Average is required',   
        'medium_average.required' => 'Medium Average is required',   
        'high_average.required' => 'High Average is required',   
        'manual_average.required' => 'Manual Average is required',   
        'btnRadio.required' => 'Select at least one target',   
      ]);



      $current_monYear = date('M-Y', strtotime($request->month));
       // stop duplicate entry
      $check = DB::table('monthly_target')->where('BranchID',$request->BranchID)->where('MonthName',$current_monYear)->first();
      if($check){
        return redirect()->back()->with('error','Target already set for Current Month')->with('class','danger'); 
      }
      //end

       $target_table = [
          [
            'type' => 'Low',
            'average' => $request->low_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->low_target
          ],
          [
            'type' => 'Medium',
            'average' => $request->medium_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->medium_target
          ],
          [
            'type' => 'High',
            'average' => $request->high_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->high_target
          ],
          [
            'type' => 'Manual',
            'average' => $request->manual_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->manual_target
          ]
       ];

       $target_table = json_encode($target_table);
       $disable_dates = null;
       if($request->disable_dates){
          $remove_spaces = preg_replace("/,([\s])+/",",",$request->disable_dates); // commpa seperated string has spaces
          $disable_dates = explode(',',$remove_spaces);
          $disable_dates = json_encode($disable_dates);
       }
       

       $data = array ( 
         "BranchID" => $request->input('BranchID'),
         "MonthName" => $current_monYear,
         "Target" => $target_table,
         "CurrentTarget" => $request->input('btnRadio'),
         "LiveTarget" =>$request->LiveTarget,
         "DisableDays" => $disable_dates
        );

        $insert_target = DB::table('monthly_target')->insertGetId($data);  

       return redirect()->back()->with('error','Target Set Successfully')->with('class','success'); 
    }

    public function TargetList(Request $request)
    {   
        
          ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
          $allow= check_role(session::get('UserID'),session::get('BranchID'),'Branch','Create/List');
          if($allow[0]->Allow=='N')
          {
            return redirect('Dashboard')->with('error', 'You access is limited')->with('class','danger');
          }
          ////////////////////////////END SCRIPT ////////////////////////////////////////////////


         $branch = DB::table('branch')->get();
        
        if ($request->ajax()) {
            $monthly_targets = DB::table('monthly_target')->orderBy('MonthlyTargetID','DESC')->get();
            return Datatables::of($monthly_targets)
            ->addIndexColumn()
            ->addColumn('branch_name', function($row){
              $branch_name = DB::table('branch')->where('BranchID',$row->BranchID)->pluck('BranchName')->first();

              return $branch_name;
            })
            ->addColumn('disable_dates', function($row){
              if(!is_null($row->DisableDays)){
                $disable_dates = json_decode($row->DisableDays);
                $disable_dates = implode(',',$disable_dates); 
              }
              else{
                $disable_dates = 'N/A';
              }
              
              return $disable_dates;
            })
            ->addColumn('target_value', function($row){
                $target_detail = $this->getTargetDetail($row->MonthlyTargetID,$row->CurrentTarget);
                return @$target_detail->target;
            })
            ->addColumn('action', function($row){
               $btn = '<a href="'.route('edit-monthly-target',['id' => $row->MonthlyTargetID]).'"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2(`monthlyTargetDelete`,'.$row->MonthlyTargetID.')"><i class="bx bx-trash  align-middle me-1"></i></a>';

                return $btn;
            })
            ->rawColumns(['branch_name','target_value','disable_dates','action'])
            ->make(true);
        }

        return view ('month_list',compact('branch')); 
    }

    public function searchTargetListing(Request $request)
    {   
        if ($request->ajax()) {
            if(!is_null($request->branch_id) && !is_null($request->month)){
                $current_monYear = date('M-Y', strtotime($request->month));
                $monthly_targets = DB::table('monthly_target')->where('BranchID',$request->branch_id)->where('MonthName',$current_monYear)->get();
            }
            elseif(!is_null($request->branch_id) && is_null($request->month)){
                $monthly_targets = DB::table('monthly_target')->where('BranchID',$request->branch_id)->orderBy('MonthlyTargetID','DESC')->get();
            }
            elseif(is_null($request->branch_id) && !is_null($request->month)){
                $current_monYear = date('M-Y', strtotime($request->month));
                $monthly_targets = DB::table('monthly_target')->where('MonthName',$current_monYear)->orderBy('MonthlyTargetID','DESC')->get();
            }
            else{
                $monthly_targets = DB::table('monthly_target')->orderBy('MonthlyTargetID','DESC')->get();
            }
            return Datatables::of($monthly_targets)
            ->addIndexColumn()
            ->addColumn('branch_name', function($row){
              $branch_name = DB::table('branch')->where('BranchID',$row->BranchID)->pluck('BranchName')->first();

              return $branch_name;
            })
            ->addColumn('disable_dates', function($row){
              if(!is_null($row->DisableDays)){
                $disable_dates = json_decode($row->DisableDays);
                $disable_dates = implode(',',$disable_dates); 
              }
              else{
                $disable_dates = 'N/A';
              }
              return $disable_dates;
            })
            ->addColumn('target_value', function($row){
                $target_detail = $this->getTargetDetail($row->MonthlyTargetID,$row->CurrentTarget);
                return @$target_detail->target;
            })
            ->addColumn('action', function($row){
               $btn = '<a href="'.route('edit-monthly-target',['id' => $row->MonthlyTargetID]).'"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2(`monthlyTargetDelete`,'.$row->MonthlyTargetID.')"><i class="bx bx-trash  align-middle me-1"></i></a>';

                return $btn;
            })
            ->rawColumns(['branch_name','target_value','disable_dates','action'])
            ->make(true);
        }

        return view ('month_list',compact('branch')); 
    }

    static public function getTargetDetail($target_id,$target_type){
        $target_detail = '';
        if(is_null($target_type)){
          $target = DB::table('monthly_target')->where('MonthlyTargetID',$target_id)->pluck('Target')->first();
          if(!is_null($target)){
              $target = json_decode($target);
              $target_detail = $target;
          }
        }
        else{
          $target = DB::table('monthly_target')->where('MonthlyTargetID',$target_id)->where('CurrentTarget',$target_type)->pluck('Target')->first();
          if(!is_null($target)){
              $target = json_decode($target);
              if($target[0]->type == $target_type)
              $target_detail = $target[0];
              elseif($target[1]->type == $target_type)
              $target_detail = $target[1];
              elseif($target[2]->type == $target_type)
              $target_detail = $target[2];
              elseif($target[3]->type == $target_type)
              $target_detail = $target[3];
              else
              $target_detail = $target_detail;
          }
        }
        
        return $target_detail;
        
    }
 
    public function MonthlyTargetEdit($id)
    {   

     ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Branch','Update');
        if($allow[0]->Allow=='N')
        {
          return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $monthly_target = DB::table('monthly_target')->where('MonthlyTargetID',$id)->first();
        $branch_name = DB::table('branch')->where('BranchID',$monthly_target->BranchID)->pluck('BranchName')->first();
        $monthYear = date('F-Y', strtotime($monthly_target->MonthName));
        if(!is_null($monthly_target->DisableDays))
          $disabled_dates = implode(', ',json_decode($monthly_target->DisableDays));
        else
          $disabled_dates = '';
        
        $actual_agent_count = DB::table('employee')->where('BranchID',$monthly_target->BranchID)->count();

        $get_full_target_detail = $this->getTargetDetail($monthly_target->MonthlyTargetID,null);
        
        if($get_full_target_detail[0]->no_of_agents != $actual_agent_count)
        $no_of_agents = $actual_agent_count;
        else
        $no_of_agents = $get_full_target_detail[0]->no_of_agents;

        return view ('edit_monthly_target',compact('branch_name','monthYear','monthly_target','get_full_target_detail','no_of_agents','disabled_dates'));
    }

    public function MonthlyTargetUpdate(Request $request)
    {
      $this->validate($request,[
           'no_of_agents'=>'required',
           'low_target'=>'required',
           'medium_target'=>'required',
           'high_target'=>'required',
           'manual_target'=>'required',
           'low_average'=>'required',
           'medium_average'=>'required',
           'high_average'=>'required',
           'manual_average'=>'required',
           'btnRadio'=>'required',
          
        ],
      [
        'no_of_agents.required' => 'No of agents is required',   
        'low_target.required' => 'Low Target is required',   
        'medium_target.required' => 'Medium Target is required',   
        'high_target.required' => 'High Target is required',   
        'manual_target.required' => 'Manual Target is required',   
        'low_average.required' => 'Low Average is required',   
        'medium_average.required' => 'Medium Average is required',   
        'high_average.required' => 'High Average is required',   
        'manual_average.required' => 'Manual Average is required',   
        'btnRadio.required' => 'Select at least one target',   
      ]); 

       // $current_monYear = date('M-Y', strtotime($request->month));
       $target_table = [
          [
            'type' => 'Low',
            'average' => $request->low_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->low_target
          ],
          [
            'type' => 'Medium',
            'average' => $request->medium_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->medium_target
          ],
          [
            'type' => 'High',
            'average' => $request->high_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->high_target
          ],
          [
            'type' => 'Manual',
            'average' => $request->manual_average,
            'no_of_agents' => $request->no_of_agents,
            'target' => $request->manual_target
          ]
       ];

       $target_table = json_encode($target_table);
       $disable_dates = null;
       if($request->disable_dates){
          $remove_spaces = preg_replace("/,([\s])+/",",",$request->disable_dates); // commpa seperated string has spaces
          $disable_dates = explode(',',$remove_spaces);
          $disable_dates = json_encode($disable_dates);
       }
       

       $data = array ( 
         // "BranchID" => $request->input('BranchID'),
         // "MonthName" => $current_monYear,
         "Target" => $target_table,
         "CurrentTarget" => $request->input('btnRadio'),
         "LiveTarget" =>$request->LiveTarget,
         "DisableDays" => $disable_dates
        );
        $update_target = DB::table('monthly_target')->where('MonthlyTargetID' , $request->target_id )->update($data);  

       return redirect()->back()->with('error','Target Updated Successfully')->with('class','success'); 
    }

    public function MonthlyTargetDelete($id)
    {   
          
          ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Branch','Delete');
        if($allow[0]->Allow=='N')
        {
          return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
          
        $id = DB::table('monthly_target')->where('MonthlyTargetID',$id)->delete();
        return redirect('/TargetList')->with('error','Deleted Successfully')->with('class','success');
          
    }
}