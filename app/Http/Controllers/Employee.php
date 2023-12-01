<?php

namespace App\Http\Controllers;

use App\Models\T1;
use Carbon\Carbon;
use Illuminate\Http\Request;


use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use URL;
use Image;
use Excel;
use File;


class Employee extends Controller
{

    public function StaffDashboard()
    {
        $employee  = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();

        return view('staff.staff_dashboard', compact('employee'));
    }


    public function StaffDocuments()
    {

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $documents = DB::table('v_documents')->where('EmployeeID', Session::get('EmployeeID'))->get();

        return view('staff.staff_document', compact('employee', 'documents'));
    }


    public function StaffSalary()
    {

        $salary = DB::table('salary')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        return view('staff.staff_salary', compact('salary', 'employee'));
    }



    public function StaffComission($EmployeeID, $MonthName)
    {

        $fcb = DB::table('v_fcb')->where('EmployeeID', $EmployeeID)->where('MonthName', $MonthName)->get();
        $employee = DB::table('v_employee')->where('EmployeeID', $EmployeeID)->get();
        $fcbsummary = DB::table('v_fcb')
            ->select('EmployeeID', DB::raw('sum(FTDAmount) as sum'), DB::raw('count(FTDAmount) as tot'))
            ->where('EmployeeID', $EmployeeID)->where('MonthName', $MonthName)
            ->groupBy('EmployeeID')
            ->get();

        return view('staff.staff_comission', compact('fcb', 'employee'));
    }

    function StaffLetters()
    {





        $letter = DB::table('letter')->get();
        $issue_letter = DB::table('issue_letter')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('staff.staff_letter', compact('letter', 'issue_letter', 'employee'));
    }






    public function StaffLeave()
    {









        $leave = DB::table('v_leave')->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $branch = DB::table('branch')->where('BranchID', Session::get('BranchID'))->get();

        $leave_type = DB::table('leave_type')->get();


        Session::put('StartDate', $employee[0]->StartDate);


        $to = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $employee[0]->StartDate);

        $diff_in_months = $to->diffInMonths($from);

        Session::put('Months', $diff_in_months);




