<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\T1;
use Barryvdh\DomPDF\Facade\Pdf;
// for excel export
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
// end for excel export
use URL;
use Image;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Maatwebsite\Excel\Facades\Excel;

class HR extends Controller
{
    public function index()
    {
    }



    public  function SalarySlip($id = null)
    {


        $branch = DB::table('branch')->get();

        if ($id) {

            $salary = DB::table('salary')->where('EmployeeID', Session::get('EmployeeID'))->where('SalaryID', $id)->orderby('SalaryID', 'desc')->first();
        } else {

            $salary = DB::table('salary')->where('EmployeeID', Session::get('EmployeeID'))->orderby('SalaryID', 'desc')->first();


            if ($salary == null) {


                return redirect()->back()->with('error', 'No salary issued so far')->with('class', 'success');
            }
        }







        // $customPaper = array(0,0,297 ,210 );
        $pdf = PDF::loadView('salary_slip_pdf', compact('branch', 'salary'));
        // $pdf->setpaper($customPaper);
        $pdf->setpaper('A4', 'potrait');

        $pdf->save('uploads/' . strtotime(date('Y-m-d H:i:s')) . '.pdf');
        return $pdf->stream('test_pdf.pdf');
        // return $pdf->download('itsolutionstuff.pdf');
    }




    public function Login()
    {
        if (Session::has('FullName')) {
            return back();
        }
        return view('login');
    }

    public function UserVerify(request $request)
    {
        if ($request->StaffType == 'Management') {
            // dd('here');
            $username = $request->input('username');
            $password =  $request->input('password');
            $data = DB::table('users')->where('Email', '=', $username)
                ->where('Password', '=', $password)
                ->where('Active', '=', 'Y')
                ->get();
            if (count($data) > 0) {
                Session::put('FullName', $data[0]->FullName);
                Session::put('UserID', $data[0]->UserID);
                Session::put('Email', $data[0]->Email);
                Session::put('UserType', $data[0]->UserType);
                Session::put('BranchID', $data[0]->BranchID);
                if (Session::get('UserType') == 'HR') {
                    return redirect('Dashboard')->with('error', 'Welcome to Extensive HR System')->with('class', 'success');
                } elseif (Session::get('UserType') == 'GM') {
                    return redirect('Dashboard')->with('error', 'Welcome to Extensive HR System')->with('class', 'success');
                } elseif (Session::get('UserType') == 'OM') {
                    return redirect('Dashboard')->with('error', 'Welcome to Extensive HR System')->with('class', 'success');
                }
            } else {
                return back()->withinput($request->all())->with('error', 'Invalid username or Password. Try again');
            }
        } else {
            $username = $request->input('username');
            $password =  $request->input('password');
            $data = DB::table('employee')->where('Email', '=', $username)
                ->where('Password', '=', $password)
                // ->where('Active', '=', 'Y' )
                ->get();
            if (count($data) > 0) {
                Session::put('FullName', $data[0]->FirstName . ' ' . $data[0]->MiddleName . ' ' . $data[0]->LastName);
                Session::put('EmployeeID', $data[0]->EmployeeID);
                Session::put('Email', $data[0]->Email);
                Session::put('StaffType', $data[0]->StaffType);
                Session::put('BranchID', $data[0]->BranchID);
                $today = Carbon::today()->format('Y-m-d');
                $data = DB::table('t1')->where('date', $today)->where('EmployeeID', Session::get('UserID'))->latest()->first();
                // dd(Session::get('StaffType'));
                return redirect('StaffDashboard');
            } else {
                return back()->withinput($request->all())->with('error', 'Invalid username or Password. Try again');
            }
        }
    }
    public function Dashboard()
    {
        $pagetitle = 'Dashboard';
        $data = DB::table('v_employee')->get();
        $visaexpiry = DB::table('v_visaexpiry')->get();
        $passportexpiry = DB::table('v_passportexpiry')->get();

        if (Session::get('UserType') == 'OM') {
            $where = array('OMStatus' => 'Pending');
        } elseif (Session::get('UserType') == 'HR') {
            $where = array(
                'OMStatus' => 'Yes',
                'HRStatus' => 'Pending'
            );
        } else {
            $where = array(
                'OMStatus' => 'Yes',
                'HRStatus' => 'Yes',
                'GMStatus' => 'Pending'
            );
        }

        $leave_alert = DB::table('v_leave')->where($where)->get();
        return view('dashboard', compact('pagetitle', 'visaexpiry', 'passportexpiry', 'leave_alert'));
    }




    public function Employee()
    {
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee', 'List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        return view('employee');
    }



    public function ajax_employee(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('v_employee')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // if you want to use direct link instead of dropdown use this line below
                    // <a href="javascript:void(0)"  onclick="edit_data('.$row->customer_id.')" >Edit</a> | <a href="javascript:void(0)"  onclick="del_data('.$row->customer_id.')"  >Delete</a>




                    $btn = '

                           <div class="dropdown">
                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
<i class="mdi mdi-dots-horizontal font-size-18"></i></a>

      <ul class="dropdown-menu dropdown-menu-end" style="margin: 0px;">
<li><a onclick="view_data(' . $row->EmployeeID . ')"href="javascript:void(0)"  class="dropdown-item"><i class="mdi mdi-eye font-size-16 text-secondary me-1"></i> View</a></li>

<li><a onclick="edit_data(' . $row->EmployeeID . ')"href="javascript:void(0)"  class="dropdown-item"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>

<li><a href="javascript:void(0)" onclick="delete_confirm2(' . $row->EmployeeID . ')" class="dropdown-item"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Delete</a></li>
                                                                </ul>
                                                            </div>';

                    //class="edit btn btn-primary btn-sm"
                    // <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee');
    }


    public function EmployeeDetail($id = null)


    {



        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee', 'Detail');
        if ($allow[0]->Allow == 'N') {
            return redirect('Dashboard')->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        if ($id) {

            Session::put('EmployeeID', $id);
        }

        if (!Session('EmployeeID')) {


            return redirect('Employee')->with('error', 'Session Expired')->with('class', 'success');
        }





        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        Session::put('StartDate', $employee[0]->StartDate);


        $to = \Carbon\Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $employee[0]->StartDate);

        $diff_in_months = $to->diffInMonths($from);

        Session::put('Months', $diff_in_months);





        return view('employee_detail', compact('employee'));
    }





    public  function logout()
    {
        Session::flush(); // removes all Session data
        return redirect('/')->with('error', 'Logout Successfully.');
    }






    public function EmployeeEdit($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        // $employee = DB::table('v_employee')->where('EmployeeID',Session::get('EmployeeID'))->get();

        $branch = DB::table('branch')->get();
        $title = DB::table('title')->get();
        $jobtitle = DB::table('jobtitle')->get();
        $staff_type = DB::table('staff_type')->get();
        $employee = DB::table('employee')->where('EmployeeID', $id)->get();
        $supervisor = DB::table('employee')->where('IsSupervisor', 'Yes')->get();
        $department = DB::table('department')->get();
        $country = DB::table('country')->get();
        $educationlevel = DB::table('educationlevel')->get();



        return view('employeeedit', compact('branch', 'jobtitle', 'department', 'educationlevel', 'department', 'supervisor', 'employee', 'title', 'staff_type', 'country'));
    }



