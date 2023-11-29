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
use App\Http\Controllers\MonthlyTarget;


class FCBReports extends Controller
{

    public function TopAgentReport()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $active_monthYear = date('Y-m');
        $monYear = date('M-Y');

        $branch_id = session::get('BranchID');

        $fcbsummary = DB::table('v_fcb')
        ->select('FirstName','MiddleName','LastName',DB::raw('count(FTDAmount) as tot'),DB::raw('sum(FTDAmount) as SumFTDAmount'))
        ->where('MonthName', $monYear)
        ->where('BranchID',$branch_id)
        ->orderBy(DB::raw('count(FTDAmount)'), 'desc')
        ->groupBy('FirstName','MiddleName','LastName')->get();


        $monthly_target = DB::table('monthly_target')
        ->where('MonthName', $monYear)
        ->where('BranchID',$branch_id)
        ->orderBy('eDate', 'desc')->first();

        //dd($fcbsummary);

        $branch = DB::table('branch')->get();

        $employee = DB::table('employee')->get();

        return view ('fcb_top_agent_report',compact('fcbsummary','employee','branch','branch_id','active_monthYear','monthly_target')); 
    }

    public function SearchTopAgentReport(Request $request)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
    $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

    if($allow[0]->Allow=='N')
    {
    return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
    }
    ////////////////////////////END SCRIPT ////////////////////////////////////////////////

    if(!is_null($request->month))
    $current_monYear = $request->month;
    else
    $current_monYear = date('M-Y');


    if($request->BranchID != '')
    $branch_id = $request->BranchID;
    else
    $branch_id = session::get('BranchID');

    $monYear = date('M-Y', strtotime($current_monYear));

    $active_monthYear = date('Y-m', strtotime($current_monYear));
    //dd($current_monYear);

    $fcbsummary = DB::table('v_fcb')
    ->select('EmployeeID','FirstName','MiddleName','LastName',DB::raw('count(FTDAmount) as tot'),DB::raw('sum(FTDAmount) as SumFTDAmount'))
    ->where('MonthName', $monYear)
    ->where('BranchID',$branch_id)
    ->orderBy(DB::raw('count(FTDAmount)'), 'desc')
    ->groupBy('EmployeeID','FirstName','MiddleName','LastName')->get();


    foreach ($fcbsummary as $emp)
    $fcb_employee[] = $emp->EmployeeID;


    $unfcbemployee = '';
    if(!empty($fcb_employee))
    $unfcbemployee = DB::table('employee')->whereNotIn('EmployeeID', $fcb_employee)->where('BranchID',$branch_id)->get();


    $monthly_target = DB::table('monthly_target')
    ->where('MonthName', $monYear)
    ->where('BranchID',$branch_id)
    ->orderBy('eDate', 'desc')->first();

    //dd($monthly_target,$monYear,$branch_id);
    //dd($fcbsummary,$start_date, $end_date,$branch_id);

    $branch = DB::table('branch')->get();

    $employee = DB::table('employee')->get();


    $start    = date('Y-m-01', strtotime($current_monYear));
    $end      = date('Y-m-t', strtotime($current_monYear));

    if(date('m',strtotime($current_monYear)) == date('m'))
    {
        $elapsed_end = date('Y-m-d');
    }
    else
    {
        $elapsed_end = date('Y-m-t', strtotime($current_monYear));
    }

    if($monthly_target)
    {
        $target_detail = MonthlyTarget::getTargetDetail($monthly_target->MonthlyTargetID,$monthly_target->CurrentTarget);
        $current_target =  $target_detail->target;

        if($monthly_target->DisableDays != '')
        {
        $disable_dates = json_decode($monthly_target->DisableDays);
        $holidays = $disable_dates;
        }else
        {
           $holidays = []; 
        }

    }else{

        $current_target = 0;
        $holidays = [];

    }




    $working_days = $this->get_total_days($start, $end, $holidays); 

    $elapsed_days = $this->get_total_days($start, $elapsed_end, $holidays); 

    $Daily_Target_FTD = round(($elapsed_days+1)*($current_target/$working_days));

    return view ('fcb_top_agent_report',compact('fcbsummary','employee','branch','branch_id','active_monthYear','monthly_target','current_target','working_days','elapsed_days','Daily_Target_FTD','unfcbemployee')); 
    }

    public function YearlyReport()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $active_year = date('Y');

        $branch = DB::table('branch')->get();

        $branch_id = session::get('BranchID');

        $employees = DB::table('employee')->where('BranchID',$branch_id)->get();

        foreach ($employees as $emp)
        $fcb_employee[] = $emp->EmployeeID;

        $unfcbemployee = '';
        if(!empty($fcb_employee))
        $unfcbemployee = DB::table('employee')->whereNotIn('EmployeeID', $fcb_employee)->where('BranchID',$branch_id)->get();

        $months = [
            'Jan' => 'Jan-'.$active_year,
            'Feb' => 'Feb-'.$active_year,
            'Mar' => 'Mar-'.$active_year,
            'Apr' => 'Apr-'.$active_year,
            'May' => 'May-'.$active_year,
            'Jun' => 'Jun-'.$active_year,
            'Jul' => 'Jul-'.$active_year,
            'Aug' => 'Aug-'.$active_year,
            'Sep' => 'Sep-'.$active_year,
            'Oct' => 'Oct-'.$active_year,
            'Nov' => 'Nov-'.$active_year,
            'Dec' => 'Dec-'.$active_year,
        ];

        return view ('yearly_report',compact('employees','unfcbemployee','branch','branch_id','active_year','months')); 
    }

    public function SearchYearlyReport(Request $request)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        if(!is_null($request->year))
        $active_year = $request->year;
        else
        $active_year = date('Y');


        if($request->BranchID != '')
        $branch_id = $request->BranchID;
        else
        $branch_id = session::get('BranchID');      

        $branch = DB::table('branch')->get();

        $employees = DB::table('employee')->where('BranchID',$branch_id)->get();

        foreach ($employees as $emp)
        $fcb_employee[] = $emp->EmployeeID;

        $unfcbemployee = '';
        if(!empty($fcb_employee))
        $unfcbemployee = DB::table('employee')->whereNotIn('EmployeeID', $fcb_employee)->where('BranchID',$branch_id)->get();

        $months = [
            'Jan' => 'Jan-'.$active_year,
            'Feb' => 'Feb-'.$active_year,
            'Mar' => 'Mar-'.$active_year,
            'Apr' => 'Apr-'.$active_year,
            'May' => 'May-'.$active_year,
            'Jun' => 'Jun-'.$active_year,
            'Jul' => 'Jul-'.$active_year,
            'Aug' => 'Aug-'.$active_year,
            'Sep' => 'Sep-'.$active_year,
            'Oct' => 'Oct-'.$active_year,
            'Nov' => 'Nov-'.$active_year,
            'Dec' => 'Dec-'.$active_year,
        ];

        return view ('yearly_report',compact('employees','branch','branch_id','active_year','months','unfcbemployee')); 
    }

    public function QuarterlyReport()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $active_year = date('Y');

        $branch = DB::table('branch')->get();

        $branch_id = session::get('BranchID');

        $employees = DB::table('employee')->where('BranchID',$branch_id)->get();

        foreach ($employees as $emp)
        $fcb_employee[] = $emp->EmployeeID;


        $unfcbemployee = '';
        if(!empty($fcb_employee))
        $unfcbemployee = DB::table('employee')->whereNotIn('EmployeeID', $fcb_employee)->where('BranchID',$branch_id)->get();


        $quarter = 1;

        $months = [
            'Jan' => 'Jan-'.$active_year,
            'Feb' => 'Feb-'.$active_year,
            'Mar' => 'Mar-'.$active_year,
        ];

        return view ('quarterly_report',compact('employees','unfcbemployee','branch','branch_id','active_year','months','quarter')); 
    }

    public function SearchQuarterlyReport(Request $request)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        if(!is_null($request->year))
        $active_year = $request->year;
        else
        $active_year = date('Y');


        if($request->BranchID != '')
        $branch_id = $request->BranchID;
        else
        $branch_id = session::get('BranchID');      

        $branch = DB::table('branch')->get();

        $employees = DB::table('employee')->where('BranchID',$branch_id)->get();

        foreach ($employees as $emp)
        $fcb_employee[] = $emp->EmployeeID;


        $unfcbemployee = '';
        if(!empty($fcb_employee))
        $unfcbemployee = DB::table('employee')->whereNotIn('EmployeeID', $fcb_employee)->where('BranchID',$branch_id)->get();

        $quarter = $request->quarter;

        if($quarter == 1){
            $months = [
                'Jan' => 'Jan-'.$active_year,
                'Feb' => 'Feb-'.$active_year,
                'Mar' => 'Mar-'.$active_year,
            ];
        }
        elseif($quarter == 2){
            $months = [
                'Apr' => 'Apr-'.$active_year,
                'May' => 'May-'.$active_year,
                'Jun' => 'Jun-'.$active_year,
            ];
        }
        elseif($quarter == 3){
            $months = [
                'Jul' => 'Jul-'.$active_year,
                'Aug' => 'Aug-'.$active_year,
                'Sep' => 'Sep-'.$active_year,
            ];
        }
        elseif($quarter == 4){
            $months = [
                'Oct' => 'Oct-'.$active_year,
                'Nov' => 'Nov-'.$active_year,
                'Dec' => 'Dec-'.$active_year,
            ];
        }
        else{
            return redirect()->back()->with('error', 'Select Quarter')->with('class','danger');
        }

        

        return view ('quarterly_report',compact('employees','branch','branch_id','active_year','months','unfcbemployee','quarter')); 
    }

    public function TopLiveAccount()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
        $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

        if($allow[0]->Allow=='N')
        {
        return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $active_monthYear = date('Y-m');
        $monYear = date('M-Y');

        $branch_id = session::get('BranchID');

        $fcbsummary = DB::table('v_live_account')
        ->select('FirstName','MiddleName','LastName',DB::raw('count(LiveAccountID) as tot'))
        ->where('MonthName', $monYear)
        ->where('BranchID',$branch_id)
        ->orderBy(DB::raw('count(LiveAccountID)'), 'desc')
        ->groupBy('FirstName','MiddleName','LastName')->get();


        $monthly_target = DB::table('monthly_target')
        ->where('MonthName', $monYear)
        ->where('BranchID',$branch_id)
        ->orderBy('eDate', 'desc')->first();

        //dd($fcbsummary);

        $branch = DB::table('branch')->get();

        $employee = DB::table('employee')->get();

        return view ('top_live_account',compact('fcbsummary','employee','branch','branch_id','active_monthYear','monthly_target')); 
    }

    public function SearchTopLiveAccount(Request $request)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////    
    $allow= check_role(session::get('UserID'),session::get('BranchID'),'Deposit','Create/List');

    if($allow[0]->Allow=='N')
    {
    return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
    }
    ////////////////////////////END SCRIPT ////////////////////////////////////////////////

    if(!is_null($request->month))
    $current_monYear = $request->month;
    else
    $current_monYear = date('M-Y');


    if($request->BranchID != '')
    $branch_id = $request->BranchID;
    else
    $branch_id = session::get('BranchID');

    $monYear = date('M-Y', strtotime($current_monYear));

    $active_monthYear = date('Y-m', strtotime($current_monYear));
    //dd($current_monYear);

    $fcbsummary = DB::table('v_live_account')
    ->select('EmployeeID','FirstName','MiddleName','LastName',DB::raw('count(LiveAccountID) as tot'))
    ->where('MonthName', $monYear)
    ->where('BranchID',$branch_id)
    ->orderBy(DB::raw('count(LiveAccountID)'), 'desc')
    ->groupBy('EmployeeID','FirstName','MiddleName','LastName')->get();


    foreach ($fcbsummary as $emp)
    $fcb_employee[] = $emp->EmployeeID;


    $unfcbemployee = '';
    if(!empty($fcb_employee))
    $unfcbemployee = DB::table('employee')->whereNotIn('EmployeeID', $fcb_employee)->where('BranchID',$branch_id)->get();


    $monthly_target = DB::table('monthly_target')
    ->where('MonthName', $monYear)
    ->where('BranchID',$branch_id)
    ->orderBy('eDate', 'desc')->first();

    //dd($monthly_target,$monYear,$branch_id);
    //dd($fcbsummary,$start_date, $end_date,$branch_id);

    $branch = DB::table('branch')->get();

    $employee = DB::table('employee')->get();


    $start    = date('Y-m-01', strtotime($current_monYear));
    $end      = date('Y-m-t', strtotime($current_monYear));

    if(date('m',strtotime($current_monYear)) == date('m'))
    {
        $elapsed_end = date('Y-m-d');
    }
    else
    {
        $elapsed_end = date('Y-m-t', strtotime($current_monYear));
    }

    if($monthly_target)
    {
        $target_detail = MonthlyTarget::getTargetDetail($monthly_target->MonthlyTargetID,$monthly_target->CurrentTarget);
        $current_target =  $target_detail->target;
        $live_target    =  ($target_detail->target*$monthly_target->LiveTarget);

        if($monthly_target->DisableDays != '')
        {
        $disable_dates = json_decode($monthly_target->DisableDays);
        $holidays = $disable_dates;
        }else
        {
           $holidays = []; 
        }

    }else{

        $current_target = 0;
        $live_target = 0;
        $holidays = [];

    }

    $working_days = $this->get_total_days($start, $end, $holidays); 

    $elapsed_days = $this->get_total_days($start, $elapsed_end, $holidays); 

    $Daily_Live_Target = round(($elapsed_days+1)*($live_target/$working_days));

    return view ('top_live_account',compact('fcbsummary','employee','branch','branch_id','active_monthYear','monthly_target','current_target','live_target','working_days','elapsed_days','Daily_Live_Target','unfcbemployee')); 
    }

    function get_total_days($start, $end, $holidays = [], $weekends = ['Sun'])
    {
        $start = new \DateTime($start);
        $end   = new \DateTime($end);
        $end->modify('+1 day');

        $total_days = $end->diff($start)->days;
        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);

        foreach($period as $dt) {
            if (in_array($dt->format('D'),  $weekends) || in_array($dt->format('Y-m-d'), $holidays)){
                $total_days--;
            }
        }
        return $total_days;
    }
}