        return view('staff.staff_leave', compact('leave', 'employee', 'branch', 'leave_type'));
    }


    public function ajax_StaffLeave(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('v_leave')->where('EmployeeID', Session::get('EmployeeID'))->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // if you want to use direct link instead of dropdown use this line below


                    $btn = '


                          <a href="javascript:void(0)" onclick="delete_confirm2(`StaffLeaveDelete`,' . $row->LeaveID . ')" class="dropdown-item">  Delete</a>

                                                            ';

                    //class="edit btn btn-primary btn-sm"
                    // <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('staff.staff_leave');
    }




    public function ajax_leave_validate($leavetypeid, $employeeid)
    {



        $month = date('F-Y');


        if (Session::get('MonthName') > 5) {
            return 'Leave is not allowed in probition period';
        }






        $leave = DB::table('leave_detail')->where('EmployeeID', $employeeid)->where('LeaveTypeID', $leavetypeid)->get();


        $v_leave_summary = DB::table('v_leave_summary')->where('EmployeeID', $employeeid)->where('LeaveTypeID', $leavetypeid)->get();

        return view('staff.ajax_leave_validate', compact('v_leave_summary', 'leave', 'leavetypeid', 'employeeid'));
    }







    public function StaffLeaveSave(request $request)
    {



        $this->validate(
            $request,
            [
                'EmployeeID' => 'required',
                'BranchID' => 'required',
                // 'mobile'=>'required|min:11|numeric',
                'FromDate' => 'required | date_format:d/m/Y',
                'ToDate' => 'required | date_format:d/m/Y',
                'Reason' => 'required',


                // 'email'=>'required | email|unique:user',
            ],
            [
                'EmployeeID.required' => 'Employee Name is  required',
                'BranchID.required' => 'Branch is required',
                'FromDate.required' => 'Leave Start Date is required',
                'FromDate.date_format' => 'Leave start date does not match the format d/m/Y.',


                'ToDate.required' => 'Leave End Date is required',
                'ToDate.date_format' => 'Leave end date does not match the format d/m/Y.',
                'Reason.required' => 'Reason is required',



            ]
        );






        // return redirect()->back()->with('error', 'You access is limited')->with('class','danger') ->withInput();




        $employee = DB::table('employee')->where('EmployeeID', $request->EmployeeID)->get();

        $startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $employee[0]->StartDate);
        $todaydate = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $diff_in_months = $todaydate->diffInMonths($startdate);



        // $month=date('F-Y');




        //     if(($diff_in_months<=6) &&($request->LeaveTypeID!=11))
        //     {
        //        return redirect('StaffLeave')->with('error','Leave not allowed in probition period')->with('class','danger');
        //     }



        // annual leave 1











        $data = array(
            'BranchID' => $request->BranchID,
            'EmployeeID' => $request->EmployeeID,
            'LeaveTypeID' => $request->LeaveTypeID,
            'FromDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('FromDate')))),
            'ToDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('ToDate')))),
            'Reason' => $request->Reason,
            'FromTime' => ($request->LeaveTypeID == 2) ? $request->FromTime : '00:00',
            'ToTime' => ($request->LeaveTypeID == 2) ? $request->ToTime : '00:00'

        );


        $leaveid = DB::table('leave')->insertGetId($data);






        $start_date = dateformatpc($request->FromDate);
        $start_date = date("Y-m-d", strtotime("-1 days", strtotime($start_date)));


        $end_date = dateformatpc($request->ToDate);

        while (strtotime($start_date) < strtotime($end_date)) {




            echo $start_date . "<BR>";
            $start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));



            $leave_detail = array(

                'LeaveID' => $leaveid,
                'EmployeeID' => $request->EmployeeID,
                'LeaveTypeID' => $request->LeaveTypeID,
                'Date' => $start_date,

                'FromTime' => ($request->LeaveTypeID == 2) ? $request->FromTime : '00:00',
                'ToTime' => ($request->LeaveTypeID == 2) ? $request->ToTime : '00:00',
                'PaymentStatus' => $request->PaymentStatus,

            );



            $id = DB::table('leave_detail')->insertGetId($leave_detail);
        }








        if ($diff_in_months < 5) {
            return redirect('StaffLeave')->with('error', 'Leave Saved but you are not entitled to apply for Leave')->with('class', 'danger');
        } else {
            return redirect('StaffLeave')->with('error', 'Leave Saved Successfully')->with('class', 'success');
        }
    }


    public function StaffLeaveDelete($id)
    {


        $id = DB::table('leave')->where('LeaveID', $id)->where('OMStatus', 'Pending')->delete();


        DB::table('leave_detail')->where('LeaveID', $id)->delete();


        if ($id) {
            return redirect('/StaffLeave')->with('error', 'Deleted Successfully')->with('class', 'success');
        } else {
            return redirect('/StaffLeave')->with('error', 'Error Deleting Leave Application')->with('class', 'danger');
        }
    }


    function StaffAttendance()
    {


        $attendance = T1::where('EmployeeID', Session::get('EmployeeID'))->orderBy('created_at', 'desc')->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $attendances = DB::table('v_employee_attendance')
            ->where('EmployeeID', Session::get('EmployeeID'))
            ->get();


        return view('staff.staff_attendance', compact('attendance', 'employee', 'attendances'));
    }


    function StaffFCB()
    {


        $fcb = DB::table('v_fcb')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('staff.staff_fcb', compact('fcb', 'employee'));
    }


    public function StaffTeam()
    {

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();

        $team = DB::table('v_employee')->where('SupervisorID', Session::get('EmployeeID'))->get();


        return view('staff.staff_team', compact('employee', 'team'));
    }



    public function StaffDailyReport()
    {

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();

        $daily_report = DB::table('daily_report')->where('EmployeeID', Session::get('EmployeeID'))->get();

        $new_daily_report = DB::table('v_daily_report')->where('SupervisorID', Session::get('EmployeeID'))->get();


        return view('staff.staff_dailyreport', compact('employee', 'daily_report', 'new_daily_report'));
    }



    public function DailyReportSave(request $request)
    {




        if ($request->file('File') != null) {

            $this->validate($request, [

                // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
                'File' => 'required|mimes:jpeg,png,jpg,gif,xlsx,pdf,doc,docx,rtf,ppt|max:40000',

            ]);

            $file = $request->file('File');
            $input['filename'] = time() . '.' . $file->extension();





            $destinationPath = public_path('/reports');

            $file->move($destinationPath, $input['filename']);

            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $input['imagename']);

            // $input['filename']===========is final data in it.



            $data = array(

                'EmployeeID' => $request->EmployeeID,
                'Title' => $request->Title,
                'Detail' => $request->Detail,
                'Date' => dateformatpc($request->Date),
                'File' => $input['filename'],

            );
        } else {


            $data = array(

                'EmployeeID' => $request->EmployeeID,
                'Title' => $request->Title,
                'Detail' => $request->Detail,
                'Date' => dateformatpc($request->Date)

            );
        }




        $id = DB::table('daily_report')->insertGetId($data);




        return redirect('StaffDailyReport')->with('error', 'Save Successfully')->with('class', 'success');
        ('staff.staff_dailyreport');
    }


    public function StaffDailyReportEdit($id)
    {

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();

        $daily_report = DB::table('daily_report')->where('DailyReportID', $id)->get();




        return view('staff.staff_dailyreport_edit', compact('employee', 'daily_report'));
    }



    public function DailyReportUpdate(request $request)
    {




        $data = array(


            'Title' => $request->Title,
            'Detail' => $request->Detail,
            'SupervisorComments' => $request->SupervisorComments,


        );


        $id = DB::table('daily_report')->where('DailyReportID', '=', $request->DailyReportID)->update($data);





        return redirect('StaffDailyReport')->with('error', 'Updated Successfully')->with('class', 'success');
        ('staff.staff_dailyreport');
    }


    public function StaffDailyReportDelete($id)
    {


        $id = DB::table('daily_report')->where('DailyReportID', $id)->delete();

        return redirect('/StaffDailyReport')->with('error', 'Deleted Successfully')->with('class', 'success');
    }


    public function StaffLead()
    {
        $pagetitle = 'Staff Lead';
        $employee = DB::table('v_employee')->get();

        $lead = DB::table('lead')->get();

        return view('staff.staff_lead', compact('pagetitle', 'employee', 'lead'));
    }

    public function StaffLeadSave(request $request)
    {


        $data = array(

            'Name' => $request->Name,
            'EmployeeID' => Session::get('EmployeeID'),
            'Phone' => $request->Phone,
            'Email' => $request->Email,
            'CompanyName' => $request->CompanyName,
            'LeadStage' => $request->LeadStage,
            'BusinessType' => $request->BusinessType,
            'LeadStage' => $request->LeadStage,
            'Date' => dateformatpc($request->Date),

        );



        $id = DB::table('lead')->insertGetId($data);


        return redirect('StaffLead')->with('error', 'Save Successfully')->with('class', 'success');
    }

    public function StaffLeadDelete($id)
    {


        $id = DB::table('lead')->where('LeadID', $id)->delete();

        return redirect('StaffLead')->with('error', 'Deleted Successfully')->with('class', 'success');
    }
    public function StaffDeal()
    {
        $pagetitle = 'Staff Lead';
        $employee = DB::table('v_employee')->get();

        $deal = DB::table('deal')->get();

        return view('staff.staff_deal', compact('pagetitle', 'employee', 'deal'));
    }

    public function StaffDealSave(request $request)
    {


        $data = array(

            'EmployeeID' => Session::get('EmployeeID'),
            'Name' => $request->Name,
            'CompanyName' => $request->CompanyName,
            'Phone' => $request->Phone,
            'ExpectedCloserDate' => dateformatpc($request->ExpectedCloserDate),
            'DealValue' => $request->DealValue,
            'DealStatus' => $request->DealStatus,
            'Notes' => $request->Notes,

            'Date' => dateformatpc($request->Date),

        );



        $id = DB::table('deal')->insertGetId($data);


        return redirect('StaffDeal')->with('error', 'Save Successfully')->with('class', 'success');
    }


    public function StaffDealDelete($id)
    {

        $id = DB::table('deal')->where('DealID', $id)->delete();

        return redirect('StaffDeal')->with('error', 'Deleted Successfully')->with('class', 'success');
    }



    public function StaffTarget()
    {
        $pagetitle = 'Staff Lead';
        $employee = DB::table('v_employee')->get();

        $target = DB::table('v_target')->get();

        return view('staff.staff_target', compact('pagetitle', 'employee', 'target'));
    }


    public function StaffTargetReply($id)
    {
        $pagetitle = 'Staff Lead';
        $employee = DB::table('v_employee')->get();

        $target = DB::table('v_target')->where('TargetID', $id)->get();

        return view('staff.staff_target_reply', compact('pagetitle', 'employee', 'target'));
    }

    public function StaffTargetReplySave(request $request)
    {


        $data = array(

            'TargetID' => $request->TargetID,
            'EmployeeID' => Session::get('EmployeeID'),

            'Detail' => $request->Detail,

            'Date' => dateformatpc($request->Date),


        );



        $id = DB::table('target_reply')->insertGetId($data);


        return redirect('StaffTarget')->with('error', 'Save Successfully')->with('class', 'success');
    }


    public function StaffTargetReplyDelete($id)
    {

        $id = DB::table('target_reply')->where('TargetReplyID', $id)->delete();

        return redirect('StaffTarget')->with('error', 'Deleted Successfully')->with('class', 'success');
    }




    public function StaffNoticeBoard()
    {


        $pagetitle = 'Daily Report';

        $notice = DB::table('notice_board')->where('Status', 'Publish')->orderby('Date', 'desc')->get();

        return view('staff.staff_notice_board', compact('pagetitle', 'notice'));
    }


    public function NoticeBoardView($id)
    {


        $pagetitle = 'Daily Report';

        $notice = DB::table('notice_board')->where('Status', 'Publish')->where('NoticeBoardID', $id)->get();

        return view('staff.notice_board_view', compact('pagetitle', 'notice'));
    }

    public function EmployeeExport($branchId)
    {
        // dd($branchId);
        try {
            ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
            $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Search Salary', 'List');
            if ($allow[0]->Allow == 'N') {
                return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
            }
            ////////////////////////////END SCRIPT ////////////////////////////////////////////////
            $pagetitle = 'Print Empolyee Data';
            $headers = [
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0', 'Content-type'  => 'text/csv', 'Content-Disposition' => 'attachment; filename=EmployeeDetails.csv', 'Expires'  => '0', 'Pragma' => 'public',
            ];
            $data = DB::table('employee')->where('BranchID', $branchId)->get();
            $branchName = DB::table('branch')->select('BranchName')->where('BranchID', $branchId)->first();
            // dd($data);
            $employees = [];
            foreach ($data as $key => $datum) {
                $JobTitleName = DB::table('jobtitle')->select('JobTitleName')->where('JobTitleID', $datum->JobTitleID)->first();
                $DepartmentName = DB::table('department')->select('DepartmentName')->where('DepartmentID', $datum->DepartmentID)->first();
                $supervisor = DB::table('employee')->select('FirstName', 'MiddleName', 'LastName')->where('EmployeeID', $datum->SupervisorID)->first();
                $dataArray = [];
                $dataArray['Branch'] = $branchName->BranchName;
                $dataArray['Title'] = $datum->Title != null ? $datum->Title : 'N/A';
                $dataArray['First Name'] = $datum->FirstName != null ? $datum->FirstName : 'N/A';
                $dataArray['Middle Name'] = $datum->MiddleName != null ? $datum->MiddleName :  'N\A';
                $dataArray['Last Name'] = $datum->LastName != null ? $datum->LastName :  'N\A';
                $dataArray['Date of Birth'] = $datum->DateOfBirth != null ? $datum->DateOfBirth :  'N\A';
                $dataArray['Is Supervisor'] = $datum->IsSupervisor != null ? $datum->IsSupervisor :  'N\A';
                $dataArray['Gender'] = $datum->Gender != null ? $datum->Gender :  'N\A';
                $dataArray['Email'] = $datum->Email != null ? $datum->Email :  'N\A';
                $dataArray['Nationality'] = $datum->Nationality != null ? $datum->Nationality :  'N\A';
                $dataArray['Mobile No.'] = $datum->MobileNo != null ? $datum->MobileNo :  'N\A';
                $dataArray['Home Phone'] = $datum->HomePhone != null ? $datum->HomePhone :  'N\A';
                $dataArray['Full Address'] = $datum->FullAddress != null ? $datum->FullAddress :  'N\A';
                $dataArray['Education Level'] = $datum->EducationLevel != null ? $datum->EducationLevel :  'N\A';
                $dataArray['Last Degree'] = $datum->LastDegree != null ? $datum->LastDegree :  'N\A';

                $dataArray['MaritalStatus'] = $datum->MaritalStatus != null ? $datum->MaritalStatus :  'N\A';
                $dataArray['Spouse Name'] = $datum->SpouseName != null ? $datum->SpouseName :  'N\A';
                $dataArray['Spouse Address'] = $datum->SpouseEmployer != null ? $datum->SpouseEmployer :  'N\A';
                $dataArray['Spouse Work Phone'] = $datum->SpouseWorkPhone != null ? $datum->SpouseWorkPhone :  'N\A';
                $dataArray['Visa Issue Date'] = $datum->VisaIssueDate != null ? $datum->VisaIssueDate :  'N\A';
                $dataArray['Visa Expiry Date'] = $datum->VisaExpiryDate != null ? $datum->VisaExpiryDate :  'N\A';
                $dataArray['Passport No'] = $datum->PassportNo != null ? $datum->PassportNo :  'N\A';
                $dataArray['Passport Expiry'] = $datum->PassportExpiry != null ? $datum->PassportExpiry :  'N\A';
                $dataArray['Emirates ID No'] = $datum->EidNo != null ? $datum->EidNo :  'N\A';
                $dataArray['Eid Expiry'] = $datum->EidExpiry != null ? $datum->EidExpiry :  'N\A';
                $dataArray['Next of Kin Name'] = $datum->NextofKinName != null ? $datum->NextofKinName :  'N\A';
                $dataArray['Next of Kin Address'] = $datum->NextofKinAddress != null ? $datum->NextofKinAddress :  'N\A';
                $dataArray['Next of KinPhone'] = $datum->NextofKinPhone != null ? $datum->NextofKinPhone :  'N\A';
                $dataArray['Next of Kin Relationship'] = $datum->NextofKinRelationship != null ? $datum->NextofKinRelationship :  'N\A';
                $dataArray['Bank Name'] = $datum->BankName != null ? $datum->BankName :  'N\A';
                $dataArray['IBAN #'] = $datum->IBAN != null ? $datum->IBAN :  'N\A';
                $dataArray['Account Title'] = $datum->AccountTitle != null ? $datum->AccountTitle :  'N\A';
                $dataArray['Salary Type'] = $datum->SalaryType != null ? $datum->SalaryType :  'N\A';
                $dataArray['Job Title'] = $JobTitleName != null ? $JobTitleName->JobTitleName :  'N\A';
                $dataArray['Department'] = $DepartmentName != null ? $DepartmentName->DepartmentName :  'N\A';
                $dataArray['Supervisor'] = $supervisor != null ? $supervisor->FirstName . ' ' . $supervisor->MiddleName . ' ' . $supervisor->LastName :  'N\A';
                $dataArray['Work Location'] = $datum->WorkLocation != null ? $datum->WorkLocation :  'N\A';
                $dataArray['Email Offical'] = $datum->EmailOffical != null ? $datum->EmailOffical :  'N\A';
                $dataArray['Work Phone'] = $datum->WorkPhone != null ? $datum->WorkPhone :  'N\A';
                $dataArray['Date of Joining'] = $datum->StartDate != null ? $datum->StartDate :  'N\A';
                $dataArray['Salary'] = $datum->Salary != null ? $datum->Salary :  'N\A';
                $dataArray['Comisison'] = $datum->ExtraComission != null ? $datum->ExtraComission :  'N\A';
                $dataArray['Salary Remarks'] = $datum->SalaryRemarks != null ? $datum->SalaryRemarks :  'N\A';
                array_push($employees, $dataArray);
            }
            array_unshift($employees, array_keys($employees[0]));
            $callback = function () use ($employees) {
                $FH = fopen('php://output', 'w');
                foreach ($employees as $row) {
                    fputcsv($FH, $row);
                }
                fclose($FH);
            };
            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
            //throw $th;
        }
    }

    public function ApproveStaffLeave($id)
    {
        date_default_timezone_set('Asia/Dubai');

        // Get the current date and time in Dubai time zone
        $today_date = date('Y-m-d H:i:s');
        $data = [
            'OMStatus' => 'Yes',
            'OMRemarks' => 'Approved',
            'OMStatusDate' => $today_date
        ];
        DB::table('leave')->where('LeaveID', $id)->update($data);
        return redirect()->back()->with('error', 'Approved Successfully')->with('class', 'success');
    }

    public function RejectStaffLeave($id)
    {
        date_default_timezone_set('Asia/Dubai');

        // Get the current date and time in Dubai time zone
        $today_date = date('Y-m-d H:i:s');
        $data = [
            'OMStatus' => 'No',
            'OMRemarks' => 'Rejected',
            'OMStatusDate' => $today_date
        ];
        DB::table('leave')->where('LeaveID', $id)->update($data);
        return redirect()->back()->with('error', 'Rejected Successfully')->with('class', 'success');
    }
    public function AddTeamMemDayTask($id)
    {
        $employee = DB::table('v_employee')->where('EmployeeID', $id)->get();
        return view('staff.addTeamMemTask', compact('id', 'employee'));
    }

    ///////////////////////
}