    public function EmployeeUpdate(request $request)
    {




        $this->validate(
            $request,
            [
                'BranchID' => 'required',
                'FirstName' => 'required',
                'DateOfBirth' => 'required | date_format:d/m/Y',


                // 'Email'=>'required | email',
                // 'password'=>'required|min:6',
                // 'confirm_password'=>'required_with:password|same:password|min:6'   ,

                // 'mobile'=>'required|min:11|numeric|unique:user',
                'Email' => 'required | Email',
            ],
            [
                'BranchID.required' => 'Branch is  required',
                'FirstName.required' => 'First Name is required',
                'DateOfBirth.required' => 'Date Of Birth is required',



            ]
        );







        if ($request->file('UploadSlip') != null) {

            $this->validate($request, [

                // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
                'UploadSlip' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',

            ]);

            $file = $request->file('UploadSlip');
            $input['filename'] = time() . '.' . $file->extension();





            $destinationPath = public_path('/emp-picture');

            $file->move($destinationPath, $input['filename']);

            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $input['imagename']);

            // $input['filename']===========is final data in it.













            $data   = array(

                "IsSupervisor" => $request->input('IsSupervisor'),
                "Title" => $request->input('Title'),
                "FirstName" => $request->input('FirstName'),
                "MiddleName" => $request->input('MiddleName'),
                "LastName" => $request->input('LastName'),
                "DateOfBirth" => ($request->input('DateOfBirth') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('DateOfBirth')))),
                "Gender" => $request->input('Gender'),
                "Email" => $request->input('Email'),
                "Password" => $request->input('Password'),
                "Nationality" => $request->input('Nationality'),
                "MobileNo" => $request->input('MobileNo'),
                "HomePhone" => $request->input('HomePhone'),
                "FullAddress" => $request->input('FullAddress'),
                "EducationLevel" => $request->input('EducationLevel'),
                "LastDegree" => $request->input('LastDegree'),
                "MaritalStatus" => $request->input('MaritalStatus'),
                "SSNorGID" => $request->input('SSNorGID'),
                "SpouseName" => $request->input('SpouseName'),
                "SpouseEmployer" => $request->input('SpouseEmployer'),
                "SpouseWorkPhone" => $request->input('SpouseWorkPhone'),
                "VisaIssueDate" => ($request->input('VisaIssueDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaIssueDate')))),
                "VisaExpiryDate" => ($request->input('VisaExpiryDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaExpiryDate')))),
                "PassportNo" => $request->input('PassportNo'),
                "PassportExpiry" => ($request->input('PassportExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('PassportExpiry')))),
                "EidNo" => $request->input('EidNo'),
                "EidExpiry" => ($request->input('EidExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('EidExpiry')))),
                "NextofKinName" => $request->input('NextofKinName'),
                "NextofKinAddress" => $request->input('NextofKinAddress'),
                "NextofKinPhone" => $request->input('NextofKinPhone'),
                "NextofKinRelationship" => $request->input('NextofKinRelationship'),
                "JobTitleID" => $request->input('JobTitleID'),
                "DepartmentID" => $request->input('DepartmentID'),
                "SupervisorID" => $request->input('SupervisorID'),
                "WorkLocation" => $request->input('WorkLocation'),
                "EmailOffical" => $request->input('EmailOffical'),
                "WorkPhone" => $request->input('WorkPhone'),
                "StartDate" => ($request->input('StartDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('StartDate')))),

                "Salary" => $request->input('Salary'),
                "ExtraComission" => $request->input('ExtraComission'),
                "SalaryRemarks" => $request->input('SalaryRemarks'),
                "StaffType" => $request->input('StaffType'),

                "Picture" => $input['filename'],

                "BankName" => $request->input('BankName'),
                "IBAN" => $request->input('IBAN'),
                "AccountTitle" => $request->input('AccountTitle'),
                "SalaryType" => $request->input('SalaryType'),

            );
        } else {


            $data   = array(

                "IsSupervisor" => $request->input('IsSupervisor'),
                "Title" => $request->input('Title'),
                "FirstName" => $request->input('FirstName'),
                "MiddleName" => $request->input('MiddleName'),
                "LastName" => $request->input('LastName'),
                "DateOfBirth" => ($request->input('DateOfBirth') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('DateOfBirth')))),
                "Gender" => $request->input('Gender'),
                "Email" => $request->input('Email'),
                "Password" => $request->input('Password'),
                "Nationality" => $request->input('Nationality'),
                "MobileNo" => $request->input('MobileNo'),
                "HomePhone" => $request->input('HomePhone'),
                "FullAddress" => $request->input('FullAddress'),
                "EducationLevel" => $request->input('EducationLevel'),
                "LastDegree" => $request->input('LastDegree'),
                "MaritalStatus" => $request->input('MaritalStatus'),
                "SSNorGID" => $request->input('SSNorGID'),
                "SpouseName" => $request->input('SpouseName'),
                "SpouseEmployer" => $request->input('SpouseEmployer'),
                "SpouseWorkPhone" => $request->input('SpouseWorkPhone'),
                "VisaIssueDate" => ($request->input('VisaIssueDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaIssueDate')))),
                "VisaExpiryDate" => ($request->input('VisaExpiryDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaExpiryDate')))),
                "PassportNo" => $request->input('PassportNo'),
                "PassportExpiry" => ($request->input('PassportExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('PassportExpiry')))),
                "EidNo" => $request->input('EidNo'),
                "EidExpiry" => ($request->input('EidExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('EidExpiry')))),
                "NextofKinName" => $request->input('NextofKinName'),
                "NextofKinAddress" => $request->input('NextofKinAddress'),
                "NextofKinPhone" => $request->input('NextofKinPhone'),
                "NextofKinRelationship" => $request->input('NextofKinRelationship'),
                "JobTitleID" => $request->input('JobTitleID'),
                "DepartmentID" => $request->input('DepartmentID'),
                "SupervisorID" => $request->input('SupervisorID'),
                "WorkLocation" => $request->input('WorkLocation'),
                "EmailOffical" => $request->input('EmailOffical'),
                "WorkPhone" => $request->input('WorkPhone'),
                "StartDate" => ($request->input('StartDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('StartDate')))),

                "Salary" => $request->input('Salary'),
                "ExtraComission" => $request->input('ExtraComission'),
                "SalaryRemarks" => $request->input('SalaryRemarks'),
                "StaffType" => $request->input('StaffType'),



                "BankName" => $request->input('BankName'),
                "IBAN" => $request->input('IBAN'),
                "AccountTitle" => $request->input('AccountTitle'),
                "SalaryType" => $request->input('SalaryType'),

            );
        }




        $id = DB::table('employee')->where('EmployeeID', $request->EmployeeID)->update($data);





        return redirect('EmployeeDetail/' . $request->EmployeeID)->with('error', ' Record Updated Successfully')->with('class', 'success');
    }


    public function EmployeeCreate()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee', 'Create');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $branch = DB::table('branch')->get();
        $title = DB::table('title')->get();
        $jobtitle = DB::table('jobtitle')->get();
        $staff_type = DB::table('staff_type')->get();
        $supervisor = DB::table('v_employee')->get();
        $department = DB::table('department')->get();
        $country = DB::table('country')->get();
        $educationlevel = DB::table('educationlevel')->get();



        return view('employeecreate', compact('branch', 'jobtitle', 'department', 'educationlevel', 'department', 'supervisor', 'title', 'staff_type', 'country'));
    }






    public function EmployeeSave(request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee', 'Create');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate(
            $request,
            [
                'BranchID' => 'required',
                'FirstName' => 'required',
                'DateOfBirth' => 'required | date_format:d/m/Y',


                'Email' => 'required | email',
                // 'password'=>'required|min:6',
                // 'confirm_password'=>'required_with:password|same:password|min:6'   ,

                // 'mobile'=>'required|min:11|numeric|unique:user',
                // 'Email'=>'required | Email|unique:employee',
            ],
            [
                'BranchID.required' => 'Branch is  required',
                'FirstName.required' => 'First Name is required',
                'DateOfBirth.required' => 'Date Of Birth is required',



            ]
        );



        if ($request->file('UploadSlip') != null) {

            $this->validate($request, [

                // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
                'UploadSlip' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',

            ]);

            $file = $request->file('UploadSlip');
            $input['filename'] = time() . '.' . $file->extension();

            $destinationPath = public_path('/emp-picture');

            $file->move($destinationPath, $input['filename']);



            $data   = array(

                "BranchID" => $request->input('BranchID'),
                "Title" => $request->input('Title'),
                "IsSupervisor" => $request->input('IsSupervisor'),
                "FirstName" => $request->input('FirstName'),
                "MiddleName" => $request->input('MiddleName'),
                "LastName" => $request->input('LastName'),
                "DateOfBirth" => ($request->input('DateOfBirth') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('DateOfBirth')))),
                "Gender" => $request->input('Gender'),
                "Email" => $request->input('Email'),
                "Nationality" => $request->input('Nationality'),
                "MobileNo" => $request->input('MobileNo'),
                "HomePhone" => $request->input('HomePhone'),
                "FullAddress" => $request->input('FullAddress'),
                "EducationLevel" => $request->input('EducationLevel'),
                "LastDegree" => $request->input('LastDegree'),
                "MaritalStatus" => $request->input('MaritalStatus'),
                "SSNorGID" => $request->input('SSNorGID'),
                "SpouseName" => $request->input('SpouseName'),
                "SpouseEmployer" => $request->input('SpouseEmployer'),
                "SpouseWorkPhone" => $request->input('SpouseWorkPhone'),
                "VisaIssueDate" => ($request->input('VisaIssueDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaIssueDate')))),
                "VisaExpiryDate" => ($request->input('VisaExpiryDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaExpiryDate')))),
                "PassportNo" => $request->input('PassportNo'),
                "PassportExpiry" => ($request->input('PassportExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('PassportExpiry')))),
                "EidNo" => $request->input('EidNo'),
                "EidExpiry" => ($request->input('EidExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('EidExpiry')))),
                "NextofKinName" => $request->input('NextofKinName'),
                "NextofKinAddress" => $request->input('NextofKinAddress'),
                "NextofKinPhone" => $request->input('NextofKinPhone'),
                "NextofKinRelationship" => $request->input('NextofKinRelationship'),
                "JobTitleID" => $request->input('JobTitleID'),
                "DepartmentID" => $request->input('DepartmentID'),
                "SupervisorID" => $request->input('SupervisorID'),
                "WorkLocation" => $request->input('WorkLocation'),
                "EmailOffical" => $request->input('EmailOffical'),
                "WorkPhone" => $request->input('WorkPhone'),
                "StartDate" => ($request->input('StartDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('StartDate')))),

                "Salary" => $request->input('Salary'),
                "ExtraComission" => $request->input('ExtraComission'),
                "SalaryRemarks" => $request->input('SalaryRemarks'),
                "StaffType" => $request->input('StaffType'),

                "Picture" => $input['filename'],


            );
        } else {


            $data   = array(

                "BranchID" => $request->input('BranchID'),
                "Title" => $request->input('Title'),
                "IsSupervisor" => $request->input('IsSupervisor'),
                "FirstName" => $request->input('FirstName'),
                "MiddleName" => $request->input('MiddleName'),
                "LastName" => $request->input('LastName'),
                "DateOfBirth" => ($request->input('DateOfBirth') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('DateOfBirth')))),
                "Gender" => $request->input('Gender'),
                "Email" => $request->input('Email'),
                "Nationality" => $request->input('Nationality'),
                "MobileNo" => $request->input('MobileNo'),
                "HomePhone" => $request->input('HomePhone'),
                "FullAddress" => $request->input('FullAddress'),
                "EducationLevel" => $request->input('EducationLevel'),
                "LastDegree" => $request->input('LastDegree'),
                "MaritalStatus" => $request->input('MaritalStatus'),
                "SSNorGID" => $request->input('SSNorGID'),
                "SpouseName" => $request->input('SpouseName'),
                "SpouseEmployer" => $request->input('SpouseEmployer'),
                "SpouseWorkPhone" => $request->input('SpouseWorkPhone'),
                "VisaIssueDate" => ($request->input('VisaIssueDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaIssueDate')))),
                "VisaExpiryDate" => ($request->input('VisaExpiryDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('VisaExpiryDate')))),
                "PassportNo" => $request->input('PassportNo'),
                "PassportExpiry" => ($request->input('PassportExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('PassportExpiry')))),
                "EidNo" => $request->input('EidNo'),
                "EidExpiry" => ($request->input('EidExpiry') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('EidExpiry')))),
                "NextofKinName" => $request->input('NextofKinName'),
                "NextofKinAddress" => $request->input('NextofKinAddress'),
                "NextofKinPhone" => $request->input('NextofKinPhone'),
                "NextofKinRelationship" => $request->input('NextofKinRelationship'),
                "JobTitleID" => $request->input('JobTitleID'),
                "DepartmentID" => $request->input('DepartmentID'),
                "SupervisorID" => $request->input('SupervisorID'),
                "WorkLocation" => $request->input('WorkLocation'),
                "EmailOffical" => $request->input('EmailOffical'),
                "WorkPhone" => $request->input('WorkPhone'),
                "StartDate" => ($request->input('StartDate') == null) ? null :  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('StartDate')))),

                "Salary" => $request->input('Salary'),
                "ExtraComission" => $request->input('ExtraComission'),
                "SalaryRemarks" => $request->input('SalaryRemarks'),
                "StaffType" => $request->input('StaffType'),


            );
        }



        $id = DB::table('employee')->insertGetId($data);


        return redirect('Employee')->with('error', ' Employee Record Saved Successfully')->with('class', 'success');
    }



    public function EmployeeDelete($id)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Branch', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect('Dashboard')->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('employee')->where('EmployeeID', $id)->delete();
        return redirect('Employee')->with('error', ' Deleted Successfully')->with('class', 'danger');
    }





    public  function EmployeeLoan()
    {
        $loan = DB::table('loan')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        return view('emp.emp_loan', compact('loan', 'employee'));
    }




    public function LoanSave(request $request)
    {


        // Start date
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('StartDate'))));



        // End date
        $end_date = date("Y-m-d", strtotime("+" . ($request->input('NoOfInstallment') - 1) . " month", strtotime($date)));




        $data1 = array(
            'EmployeeID' => Session::get('EmployeeID'),
            'RequestDate' => dateformatpc($request->input('RequestDate')),
            'Remarks' => $request->input('Remarks'),
            'Amount' => $request->input('Amount'),

        );


        $LoanID = DB::table('loan')->insertGetId($data1);



        while (strtotime($date) <= strtotime($end_date)) {



            $data = array(
                'EmployeeID' => Session::get('EmployeeID'),
                'LoanDeductionDate' => $date,
                'Amount' => round($request->input('Installment'), 2),
                'LoanID' => $LoanID

            );






            $deduction = DB::table('loan_deduction')->insert($data);
            $date = date("Y-m-d", strtotime("+1 month", strtotime($date)));
        }



        return  redirect('EmployeeLoan')->with('error', 'installment Created Successfully')->with('class', 'success');
    }


    public  function LoanDelete($id)
    {

        $id = DB::table('loan')->where('LoanID', $id)->delete();

        return redirect('EmployeeLoan')->with('error', 'Deleted Successfully.')->with('class', 'success');
    }

    public  function LoanInstallmentDelete($id)
    {

        $id = DB::table('loan_deduction')->where('LoanDeductionID', $id)->delete();

        return redirect('EmployeeLoan')->with('error', 'Deleted Successfully.')->with('class', 'success');
    }



    public  function EmpSalarySave(request $request)
    {

        $data = array(
            "EmployeeID" => Session::get('EmployeeID'),
            "Basic" => $request->input('Basic'),
            "Active" =>   $request->input('Active'),




        );

        $id = DB::table('emp_salary')->insertGetId($data);


        return redirect()->back()->with('error', 'Successfully done')->with('class', 'success');
    }


    public  function EmpSalaryUpdate(request $request)
    {

        $data = array(
            "EmployeeID" => Session::get('EmployeeID'),
            "Basic" => $request->input('Basic'),
            "Active" =>   $request->input('Active'),




        );




        $id = DB::table('emp_salary')->where('EmployeeSalaryID', $request->input('EmployeeSalaryID'))->update($data);



        return redirect()->back()->with('error', 'Successfully done')->with('class', 'success');
    }


    public  function EmpAllowanceSave(request $request)
    {

        $data = array(
            "EmployeeID" => Session::get('EmployeeID'),
            "AllowanceListID" => $request->input('AllowanceListID'),
            "Amount" =>   $request->input('Amount'),
            "Active" =>   $request->input('Active'),




        );




        $id = DB::table('emp_salary')->insert($data);



        return redirect()->back()->with('error', 'Successfully done')->with('class', 'success');
    }

    public  function EmpAllowanceDelete($id)
    {






        $id = DB::table('emp_salary')->where('EmployeeAllowanceID', $id)->delete();






        return redirect()->back()->with('error', 'Successfully Deleted')->with('class', 'success');
    }

    public function Branches()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Branch', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect('Dashboard')->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $branch = DB::table('branch')->get();



        return view('branch', compact('branch'));
    }


    public function BranchEdit($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Branch', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $branch = DB::table('branch')->where('BranchID', $id)->get();

        return view('branchedit', compact('branch'));
    }



    public function BranchSave(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Branch', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate($request, [

            // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
            'BranchLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',

        ]);



        $file = $request->file('BranchLogo');
        $input['filename'] = time() . '.' . $file->extension();





        $destinationPath = public_path('/uploads');

        $file->move($destinationPath, $input['filename']);

        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $input['imagename']);

        // $input['filename']===========is final data in it.




        $data = array(
            "BranchName" => $request->input('BranchName'),

            "BranchContact" =>   $request->input('BranchContact'),

            "BranchEmail" => $request->input('BranchEmail'),

            "BranchAddress"  =>  $request->input('BranchAddress'),
            "BranchAddress"  =>  $request->input('BranchAddress'),

            'BranchLogo' => $input['filename'],
            // 'mimeType'=>substr($file->getMimeType(), 0, 5)
        );










        $id = DB::table('branch')->insertGetId($data);


        return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
    }


    public function BranchUpdate(Request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Branch', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate($request, [

            // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
            'BranchLogo' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',

        ]);



        $file = $request->file('BranchLogo');
        $input['filename'] = time() . '.' . $file->extension();





        $destinationPath = public_path('/uploads');

        $file->move($destinationPath, $input['filename']);

        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $input['imagename']);

        // $input['filename']===========is final data in it.




        $data = array(
            "BranchName" => $request->input('BranchName'),

            "BranchContact" =>   $request->input('BranchContact'),

            "BranchEmail" => $request->input('BranchEmail'),

            "BranchAddress"  =>  $request->input('BranchAddress'),
            "BranchAddress"  =>  $request->input('BranchAddress'),

            'BranchLogo' => $input['filename'],
            // 'mimeType'=>substr($file->getMimeType(), 0, 5)
        );












        $id = DB::table('branch')->where('BranchID', $request->BranchID)->update($data);


        return redirect('Branches')->with('error', 'Branch Updated Successfully')->with('class', 'success');
    }



    public function BranchDelete($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Branch', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('branch')->where('BranchID', $id)->delete();
        return redirect('/Branches')->with('error', 'Deleted Successfully')->with('class', 'success');
    }



    public function Departments()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Department', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $department = DB::table('department')->get();
        return view('department', compact('department'));
    }


    public function DepartmentSave(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Department', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $this->validate($request, [
            'DepartmentName' => 'required',
        ]);

        $data = array(
            "DepartmentName" => $request->input('DepartmentName'),
        );
        $id = DB::table('department')->insertGetId($data);
        return redirect('Departments')->with('error', 'Department Saved Successfully')->with('class', 'success');
    }

    public function DepartmentEdit($id)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Department', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $department = DB::table('department')->where('DepartmentID', $id)->get();

        return view('departmentedit', compact('department'));
    }


    public function DepartmentUpdate(Request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Department', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate($request, [

            // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
            'DepartmentName' => 'required',

        ]);

        $data = array(
            "DepartmentName" => $request->input('DepartmentName'),

            // 'mimeType'=>substr($file->getMimeType(), 0, 5)
        );

        $id = DB::table('department')->where('DepartmentID', $request->DepartmentID)->update($data);

        return redirect('Departments')->with('error', 'Department Saved Successfully')->with('class', 'success');
    }

    public function DepartmentDelete($id)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Department', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('department')->where('DepartmentID', $id)->delete();



        return redirect('/Departments')->with('error', 'Deleted Successfully')->with('class', 'success');
    }


    public function JobTitle()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $jobtitle = DB::table('jobtitle')->get();
        return view('jobtitle', compact('jobtitle'));
    }


    public function JobTitleSave(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $this->validate($request, [
            'JobTitleName' => 'required',
        ]);

        $data = array(
            "JobTitleName" => $request->input('JobTitleName'),
        );
        $id = DB::table('jobtitle')->insertGetId($data);
        return redirect('JobTitle')->with('error', 'Saved Successfully')->with('class', 'success');
    }

    public function JobTitleEdit($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $jobtitle = DB::table('jobtitle')->where('JobTitleID', $id)->get();

        return view('jobtitleedit', compact('jobtitle'));
    }


    public function JobTitleUpdate(Request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $this->validate($request, [
            'JobTitleName' => 'required',
        ]);

        $data = array(
            "JobTitleName" => $request->input('JobTitleName'),
        );

        $id = DB::table('jobtitle')->where('JobTitleID', $request->JobTitleID)->update($data);

        return redirect('JobTitle')->with('error', 'Saved Successfully')->with('class', 'success');
    }

    public function JobTitleDelete($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('jobtitle')->where('JobTitleID', $id)->delete();



        return redirect('/JobTitle')->with('error', 'Deleted Successfully')->with('class', 'success');
    }

    public function FCBMonth($type)
    {





        $Type = $type;

        $monthname = DB::table('monthname')->get();
        $branch = DB::table('branch')->get();

        return view('fcb_month', compact('monthname', 'branch', 'Type'))->with('error', 'Select month name first')->with('class', 'danger');
    }


    public function FCBPrint(request $request)
    {

        $fcb = DB::table('v_fcb')->where('MonthName', $request->MonthName)->where('BranchID', $request->BranchID)->get();


        $MonthName = $request->MonthName;

        $branch = DB::table('branch')->where('BranchID', $request->BranchID)->get();
        return view('fcb_print', compact('fcb', 'branch', 'MonthName'));
    }


    public function FCBView()
    {

        $branch = DB::table('branch')->get();
        return view('fcb_view', compact('branch'));
    }

    public function Ajax_FCBMonthName(request $request)
    {
        $MonthName = DB::table('v_fcb')->distinct()->where('BranchID', $request->BranchID)->get(['MonthName']);

        return view('ajax', compact('MonthName'));
    }
    public function FCBSetMonthName(request $request)
    {


        $this->validate(
            $request,
            [
                'BranchID' => 'required',
                'MonthName' => 'required',

            ],
            [
                'BranchID.required' => 'Branch is required',
                'MonthName.required' => 'Month Name is required',



            ]
        );

        Session::put('FCBMonthName', $request->input('MonthName'));
        Session::put('FCBBranchID', $request->input('BranchID'));


        $down = $request->input('Action');

        if ($down == 'Download') {
            return redirect('DepositExport/xls');
        }


        if ($request->Action == 'Input') {
            return redirect('FCB')->with('error', 'Month name set')->with('class', 'success');
        } else {
            $branch = DB::table('branch')->where('BranchID', $request->BranchID)->get();
            $fcb = DB::table('v_fcb')->where('MonthName', $request->MonthName)->where('BranchID', $request->BranchID)->get();
            return view('fcb_print', compact('fcb', 'branch'));
        }
    }



    public function FCB()
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Deposit', 'Create/List');

        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////




        $fcb = DB::table('v_fcb')->where('MonthName', Session::get('FCBMonthName'))->where('BranchID', Session::get('FCBBranchID'))->get();

        $branch = DB::table('branch')->where('BranchID', Session::get('FCBBranchID'))->get();

        $employee = DB::table('v_employee')->where('BranchID', Session::get('FCBBranchID'))->orderby('FirstName', 'ASC')->get();

        return view('fcb', compact('fcb', 'employee', 'branch'));
    }





    public function FCBSave(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Deposit', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate(
            $request,
            [
                'ID' => 'required | unique:fcb,ID',
                'EmployeeID' => 'required',
                'FTDAmount' => 'required',
                'Date' => 'required | date_format:d/m/Y',
                'Compliant' => 'required',
                'KYCSent' => 'required',
            ],
            [
                'ID.required' => 'ID is required',
                'ID.unique' => 'Duplicate ID is not allowed',
                'EmployeeID.required' => 'Employee is required',
                'FTDAmount.required' => 'FTD Amount is required',
                'Date.required' => 'Date is required',
                'Compliant.required' => 'Compliant is required',
                'KYCSent.required' => 'KYC Sent is required',
            ]
        );

        $data = array(
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


        $id = DB::table('fcb')->insertGetId($data);
        return redirect('FCB')->with('error', 'Saved Successfully')->with('class', 'success');
    }

    public function FCBEdit($id)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Deposit', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $employee = DB::table('v_employee')->get();
        $fcb = DB::table('v_fcb')->where('FCBID', $id)->get();

        $branch = DB::table('branch')->get();

        return view('fcbedit', compact('fcb', 'employee', 'branch'));
    }

    public function FCBUpdate(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Deposit', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $this->validate(
            $request,
            [
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
            ]
        );

        $data = array(
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

        $id = DB::table('fcb')->where('FCBID', $request->FCBID)->update($data);
        return redirect('FCB')->with('error', 'Updated Successfully')->with('class', 'success');
    }

    public function FCBDelete($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Deposit', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $id = DB::table('fcb')->where('FCBID', $id)->delete();
        return redirect('/FCB')->with('error', 'Deleted Successfully')->with('class', 'success');
    }


    public function Leave()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Leave Create / List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $leave = DB::table('leave')->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $branch = DB::table('branch')->get();



        // if(Session::put('Months')>2)
        // {
        $leave_type = DB::table('leave_type')->get();

        // }
        // else
        // {
        // $leave_type = DB::table('leave_type')->where('LeaveTypeID',1)->get();

        // Session::put('message','You cannot apply for any other leave as you are on probition period');



        // }



        return view('emp.leave', compact('leave', 'employee', 'branch', 'leave_type'));
    }


    public function ajax_leave(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('v_leave')->where('EmployeeID', Session::get('EmployeeID'))->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // if you want to use direct link instead of dropdown use this line below
                    // <a href="javascript:void(0)"  onclick="edit_data('.$row->customer_id.')" >Edit</a> | <a href="javascript:void(0)"  onclick="del_data('.$row->customer_id.')"  >Delete</a>




                    $btn = '

                           <div class="dropdown">
                            <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-expanded="false">
<i class="mdi mdi-dots-horizontal font-size-18"></i></a>

      <ul class="dropdown-menu dropdown-menu-end" style="margin: 0px;">


<li><a onclick="edit_data(' . $row->LeaveID . ')"href="javascript:void(0)"  class="dropdown-item"><i class="mdi mdi-pencil font-size-16 text-success me-1"></i> Edit</a></li>

<li><a href="javascript:void(0)" onclick="delete_confirm2(`LeaveDelete`,' . $row->LeaveID . ')" class="dropdown-item"><i class="mdi mdi-trash-can font-size-16 text-danger me-1"></i> Delete</a></li>
                                                                </ul>
                                                            </div>';

                    //class="edit btn btn-primary btn-sm"
                    // <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('employee');
    }



    public function LeaveSave(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Leave Create / List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


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


        $data = array(
            'BranchID' => $request->BranchID,
            'EmployeeID' => $request->EmployeeID,
            'LeaveTypeID' => $request->LeaveTypeID,
            'FromDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('FromDate')))),
            'ToDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('ToDate')))),
            'Reason' => $request->Reason,

        );


        $id = DB::table('leave')->insertGetId($data);

        return redirect('Leave')->with('error', 'Leave Saved Successfully')->with('class', 'success');
    }


    public function LeaveEdit($id)
    {



        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Leave Edit');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $leave = DB::table('leave')->where('LeaveID', $id)->get();

        if ($leave) {
            Session::put('EmployeeID', $leave[0]->EmployeeID);
        }
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $branch = DB::table('branch')->get();

        return view('emp.leave_edit', compact('leave', 'employee', 'branch'));
    }

    public function LeaveUpdate(request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Leave Edit');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
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

        if (Session::get('UserType') == 'OM') {

            $data = array(
                'BranchID' => $request->BranchID,
                'EmployeeID' => $request->EmployeeID,
                'FromDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('FromDate')))),
                'ToDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('ToDate')))),
                'Reason' => $request->Reason,
                'DaysApproved' => $request->DaysApproved,
                'DaysRemaining' => $request->DaysRemaining,
                'OMStatus' => $request->OMStatus,
                'OMStatusDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('OMStatusDate')))),
                'OMRemarks' => $request->OMRemarks,


            );
        }

        if (Session::get('UserType') == 'HR') {

            $data = array(
                'BranchID' => $request->BranchID,
                'EmployeeID' => $request->EmployeeID,
                'FromDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('FromDate')))),
                'ToDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('ToDate')))),
                'Reason' => $request->Reason,
                'DaysApproved' => $request->DaysApproved,
                'DaysRemaining' => $request->DaysRemaining,
                'HRStatus' => $request->HRStatus,
                'HRStatusDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('HRStatusDate')))),
                'HRRemarks' => $request->HRRemarks,


            );
        }


        if (Session::get('UserType') == 'GM') {

            $data = array(
                'BranchID' => $request->BranchID,
                'EmployeeID' => $request->EmployeeID,
                'FromDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('FromDate')))),
                'ToDate' => date('Y-m-d', strtotime(str_replace('/', '-', $request->input('ToDate')))),
                'Reason' => $request->Reason,
                'DaysApproved' => $request->DaysApproved,
                'DaysRemaining' => $request->DaysRemaining,
                'GMStatus' => $request->GMStatus,
                'GMStatusDate' =>  date('Y-m-d', strtotime(str_replace('/', '-', $request->input('GMStatusDate')))),




                'GMRemarks' => $request->GMRemarks,


            );
        }




        $id = DB::table('leave')->where('LeaveID', $request->LeaveID)->update($data);

        return redirect('Leave')->with('error', 'Leave Saved Successfully')->with('class', 'success');
    }


    public function LeaveDelete($id)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Leave Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('leave')->where('LeaveID', $id)->delete();



        return redirect('/Leave')->with('error', 'Deleted Successfully')->with('class', 'success');
    }

    public function Letter()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Letter Template', 'Create / List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $letter = DB::table('letter')->get();

        return  view('letter', compact('letter'));
    }

    public function save_letter(request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Letter Template', 'Create / List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $data = array(

            'Title' => $request->input('title'),
            'Content' => $request->input('content'),
            'UserID' => Session::get('uesrid')
        );

        $id = DB::table('letter')->insert($data);
        return redirect('Letter')->with('error', 'Letter template saved successfully')->with('class', 'success');
    }


    public function letter_delete($id)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Letter Template', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $id = DB::table('letter')->where('LetterID', $id)->delete();
        return redirect('Letter')->with('error', 'Letter Tempalted Deleted Successfully')->with('class', 'danger');
    }

    public function letter_edit($LetterID)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Letter Template', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $letter = DB::table('letter')->where('LetterID', $LetterID)->get();

        return  view('letter_edit', compact('letter'));
    }


    public function letter_update(request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Letter Template', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $data = array(
            'Title' => $request->input('title'),
            'Content' => $request->input('content'),
            'UserID' => Session::get('uesrid')
        );


        $letter = DB::table('letter')->where('LetterID', $request->input('letter_id'))->update($data);

        return redirect('Letter')->with('error', 'Letter template Updated Successfully')->with('class', 'success');
    }

    // letter issue section
    // public function letter_issue()
    // {

    //    $project= DB::table('project')->get();
    //    $letter= DB::table('letter')->get();
    //    $v_property= DB::table('v_property')->where('customer_id',Session::get('customer_id'))->get();
    //    $issue_letter= DB::table('v_issue_letter')->where('customer_id',Session::get('customer_id'))->get();


    //    return  view ('letter_issue',compact('project','letter','v_property','issue_letter'));
    // }









    public function issue_letter_print($issue_letter_id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Print Issued Letter');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $issue_letter = DB::table('issue_letter')->where('IssueLetterID', $issue_letter_id)->get();




        return view('issue_letter_print', compact('issue_letter'));
    }


    function AttendanceImport()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Import Attendance', 'Import');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        return view('attendance_import');
    }

    function import(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Import Attendance', 'Import');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $request->validate(
            [
                'file'  => 'required|mimes:csv'
            ],
            [
                'file.required' => 'File Not Selected'
            ]
        );
        // dd($request->all());
        DB::beginTransaction();
        try {
            $insert_data = 0;
            $not_insert_data = 0;
            set_time_limit(0);
            ini_set('max_execution_time', 36000);
            if (!isset($request->file)) {
                return redirect()->back()->with('error', 'Please Upload a file');
            } else {
                $path = $request->file('file')->getRealPath();
                $mim_type = $request->file('file')->getMimeType();
                if ($mim_type != "text/csv") {
                    return redirect()->back()->with('error', 'Please Upload CSV File Only');
                } else {
                    $records = array_map('str_getcsv', file($path));
                    $fields = $records[0];
                    // dd($fields);
                    if (!count($records) > 0) {
                        return redirect()->back()->with('error', 'you have no record in csv!');
                    } elseif (count($records[0]) != 4) {
                        return redirect()->back()->with('error', 'The CSV file do not match with the sample of given Csv!');
                    } elseif (count($records[0]) == 4) {
                        $field_check = ['Employee Full Name', 'Date (Y-m-d)', 'Time In (H:m)', 'Time Out (H:m)'];
                        foreach ($fields as $key => $record) {
                            if ($record != $field_check[$key]) {
                                return redirect()->back()->with('error', 'Your Column headers do not match with the sample of given Csv!');
                            }
                        }
                        array_shift($records);
                        // dd($records);
                        foreach ($records as $key => $record) {
                            $employee = DB::table('employee')
                                ->where(function ($query) use ($record) {
                                    $query->where(DB::raw("CONCAT(firstname, ' ', middlename, ' ', lastname)"), 'LIKE', '%' . $record[0] . '%')
                                        ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', '%' . $record[0] . '%')
                                        ->orWhere(DB::raw("CONCAT(firstname)"), 'LIKE', '%' . $record[0] . '%');
                                })
                                ->first();
                            // dd($employee);
                            if (!$employee) {
                                return back()->with('error', 'Import Interrupted. No Employee Found for the name ' . $record[0] . '. on line ' . $insert_data + 2)->with('class', 'danger');
                            } else {
                                if ($record[2] != '' && $record[3] == '') {
                                    $status = 'CheckedIN';
                                } elseif ($record[2] != '' && $record[3] != '') {
                                    $status = 'CheckedOut';
                                } elseif ($record[2] == '' && $record[3] == '') {
                                    $status = 'Absent';
                                }
                                $data = T1::where('EmployeeID', $employee->EmployeeID)->whereDate('date', $record[1])->where('CheckIn', $record[2] != '' ? $record[2] : null)->first();
                                if (!$data) {
                                    T1::create([
                                        'EmployeeID' => $employee->EmployeeID,
                                        'EmployeeName' => $record[0],
                                        'date' => $record[1],
                                        'CheckIn' => $record[2] != '' ? $record[2] : null,
                                        'CheckOut' => $record[3] != '' ? $record[3] : null,
                                        'Status' => $status
                                    ]);
                                    $insert_data++;
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();
            return back()->with('error', 'Excel Data Imported successfully. ' . $insert_data . ' Rows Imported.')->with('class', 'success');
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage())->with('class', 'danger');
        }
    }


    function EmployeeAttendance()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Attendance View');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $attendance = T1::where('EmployeeID', Session::get('EmployeeID'))->orderByDesc('date')->get();
        $attendances = DB::table('v_employee_attendance')
            ->where('EmployeeID', Session::get('EmployeeID'))
            ->get();
        // dd($attendances);

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('emp.employee_attendance', compact('attendance', 'attendances', 'employee'));
    }

    function EmployeeFCB()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Deposit');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $fcb = DB::table('v_fcb')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('emp.employee_fcb', compact('fcb', 'employee'));
    }

    function EmployeeLetters()
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Letter Issue / Letter Issued');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $letter = DB::table('letter')->get();
        $issue_letter = DB::table('issue_letter')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('emp.emp_letter', compact('letter', 'issue_letter', 'employee'));
    }

    function EmployeeWarningLeter()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Warning Letter List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $letter = DB::table('letter')->get();
        $issue_letter = DB::table('issue_letter')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('emp.emp_warning_letter', compact('letter', 'issue_letter', 'employee'));
    }


    function IssueLetter()
    {


        $letter = DB::table('letter')->get();
        $issue_letter = DB::table('issue_letter')->get();
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('emp.emp_letter', compact('attendance', 'letter', 'issue_letter', 'employee'));
    }

    // letter issue section
    //      public function letter_issue()
    //      {

    //         $project= DB::table('project')->get();
    //         $letter= DB::table('letter')->get();
    //         $v_property= DB::table('v_property')->where('customer_id',Session::get('customer_id'))->get();
    //         $issue_letter= DB::table('v_issue_letter')->where('customer_id',Session::get('customer_id'))->get();


    //         return  view ('letter_issue',compact('project','letter','v_property','issue_letter'));
    //      }


    public function letter_issue_preview(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Letter Issue / Letter Issued');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $letter = DB::table('letter')->where('LetterID', $request->LetterID)->get();
        $issue_letter = DB::table('issue_letter')->get();
        $v_employee = DB::table('v_employee')->get();

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();



        return view('emp.letter_issue_preview', compact('letter', 'issue_letter', 'employee'));
    }

    public function letter_issue_save(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Letter Issue / Letter Issued');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $data = array(

            'EmployeeID' => $request->input('EmployeeID'),
            'LetterID' => $request->input('LetterID'),
            'Title' => $request->input('Title'),
            'Content' => $request->input('Content'),
            'UserID' => Session::get('UserID')
        );


        $letter = DB::table('issue_letter')->insert($data);

        return redirect('EmployeeLetters')->with('error', 'Letter Issued Successfully')->with('class', 'success');
    }


    public function issue_letter_edit($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Issued Letter Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $issue_letter = DB::table('issue_letter')->where('IssueLetterID', $id)->get();

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();



        return view('emp.letter_issue_edit', compact('issue_letter', 'employee'));
    }


    public function issue_letter_update(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Issued Letter Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $data = array(


            'Title' => $request->input('Title'),
            'Content' => $request->input('Content'),
            'UserID' => Session::get('UserID')
        );


        $letter = DB::table('issue_letter')->where('IssueLetterID', $request->IssueLetterID)->update($data);

        return redirect('EmployeeLetters')->with('error', 'Letter Updated Successfully')->with('class', 'success');
    }

    public function issue_letter_delete($id)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Delete Issued Letter');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('issue_letter')->where('IssueLetterID', $id)->delete();
        return redirect('EmployeeLetters')->with('error', 'Letter Deleted Successfully')->with('class', 'danger');
    }

    public function CalculateComission()
    {

        $d = eu(108, 37495, 453761, 100, 34718, 1);
        dd($d);

        $d = noel(54, 20442, 3000);
        echo "<pre>";
        print_r($d['comission1'] . "-" . $d['comission2'] . "-" . $d['grand'] . "-");
        die;
    }


    //      public function issue_letter_print($issue_letter_id)
    //      {


    //             $issue_letter = DB::table('v_issue_letter')->where('issue_letter_id',$issue_letter_id)->get();




    //             return view('issue_letter_print',compact('issue_letter'));

    //      }

    public function Salary()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Salary', 'Make');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $pagetitle = 'Salary';
        $v_salary = DB::table('v_union_salary')->get();

        $monthname = DB::table('monthname')->get();
        $branch = DB::table('branch')->get();
        $stafftype = DB::table('staff_type')->get();

        return view('salary1', compact('pagetitle', 'branch', 'monthname', 'stafftype'));
    }

    public function Salary2(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        // $allow= check_role(Session::get('UserID'),Session::get('BranchID'),'Salary','Make');
        // if($allow[0]->Allow=='N')
        // {
        //   return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        // }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        //dd($request->all());

        // $result = agent(3,1053,2000);
        // dd($result);


        $pagetitle = 'Salary';

        $this->validate(
            $request,
            [
                'BranchID' => 'required',
                'MonthName' => 'required',
                // 'StaffType'=>'required ',

            ],
            [
                'BranchID.required' => 'Branch Name is  required',
                'MonthName.required' => 'Month Name is required',
                // 'StaffType.required' => 'Staff Type is required',

            ]
        );


        $employee = DB::table('v_employee')->get();

        return view('salary2', compact('pagetitle', 'employee'));
    }


    public function SaveSalary(request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Salary', 'Make');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $SalaryCheck = DB::table('salary')->where('BranchID', $request->BranchID)->where('MonthName', $request->MonthName)->get();



        if (count($SalaryCheck) > 0) {
            return redirect('Salary')->with('error', 'Salary Already Generated')->with('class', 'danger');
        } else {





            for ($i = 0; $i < count($request->EmployeeID); $i++) {
                $data = array(
                    'BranchID' => $request->BranchID,
                    'StaffType' => $request->StaffType,
                    'EmployeeID' => $request->EmployeeID[$i],
                    'EmployeeName' => $request->EmployeeName[$i],
                    'JobTitle' => $request->JobTitleName[$i],
                    'Department' => $request->DepartmentName[$i],
                    'MonthName' => $request->MonthName[$i],
                    'DaysPresent' => $request->DaysPresent[$i],
                    'LWPay' => $request->LWPay[$i],
                    'PerDay' => $request->PerDay[$i],
                    'BasicSalary' => $request->BasicSalary[$i],
                    'HRA' => $request->HRA[$i],
                    'Transport' => $request->Transport[$i],
                    'OtherAllowance' => $request->OtherAllowance[$i],
                    'AdvanceLoan' => $request->AdvanceLoan[$i],
                    'LeaveDeduction' => $request->LeaveDeduction[$i],
                    'TotalDeduction' => $request->TotalDeduction[$i],
                    'GrandSalary' => $request->GrandSalary[$i],
                    'NetSalary' => $request->NetSalary[$i],
                    'UserID' => Session::get('UserID'),

                );

                $id = DB::table('salary')->insertGetId($data);
            }
        }




        return redirect('Salary')->with('error', 'Salary created successfully')->with('class', 'success');
    }


    public function ViewSalary()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Search Salary', 'List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $pagetitle = 'Salary Search';
        $monthname = DB::table('salary')->distinct()->get(['MonthName']);
        $branch = DB::table('branch')->get();
        return view('viewsalary', compact('monthname', 'pagetitle', 'branch'));
    }


    public function SearchSalary(request $request)
    {



        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Search Salary', 'List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $pagetitle = 'Salary Search';
        if ($request->input('MonthName')) {

            Session::put('MonthName', $request->input('MonthName'));
        }

        if ($request->input('BranchID')) {

            Session::put('BranchID', $request->input('BranchID'));
        }

        // $salarysummary = DB::table('salary')->select(DB::raw('sum(Salary) as SumSalary'), DB::raw('sum(Comission) as SumComission'),DB::raw('sum(Grand) as SumGrand'),DB::raw('sum(Bonus) as SumBonus'))->where('MonthName', Session::get('MonthName'))->get();
        $salary = DB::table('salary')->where('MonthName', Session::get('MonthName'))->where('BranchID', Session::get('BranchID'))->get();

        return view('searchsalary', compact('salary', 'pagetitle'));
    }


    public function SalaryPrint($MonthName)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Search Salary', 'List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $pagetitle = 'Print Salary';
        if ($MonthName) {

            Session::put('MonthName', $MonthName);
        }
        // $salarysummary = DB::table('salary')->select(DB::raw('sum(Salary) as SumSalary'), DB::raw('sum(Comission) as SumComission'),DB::raw('sum(Grand) as SumGrand'),DB::raw('sum(Bonus) as SumBonus'))->where('MonthName', Session::get('MonthName'))->get();
        $salary = DB::table('salary')->where('MonthName', Session::get('MonthName'))->get();
        $branch = DB::table('branch')->where('BranchID', Session::get('BranchID'))->get();

        $pdf = PDF::loadview('salary_print', compact('salary', 'pagetitle', 'branch'));
        //return $pdf->download('pdfview.pdf');
        $pdf->setpaper('A4', 'landscape');
        return $pdf->stream();


        return view('salary_print', compact('salary', 'pagetitle', 'branch'));

        // $pdf =  PDF::loadView('salary_print',compact('salary','pagetitle','salarysummary','branch'));

        // return $pdf->stream();
        // return $pdf->download(Session::get('MonthName').'.pdf');

        // $path = storage_path('\pdf');

        // $customPaper = array(0,0,297 ,210 );
        // $pdf = PDF::loadView('PrintChallan');
        // $pdf->setOptions(['dpi' => 300, 'defaultFont' => 'arial']);
        // $pdf->setpaper($customPaper);
        // $pdf->setpaper('A4', 'landscape');

        // this will use public folder and location
        // $pdf->save('invoice/'.strtotime(date('Y-m-d H:i:s')).'.pdf');

        //  return $pdf->download('pdfview.pdf');


        // return view('PrintChallan');
        // }



    }

    public function SalaryEdit($id)
    {

        $pagetitle = 'Salary Edit';
        $salary = DB::table('salary')->where('SalaryID', $id)->get();
        $employee = DB::table('v_employee')->get();

        return view('salary_edit', compact('salary', 'employee', 'pagetitle'));
    }



    public function SalaryUpdate(request $request)
    {


        $this->validate($request, [
            'Salary' => 'required',
            'Bonus' => 'required',
            'Comission' => 'required',

            // 'mobile'=>'required|min:11|numeric',
            'Grand' => 'required',



            // 'email'=>'required | email|unique:user',
        ]);



        $data = array(

            'Salary' => $request->Salary,
            'Comission' => $request->Comission,
            'Bonus' => $request->Bonus,
            'Grand' => $request->Grand,

        );



        $id = DB::table('salary')->where('SalaryID', '=', $request->SalaryID)->update($data);

        return redirect('ViewSalary')->with('error', ' Successfully Update')->with('class', 'success');
    }


    public function SalaryDelete($id)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Search Salary', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $id = DB::table('salary')->where('SalaryID', $id)->delete();
        return redirect('SearchSalary')->with('error', ' Deleted Successfully')->with('class', 'danger');
    }

    public function EU()
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Operation Manager', 'List/Create');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $monthname = DB::table('monthname')->get();
        $branch = DB::table('branch')->get();
        $eu = DB::table('eu')->get();

        return view('eu', compact('eu', 'branch', 'monthname'));
    }


    public function EUSave(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Operation Manager', 'List/Create');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate(
            $request,
            [
                'MonthName' => 'required ',
                'No' => 'required | numeric',
                'Sum' => 'required | numeric',
                'NetDeposit' => 'required | numeric',
                'FTD' => 'required | numeric',

            ],
            [

                'MonthName.required' => 'Please choose Month',
                'No.required' => 'No field is required',
                'No.numeric' => 'No field must be number',
                'Sum.required' => 'Sum is required',
                'Sum.numeric' => 'Sum must be number',
                'NetDeposit.required' => 'Net Deposit is required',
                'NetDeposit.numeric' => 'Net Deposit must be number',
                'FTD.required' => 'FTD Deposit is required',
                'FTD.numeric' => 'FTD must be number',

            ]
        );


        $data = array(
            "MonthName" => $request->input('MonthName'),
            "No" => $request->input('No'),
            "Sum" => $request->input('Sum'),
            "NetDeposit" => $request->input('NetDeposit'),
            "FTD" => $request->input('FTD'),
            "Per" => round($request->input('FTD') * ($request->input('Sum') / $request->input('No'))),
            "Total" => round(($request->input('FTD') * ($request->input('Sum') / $request->input('No'))) * 7.77),

        );

        $id = DB::table('eu')->insertGetId($data);
        return redirect('EU')->with('error', 'Saved Successfully')->with('class', 'success');
    }

    public function EUEdit($EuID)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Operation Manager', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $monthname = DB::table('monthname')->get();
        $branch = DB::table('branch')->get();
        $eu = DB::table('eu')->where('EuID', $EuID)->get();

        return view('euedit', compact('eu', 'branch', 'monthname'));
    }


    public function EUUpdate(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Operation Manager', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $this->validate(
            $request,
            [
                'MonthName' => 'required ',
                'No' => 'required | numeric',
                'Sum' => 'required | numeric',
                'NetDeposit' => 'required | numeric',
                'FTD' => 'required | numeric',

            ],
            [

                'MonthName.required' => 'Please choose Month',
                'No.required' => 'No field is required',
                'No.numeric' => 'No field must be number',
                'Sum.required' => 'Sum is required',
                'Sum.numeric' => 'Sum must be number',
                'NetDeposit.required' => 'Net Deposit is required',
                'NetDeposit.numeric' => 'Net Deposit must be number',
                'FTD.required' => 'FTD Deposit is required',
                'FTD.numeric' => 'FTD must be number',

            ]
        );


        $data = array(
            "MonthName" => $request->input('MonthName'),
            "No" => $request->input('No'),
            "Sum" => $request->input('Sum'),
            "NetDeposit" => $request->input('NetDeposit'),
            "FTD" => $request->input('FTD'),
            "Per" => round($request->input('FTD') * ($request->input('Sum') / $request->input('No'))),
            "Total" => round(($request->input('FTD') * ($request->input('Sum') / $request->input('No'))) * 7.77),
            "EuID" => $request->EuID
        );



        $id = DB::table('eu')->where('EuID', $request->EuID)->update($data);
        return redirect('EU')->with('error', 'Saved Successfully')->with('class', 'success');
    }



    public function EUView($EuID)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Operation Manager', 'View');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $pagetitle = 'EU';
        $eu = DB::table('eu')->where('EuID', $EuID)->get();
        return view('euview', compact('eu', 'pagetitle'));
    }

    public function EUDelete($id)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Operation Manager', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $id = DB::table('eu')->where('EUID', $id)->delete();
        return redirect('EU')->with('error', ' Deleted Successfully')->with('class', 'danger');
    }



    public function EmployeeSalary()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Salary View');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $allowance = DB::table('allowance_list')->get();

        $emp_salary = DB::table('v_emp_salary')->where('EmployeeID', Session::get('EmployeeID'))->get();
        //

        $salary = DB::table('salary')->where('EmployeeID', Session::get('EmployeeID'))->get();

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();


        return view('emp.emp_salary', compact('salary', 'employee', 'allowance', 'emp_salary'));
    }

    public function EmployeeTeam()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Supervising');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();

        $team = DB::table('v_employee')->where('SupervisorID', Session::get('EmployeeID'))->get();


        return view('emp.emp_team', compact('employee', 'team'));
    }


    public function Team()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Team Hierarchy', 'View');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $pagetitle = 'Team Overview';
        $employee = DB::table('v_employee')->where('IsSupervisor', 'Yes')->get();




        return view('team', compact('employee', 'pagetitle'));
    }


    public function EmployeeComission($EmployeeID, $MonthName)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Salary Commission View');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $fcb = DB::table('v_fcb')->where('EmployeeID', $EmployeeID)->where('MonthName', $MonthName)->get();
        $employee = DB::table('v_employee')->where('EmployeeID', $EmployeeID)->get();
        $fcbsummary = DB::table('v_fcb')
            ->select('EmployeeID', DB::raw('sum(FTDAmount) as sum'), DB::raw('count(FTDAmount) as tot'))
            ->where('EmployeeID', $EmployeeID)->where('MonthName', $MonthName)
            ->groupBy('EmployeeID')
            ->get();

        return view('emp.emp_comission', compact('fcb', 'employee'));
    }



    public function EmployeeDocuments()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Files Upload/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $documents = DB::table('v_documents')->where('EmployeeID', Session::get('EmployeeID'))->get();

        return view('emp.emp_document', compact('employee', 'documents'));
    }

    public function EmployeeDocumentUpload(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'Files Upload/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////








        if ($request->file('UploadFile') != null) {

            $this->validate($request, [

                // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,pdf|max:1000',
                'FileName' => 'required',
                'UploadFile' => 'required|mimes:jpeg,png,jpg,gif,doc,docx,bmp,pdf|max:20000',

            ]);

            $file = $request->file('UploadFile');
            $input['filename'] = time() . '.' . $file->extension();
            $size = formatBytes($request->file('UploadFile')->getSize());




            $destinationPath = public_path('/documents');

            $file->move($destinationPath, $input['filename']);

            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $input['imagename']);

            // $input['filename']===========is final data in it.




            $data = array(
                'EmployeeID' => Session::get('EmployeeID'),
                'FileName' => $request->input('FileName'),
                'File' => $input['filename'],
                'FileSize' => $size,
                // 'mimeType'=>substr($file->getMimeType(), 0, 5)
            );
        }


        $id = DB::table('documents')->insertGetId($data);




        return redirect('EmployeeDocuments')->with('error', 'Document uploaded successfully')->with('class', 'success');
    }


    public function EmployeeDocumentDelete($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Employee Detail', 'File Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('documents')->where('DocumentID', $id)->delete();

        return redirect('EmployeeDocuments')->with('error', 'Record Deleted Successfully')->with('class', 'success');
    }

    public function UserProfile()
    {

        $branch = DB::table('branch')->get();
        $v_users = DB::table('v_users')->where('UserID', Session::get('UserID'))->get();



        return  view('user_profile', compact('branch', 'v_users'));
    }

    public function ChangePassword()
    {

        $v_users = DB::table('v_users')->where('UserID', Session::get('UserID'))->get();

        return  view('change_password', compact('v_users'));
    }

    public function UpdatePassword(request $request)
    {

        $user = DB::table('users')->where('UserID', Session::get('UserID'))->get();

        if ($user[0]->Password != $request->input('old_password')) {


            return redirect('ChangePassword')->with('error', 'Old password doesnot matched')->with('class', 'danger');
        }






        $this->validate($request, [

            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'new_confirm_passowrd' => 'required_with:new_password|same:new_password|min:6'
        ]);
        // ,[
        //   'old_password.required' => 'Old Password is required',
        //        'new_password.required' => 'New Password is required ',
        //        'new_confirm_passowrd.required' => 'Confirm Password is required '

        // ]);

        $data = array(
            'Password' => $request->input('new_password')


        );


        $id = DB::table('users')->where('UserID', Session::get('UserID'))->update($data);
        return redirect('Dashboard')->with('error', 'Password updated Successfully')->with('class', 'success');
    }


    public function Users()
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        // $allow= check_role(Session::get('UserID'),Session::get('BranchID'),'Users','Create / List');
        // if($allow[0]->Allow=='N')
        // {
        //   return redirect()->back()->with('error', 'You access is limited')->with('class','danger');
        // }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $branch = DB::table('branch')->get();
        $v_users = DB::table('v_users')->get();

        return  view('users', compact('branch', 'v_users'));
    }


    public function SaveUser(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Users', 'Create / List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        // if((Session::get('UserType')=='OM') || (Session::get('UserType')=='GM'))
        // {

        //  return redirect('Users')->with('error','You are not authorized to create new user')->with('class','danger');

        // }

        $this->validate($request, [

            'Email' => 'required|max:40|unique:users',
            'Password' => 'required'

        ]);


        $data = array(

            'BranchID' => $request->input('BranchID'),
            'FullName' => $request->input('FullName'),
            'Email' => $request->input('Email'),
            'Password' => $request->input('Password'),
            'UserType' => $request->input('UserType'),

            'Active' => $request->input('Active')


        );

        $id = DB::table('users')->insert($data);
        return redirect('Users')->with('error', 'User Created Successfully')->with('class', 'success');
    }

    public function EditUser($userid)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Users', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        //  if((Session::get('UserType')=='OM') || (Session::get('UserType')=='GM'))
        // {

        //  return redirect('Users')->with('error','You are not authorized to create new user')->with('class','danger');

        // }

        $branch = DB::table('branch')->get();
        $v_users = DB::table('v_users')->where('UserID', $userid)->get();

        return  view('user_edit', compact('branch', 'v_users'));
    }


    public function UpdateUser(request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Users', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        // if((Session::get('UserType')=='OM') || (Session::get('UserType')=='GM'))
        // {

        //  return redirect('Users')->with('error','You are not authorized to create new user')->with('class','danger');

        // }

        $this->validate(
            $request,
            [

                'Password' => 'required'

            ],
            [
                'Password.required' => 'Customer Name is required',

            ]
        );

        $data = array(
            'BranchID' => $request->input('BranchID'),
            'FullName' => $request->input('FullName'),
            'Email' => $request->input('Email'),
            'Password' => $request->input('Password'),
            'UserType' => $request->input('UserType'),
            'Active' => $request->input('Active')
        );


        $id = DB::table('users')->where('UserID', $request->input('UserID'))->update($data);
        return redirect('Users')->with('error', 'Users Updated Successfully')->with('class', 'success');
    }



    public function DeleteUser($userid)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Users', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        // if(Session::get('UserType')!='Admin')
        // {

        //  return redirect('Users')->with('error','You are not authorized to create new user')->with('class','danger');

        // }

        $id = DB::table('users')->where('UserID', $userid)->delete();
        return redirect('Users')->with('error', 'User Deleted Successfully')->with('class', 'danger');
    }



    public function VisaAlert()

    {
        $pagetitle = 'Visa Expiry';
        $visa_alert = DB::table('v_visa_expiry_list')->get();

        return view('visa_alert', compact('visa_alert', 'pagetitle'));
    }

    public function PassportAlert()

    {
        $pagetitle = 'Passport Expiry';
        $passport_alert = DB::table('v_passport_expiry_list')->get();

        return view('passport_alert', compact('passport_alert', 'pagetitle'));
    }


    public function LeaveAlert()

    {
        $pagetitle = 'Pending Leaves ';

        if (Session::get('UserType') == 'OM') {
            $where = array('OMStatus' => 'Pending');
        } elseif (Session::get('UserType') == 'HR') {
            $where = array(
                'OMStatus' => 'Yes',
                'HRStatus' => 'Pending'
            );
        } else {
            $where = array(
                'OMStatus' => 'Yes',
                'HRStatus' => 'Yes',
                'GMStatus' => 'Pending'
            );
        }

        $leave_alert = DB::table('v_leave')->where($where)->get();





        return view('leave_alert', compact('leave_alert', 'pagetitle'));
    }

    public function AttendanceAlert()

    {
        $pagetitle = 'Attendance Alert ';


        return view('attendance_alert', compact('pagetitle'));
    }


    public function checkUserRole($UserID)
    {

        $role = DB::table('user_role')->where('UserID', $UserID)->get();
        if (count($role) > 0) {


            return redirect('RoleView/' . $UserID)->with('error', '$2 updated Successfully')->with('class', 'success');
        } else {


            return redirect('Role/' . $UserID)->with('error', '$2 updated Successfully')->with('class', 'success');
        }
    }

    public function Role($UserID)
    {





        $pagetitle = 'User Rights & Control';
        $users = DB::table('users')->where('UserID', $UserID)->get();

        $branch = DB::table('branch')->where('BranchID', $users[0]->BranchID)->get();

        $role = DB::table('role')->select('Table')->distinct()->get();


        return view('role', compact('pagetitle', 'role', 'users', 'branch'));
    }


    public function RoleView($UserID)
    {





        $pagetitle = 'User Rights & Control';
        $users = DB::table('users')->where('UserID', $UserID)->get();
        $branch = DB::table('branch')->where('BranchID', $users[0]->BranchID)->get();

        $role = DB::table('role')->select('Table')->distinct()->get();




        return view('view_role', compact('pagetitle', 'role', 'users', 'branch'));
    }


    public function RoleSave(request $request)
    {





        $TableName = $request->TableName;
        $Action = $request->Action;
        $Allow = $request->Allow;

        $tot = count($request->TableName);
        // echo count($box); // count how many values in array
        for ($i = 0; $i < $tot; $i++) {
            // echo $TableName[$i] .'-' . $Action[$i] .'-'.  $Allow[$i] . "<BR>";

            $data = array(

                'BranchID' => $request->BranchID,
                'UserID' => $request->UserID,
                'Table' => $TableName[$i],
                'Action' => $Action[$i],
                'Allow' => $Allow[$i],


            );



            $id = DB::table('user_role')->insertGetId($data);
        }


        return redirect('Users')->with('error', 'User perission saved Successfully')->with('class', 'success');
    }


    public function RoleUpdate(request $request)
    {





        $id = DB::table('user_role')->where('UserID', $request->UserID)->where('BranchID', $request->BranchID)->delete();


        $TableName = $request->TableName;
        $Action = $request->Action;
        $Allow = $request->Allow;

        $tot = count($request->TableName);
        // echo count($box); // count how many values in array
        for ($i = 0; $i < $tot; $i++) {
            // echo $TableName[$i] .'-' . $Action[$i] .'-'.  $Allow[$i] . "<BR>";

            $data = array(

                'BranchID' => $request->BranchID,
                'UserID' => $request->UserID,
                'Table' => $TableName[$i],
                'Action' => $Action[$i],
                'Allow' => $Allow[$i],


            );



            $id = DB::table('user_role')->insertGetId($data);
        }

        return redirect('Users')->with('error', 'User perission saved Successfully')->with('class', 'success');
    }



    public function SendEMail(request $request)
    {

        $email = $request->input('Email');
        // $email = ['kashif@inu.edu.pk', 'kashif_mushtaq2008@htomail.com','kashif.mushtaq2050@gmail.com'];


        $data = array(

            'Name' => $request->input('Name'),
            'Email' => $request->input('Email'),
            'Subject' => $request->input('Subject'),
            'Message' => $request->input('Message'),



        );
        Mail::to($email)->send(new SendMail($data));
        return redirect($request->input('PageLink'))->with('error', 'Email sent!')->with('class', 'success');
    }



    public function ComposeEmail($EmployeeID)
    {
        $pagetitle = 'Compose Email';

        $employee =  DB::table('v_employee')->where('EmployeeID', $EmployeeID)->get();
        return view('compose_email', compact('employee', 'pagetitle'));
    }

    public function ForgotPassword()
    {
        return view('forgot_password');
    }

    public function SendForgotEmail(request $request)
    {



        if ($request->StaffType == 'Management') {

            $username = $request->input('Email');


            $user = DB::table('users')->where('Email', '=', $username)
                ->get();


            if (count($user) > 0) {

                $email = $user[0]->Email;


                // $data = array (

                //               'Name' => $request->input('Name'),
                //               'Email' => $request->input('Email'),
                //               'Subject' => $request->input('Subject'),
                //               'Message' => $request->input('Message'),

                //      );
                //Mail::to($email) ->send(new SendMail($data));
                return redirect('EmailPin')->with('error', 'Enter Code')->with('class', 'success');
            } else {

                return redirect('ForgotPassword')->with('error', 'Invalid Email')->with('class', 'success');
            }
        } else {

            $username = $request->input('Email');


            $data = DB::table('employee')->where('Email', '=', $username)
                // ->where('Active', '=', 'Y' )
                ->get();


            if (count($data) > 0) {

                $data[0]->Email;

                return redirect('EmailPin')->with('error', 'Enter Code')->with('class', 'success');
            } else {
                //Session::flash('error', 'Invalid username or Password. Try again');

                return redirect('ForgotPassword')->withinput($request->all())->with('error', 'Invalid Email. Try again');
            }
        }
        // for staff login
    }


    public function EmailPin()
    {
        return view('email_pin');
    }



    public function NewPassword(request $request)
    {
        $employee = DB::table('employee')->get();
    }

    public function UpdateNewPassword(request $request)
    {
        $employee = DB::table('employee')->get();
    }


    public function DepositExport($type)
    {

        // $employees = DB::table('v_property')->get();





        $fcb = DB::table('v_fcb')->get();



        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'S.NO');
        $sheet->setCellValue('B1', 'ID');
        $sheet->setCellValue('C1', 'Agent');
        $sheet->setCellValue('D1', 'FTD Amount');
        $sheet->setCellValue('E1', 'Date');
        $sheet->setCellValue('F1', 'Compliant');
        $sheet->setCellValue('G1', 'KYC Sent');
        $sheet->setCellValue('H1', 'Dialer');

        $rows = 2;
        foreach ($fcb as $key => $value) {

            $sheet->setCellValue('A' . $rows, ++$key);
            $sheet->setCellValue('B' . $rows, $value->ID);
            $sheet->setCellValue('C' . $rows, $value->FirstName);
            $sheet->setCellValue('D' . $rows, $value->FTDAmount);
            $sheet->setCellValue('E' . $rows, $value->Date);
            $sheet->setCellValue('F' . $rows, $value->Compliant);
            $sheet->setCellValue('G' . $rows, $value->KYCSent);
            $sheet->setCellValue('H' . $rows, $value->Dialer);

            $rows++;
        }


        $fileName = "Deposit." . $type;
        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if ($type == 'xls') {
            $writer = new Xls($spreadsheet);
        }
        $writer->save($fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/') . "/" . $fileName);
    }




    public function EmployeeLeaveReport()
    {

        $employee = DB::table('v_employee')->where('EmployeeID', Session::get('EmployeeID'))->get();
        $leavetype = DB::table('leave_type')->get();
        return view('emp.emp_leave_report', compact('employee', 'leavetype'));
    }


    public function DocumentCategory()
    {
        $document_category = DB::table('document_category')->get();
        return view('document_category', compact('document_category'));
    }

    public function DocumentCategorySave(Request $request)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Create/List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////


        $this->validate($request, [
            'DocumentCategoryName' => 'required',
        ]);

        $data = array(
            "DocumentCategoryName" => $request->input('DocumentCategoryName'),
        );
        $id = DB::table('document_category')->insertGetId($data);
        return redirect('DocumentCategory')->with('error', 'Saved Successfully')->with('class', 'success');
    }

    public function DocumentCategoryEdit($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $document_category = DB::table('document_category')->where('DocumentCategoryID', $id)->get();

        return view('document_category_edit', compact('document_category'));
    }


    public function DocumentCategoryUpdate(Request $request)
    {


        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Update');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////
        $this->validate($request, [
            'DocumentCategoryName' => 'required',
        ]);

        $data = array(
            "DocumentCategoryName" => $request->input('DocumentCategoryName'),
        );

        $id = DB::table('document_category')->where('DocumentCategoryID', $request->DocumentCategoryID)->update($data);

        return redirect('DocumentCategory')->with('error', 'Saved Successfully')->with('class', 'success');
    }

    public function DocumentCategoryDelete($id)
    {

        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Job Title', 'Delete');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////

        $id = DB::table('document_category')->where('DocumentCategoryID', $id)->delete();



        return redirect('/DocumentCategory')->with('error', 'Deleted Successfully')->with('class', 'success');
    }



    public  function Document($id = null)
    {

        $pagetitle = 'Document';

        if ($id) {
            Session::put('DocumentCategoryID', $id);
            $documents = DB::table('documents')->where('DocumentCategoryID', Session::get('DocumentCategoryID'))->get();
        } else {
            $documents = DB::table('documents')->take(1)->get();
        }

        $document_category = DB::table('document_category')->get();
        return view('document', compact('documents', 'pagetitle', 'document_category'));
    }


    public  function DocumentSave(request $request)
    {




        $size = formatBytes($request->file('FileUpload')->getSize());

        $MimeType = substr($request->file('FileUpload')->getMimeType(), 0, 5);


        if ($request->hasFile('FileUpload')) {
            $this->validate($request, [
                'FileUpload' => 'required|image|mimes:jpeg,png,jpg,gif|max:20000',
            ]);

            $file = $request->file('FileUpload');
            $input['filename'] = time() . '.' . $file->extension();

            $destinationPath = public_path('/documents');

            $file->move($destinationPath, $input['filename']);



            $data = array(

                'FileName' => $request->FileName1,
                'DocumentCategoryID' => $request->DocumentCategoryID,


                'StartDate' => dateformatpc($request->StartDate),
                'ExpiryDate' => dateformatpc($request->EndDate),
                'Cost' => $request->Cost,

                'File' => $input['filename'],
                'FileSize' => $size,
                'MimeType' => $MimeType

            );



            DB::table('documents')->insertGetId($data);
        }





        return redirect('Document')->with('error', 'Document Saved.')->with('class', 'success');
    }


    public  function DocumentDelete($id, $file)
    {

        $id = DB::table('documents')->where('DocumentID', $id)->delete();

        unlink('documents/' . $file);

        return redirect()->back()->with('error', 'Deleted Successfully.')->with('class', 'success');
    }

    public  function Fleet()
    {


        $pagetitle = 'Fleet Managment';

        $fleet_master = DB::table('fleet_master')->get();


        return view('fleet', compact('pagetitle', 'fleet_master'))->with('error', 'Logout Successfully.')->with('class', 'success');
    }


    public  function FleetSave(request $request)
    {

        $this->validate($request, [

            'VehicleModel' => 'required',
            'OwnerName' => 'required',

        ]);


        $data = array(
            'VehicleModel' => $request->VehicleModel,
            'OwnerName' => $request->OwnerName,
        );



        $id =  DB::table('fleet_master')->insertGetId($data);

        return redirect('Fleet')->with('error', 'Save successfully')->with('class', 'success');
    }

    public  function FleetEdit($id)
    {

        $pagetitle = 'Fleet Managment';


        $fleet = DB::table('fleet_master')->where('FleetMasterID', $id)->get();

        return view('fleet_edit', compact('fleet', 'pagetitle'));
    }




    public  function FleetUpdate(request $request)
    {

        $this->validate($request, [

            'VehicleModel' => 'required',
            'OwnerName' => 'required',

        ]);


        $data = array(
            'VehicleModel' => $request->VehicleModel,
            'OwnerName' => $request->OwnerName,
        );






        $id = DB::table('fleet_master')->where('FleetMasterID', $request->FleetMasterID)->update($data);

        return redirect('Fleet')->with('error', 'Save successfully')->with('class', 'success');
    }





    public  function FleetDelete($id)
    {

        $id = DB::table('fleet_master')->where('FleetMasterID', $id)->delete();



        return redirect()->back()->with('error', 'Deleted Successfully.')->with('class', 'success');
    }

    public function FleetDetail($id = null)


    {


        $pagetitle = 'Fleet';


        if ($id) {

            Session::put('FleetMasterID', $id);
        }





        $fleet_master = DB::table('fleet_master')->where('FleetMasterID', Session::get('FleetMasterID'))->get();
        $fleet_detail = DB::table('fleet_detail')->where('FleetMasterID', Session::get('FleetMasterID'))->get();

        return view('fleet_detail', compact('pagetitle', 'fleet_master', 'fleet_detail'));
    }


    public  function FleetDetailSave(request $request)
    {



        // dd($request->all());
        $data = array(
            'FleetMasterID' => $request->FleetMasterID,
            'RegistrationStartDate' => dateformatpc($request->RegistrationStartDate),
            'RegistrationEndDate' => dateformatpc($request->RegistrationEndDate),
            'InsuranceStartDate' => dateformatpc($request->InsuranceStartDate),
            'InsuranceEndDate' => dateformatpc($request->InsuranceEndDate),
            'InsuranceCompanyName' => $request->InsuranceCompanyName,
            'LastReading' => $request->LastReading,
            'OilChangeDate' => dateformatpc($request->OilChangeDate),
            'OilDueDate' => dateformatpc($request->OilDueDate),


        );



        $id =  DB::table('fleet_detail')->insertGetId($data);

        return redirect('FleetDetail')->with('error', 'Save successfully')->with('class', 'success');
    }

    public  function FleetDetailDelete($id)
    {

        $id = DB::table('fleet_detail')->where('FleetDetailID', $id)->delete();



        return redirect()->back()->with('error', 'Deleted Successfully.')->with('class', 'success');
    }


    public function DailyReport()
    {


        $pagetitle = 'Daily Report';

        $employee = DB::table('v_employee')->get();

        $daily_report = DB::table('daily_report')->get();

        return view('daily_report', compact('pagetitle', 'employee', 'daily_report'));
    }


    public function DailyReport1(request $request)
    {



        $pagetitle = 'Daily Report';

        $employee = DB::table('v_employee')->get();

        $daily_report = DB::table('daily_report')->where('Date', $request->Date)->get();

        return view('daily_report', compact('pagetitle', 'employee', 'daily_report'));
    }


    public function NoticeBoard()
    {


        $pagetitle = 'Daily Report';

        $notice = DB::table('notice_board')->get();

        return view('notice_board', compact('pagetitle', 'notice'));
    }

    public function NoticeBoardSave(request $request)
    {


        $data = array(

            'Title' => $request->Title,
            'Detail' => $request->Detail,
            'Date' => dateformatpc($request->Date),
            'Status' => $request->Status,

        );



        $id = DB::table('notice_board')->insertGetId($data);
        return redirect('NoticeBoard')->with('error', 'Save successfully')->with('class', 'success');
    }


    public function NoticeBoardEdit($id)
    {


        $pagetitle = 'Daily Report';

        $notice = DB::table('notice_board')->where('NoticeBoardID', $id)->get();
        return view('notice_board_edit', compact('pagetitle', 'notice'));
    }





    public  function NoticeBoardUpdate(request $request)
    {


        $data = array(

            'Title' => $request->Title,
            'Detail' => $request->Detail,
            'Date' => dateformatpc($request->Date),
            'Status' => $request->Status,

        );





        $id = DB::table('notice_board')->where('NoticeBoardID', $request->NoticeBoardID)->update($data);

        return redirect('NoticeBoard')->with('error', 'Successfully done')->with('class', 'success');
    }
    public function salaryExport($MonthName)
    {
        ///////////////////////USER RIGHT & CONTROL ///////////////////////////////////////////
        $allow = check_role(Session::get('UserID'), Session::get('BranchID'), 'Search Salary', 'List');
        if ($allow[0]->Allow == 'N') {
            return redirect()->back()->with('error', 'You access is limited')->with('class', 'danger');
        }
        ////////////////////////////END SCRIPT ////////////////////////////////////////////////



        $pagetitle = 'Print Salary';
        if ($MonthName) {

            Session::put('MonthName', $MonthName);
        }
        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0', 'Content-type'  => 'text/csv', 'Content-Disposition' => 'attachment; filename=SalaryDetails (' . Session::get('MonthName') . ').csv', 'Expires'  => '0', 'Pragma' => 'public',
        ];
        $salary = [];
        $BasicSalary = 0;
        $HRA = 0;
        $Transport = 0;
        $OtherAllowance = 0;
        $AdvanceLoan = 0;
        $LeaveDeduction = 0;
        $GrandSalary = 0;
        $NetSalary = 0;
        $TotalDeduction = 0;
        $data = DB::table('salary')->where('MonthName', Session::get('MonthName'))->where('BranchID', Session::get('BranchID'))->get();
        foreach ($data as $key => $datum) {
            $dataArray = [];
            $dataArray['Employee Name'] = $datum->EmployeeName;
            $dataArray['Job Title'] = $datum->JobTitle != null ? $datum->JobTitle : 'N/A';
            $dataArray['Department'] = $datum->Department != null ? $datum->Department : 'N/A';
            $dataArray['Days Present'] = $datum->DaysPresent != null ? $datum->DaysPresent :  '0';
            $dataArray['LWPay'] = $datum->LWPay != null ? $datum->LWPay :  '0';
            $dataArray['Per Day'] = $datum->PerDay != null ? $datum->PerDay :  '0';
            $dataArray['Basic'] = $datum->BasicSalary != null ? $datum->BasicSalary :  '0';
            $dataArray['HRA'] = $datum->HRA != null ? $datum->HRA :  '0';
            $dataArray['Transport'] = $datum->Transport != null ? $datum->Transport :  '0';
            $dataArray['Other Com'] = $datum->OtherAllowance != null ? $datum->OtherAllowance :  '0';
            $dataArray['Adv Loan'] = $datum->AdvanceLoan != null ? $datum->AdvanceLoan :  '0';
            $dataArray['Leave Ded'] = $datum->LeaveDeduction != null ? $datum->LeaveDeduction :  '0';
            $dataArray['Total Ded'] = $datum->TotalDeduction != null ? $datum->TotalDeduction :  '0';
            $dataArray['Grand Salary'] = $datum->GrandSalary != null ? $datum->GrandSalary :  '0';
            $dataArray['Net Salary'] = $datum->NetSalary != null ? $datum->NetSalary :  '0';

            array_push($salary, $dataArray);
            $BasicSalary = $BasicSalary + $datum->BasicSalary;
            $HRA = $HRA + $datum->HRA;
            $Transport = $Transport + $datum->Transport;
            $OtherAllowance = $OtherAllowance + $datum->OtherAllowance;
            $AdvanceLoan = $AdvanceLoan + $datum->AdvanceLoan;
            $LeaveDeduction = $LeaveDeduction + $datum->LeaveDeduction;
            $TotalDeduction = $TotalDeduction + $datum->TotalDeduction;
            $GrandSalary = $GrandSalary + $datum->GrandSalary;
            $NetSalary = $NetSalary + $datum->NetSalary;
        }
        $sumRow = ['', '', '', '', '', 'Grand Total', $BasicSalary, $HRA, $Transport, $OtherAllowance, $AdvanceLoan, $LeaveDeduction, $TotalDeduction, $GrandSalary, $NetSalary];
        $emptyRow = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
        array_push($salary, $emptyRow);
        array_push($salary, $sumRow);


        array_unshift($salary, array_keys($salary[0]));
        $callback = function () use ($salary) {
            $FH = fopen('php://output', 'w');
            foreach ($salary as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        return response()->stream($callback, 200, $headers);
    }
}
