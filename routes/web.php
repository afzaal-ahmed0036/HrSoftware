<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\HR;

use App\Http\Controllers\Employee;

use App\Http\Controllers\CompanyController;



Route::get('/', [HR::class, 'Login']);
Route::post('/UserVerify', [HR::class, 'UserVerify']);



Route::get('/EmployeeVerify/', [HR::class, 'EmployeeVerify']);


Route::group(['middleware' => ['CheckAdmin']], function () {
    Route::group(['middleware' => ['CheckIn']], function () {
        Route::get('/Employee', [HR::class, 'Employee']);
        Route::get('/ajax_employee', [HR::class, 'ajax_employee']);
        Route::get('/Dashboard', [HR::class, 'Dashboard'])->name('kashif');
        Route::get('/EmployeeCreate', [HR::class, 'EmployeeCreate']);
        Route::post('/EmployeeSave', [HR::class, 'EmployeeSave']);
        Route::get('/EmployeeDelete/{id}', [HR::class, 'EmployeeDelete']);
        Route::get('/Login', [HR::class, 'Login']);
        Route::get('/EmployeeDetail/{id?}', [HR::class, 'EmployeeDetail']);
        Route::get('/EmployeeEdit/{id}', [HR::class, 'EmployeeEdit']);
        Route::post('/EmployeeUpdate', [HR::class, 'EmployeeUpdate']);

        Route::post('/EmpSalarySave/', [HR::class, 'EmpSalarySave']);
        Route::post('/EmpSalaryUpdate/', [HR::class, 'EmpSalaryUpdate']);
        Route::post('/EmpAllowanceSave/', [HR::class, 'EmpAllowanceSave']);
        Route::get('/EmpAllowanceDelete/{id}', [HR::class, 'EmpAllowanceDelete']);
        Route::get('/EmployeeLoan/', [HR::class, 'EmployeeLoan']);
        Route::post('/LoanSave/', [HR::class, 'LoanSave']);
        Route::get('/LoanDelete/{id}', [HR::class, 'LoanDelete']);
        Route::get('/LoanInstallmentDelete/{id}', [HR::class, 'LoanInstallmentDelete']);






        // branch section
        Route::get('/Branches', [HR::class, 'Branches']);
        Route::Post('/BranchSave', [HR::class, 'BranchSave']);
        Route::get('/BranchDelete/{id}', [HR::class, 'BranchDelete']);
        Route::get('/BranchEdit/{id}', [HR::class, 'BranchEdit']);
        Route::post('/BranchUpdate/', [HR::class, 'BranchUpdate']);

        // Department section
        Route::get('/Departments', [HR::class, 'Departments']);
        Route::Post('/DepartmentSave', [HR::class, 'DepartmentSave']);
        Route::get('/DepartmentDelete/{id}', [HR::class, 'DepartmentDelete']);
        Route::get('/DepartmentEdit/{id}', [HR::class, 'DepartmentEdit']);
        Route::post('/DepartmentUpdate/', [HR::class, 'DepartmentUpdate']);


        // Department section
        Route::get('/JobTitle', [HR::class, 'JobTitle']);
        Route::Post('/JobTitleSave', [HR::class, 'JobTitleSave']);
        Route::get('/JobTitleDelete/{id}', [HR::class, 'JobTitleDelete']);
        Route::get('/JobTitleEdit/{id}', [HR::class, 'JobTitleEdit']);
        Route::post('/JobTitleUpdate/', [HR::class, 'JobTitleUpdate']);



        // ............Company............
        Route::get('/Company', [CompanyController::class, 'Company']);
        Route::post('/SaveCompany', [CompanyController::class, 'SaveCompany']);
        Route::get('/CompanyEdit/{id}', [CompanyController::class, 'CompanyEdit']);
        Route::post('/CompanyUpdate/', [CompanyController::class, 'CompanyUpdate']);
        Route::get('/CompanyDelete/{id}', [CompanyController::class, 'CompanyDelete']);

        // document
        Route::get('/DocumentCategory', [HR::class, 'DocumentCategory']);
        Route::Post('/DocumentCategorySave', [HR::class, 'DocumentCategorySave']);
        Route::get('/DocumentCategoryDelete/{id}', [HR::class, 'DocumentCategoryDelete']);
        Route::get('/DocumentCategoryEdit/{id}', [HR::class, 'DocumentCategoryEdit']);
        Route::post('/DocumentCategoryUpdate/', [HR::class, 'DocumentCategoryUpdate']);



        Route::get('/Document/{id?}', [HR::class, 'Document']);
        Route::post('/DocumentSave', [HR::class, 'DocumentSave']);
        Route::get('/DocumentDelete/{id}/{file}', [HR::class, 'DocumentDelete']);


        // Fleet manage

        Route::get('/Fleet/', [HR::class, 'Fleet']);
        Route::post('/FleetSave/', [HR::class, 'FleetSave']);
        Route::get('/FleetEdit/{id}', [HR::class, 'FleetEdit']);
        Route::post('/FleetUpdate/', [HR::class, 'FleetUpdate']);
        Route::get('/FleetDelete/{id}', [HR::class, 'FleetDelete']);
        Route::get('/FleetDetail/{id?}', [HR::class, 'FleetDetail']);
        Route::post('/FleetDetailSave/', [HR::class, 'FleetDetailSave']);
        Route::get('/FleetDetailDelete/{id}', [HR::class, 'FleetDetailDelete']);


        Route::get('/DailyReport/', [HR::class, 'DailyReport']);
        Route::post('/DailyReport1/', [HR::class, 'DailyReport1']);

        Route::get('/NoticeBoard/', [HR::class, 'NoticeBoard']);
        Route::post('/NoticeBoardSave/', [HR::class, 'NoticeBoardSave']);

        Route::get('/NoticeBoardEdit/{id}', [HR::class, 'NoticeBoardEdit']);
        Route::post('/NoticeBoardUpdate/', [HR::class, 'NoticeBoardUpdate']);





        // FCB section
        Route::get('/FCB', [HR::class, 'FCB']);

        Route::post('/FCBPrint/', [HR::class, 'FCBPrint']);


        Route::get('/FCBMonth/{type}', [HR::class, 'FCBMonth']);
        Route::post('/FCBSetMonthName/', [HR::class, 'FCBSetMonthName']);

        Route::get('/FCBView/', [HR::class, 'FCBView']);
        Route::post('/Ajax_FCBMonthName/', [HR::class, 'Ajax_FCBMonthName']);

        Route::Post('/FCBSave', [HR::class, 'FCBSave']);
        Route::get('/FCBDelete/{id}', [HR::class, 'FCBDelete']);
        Route::get('/FCBEdit/{id}', [HR::class, 'FCBEdit'])->name('edit-fcb');
        Route::post('/FCBUpdate/', [HR::class, 'FCBUpdate']);


        Route::get('/Role/{UserID}', [HR::class, 'Role']);
        Route::post('/RoleSave', [HR::class, 'RoleSave']);
        Route::get('/RoleView/{UserID}', [HR::class, 'RoleView']);
        Route::post('/RoleUpdate', [HR::class, 'RoleUpdate']);

        Route::get('/checkUserRole/{UserID}', [HR::class, 'checkUserRole']);


        Route::get('/Leave/', [HR::class, 'Leave']);
        Route::post('/LeaveSave/', [HR::class, 'LeaveSave']);
        Route::get('/ajax_leave', [HR::class, 'ajax_leave']);
        Route::get('/LeaveEdit/{id}', [HR::class, 'LeaveEdit']);
        Route::post('/LeaveUpdate', [HR::class, 'LeaveUpdate']);

        Route::get('/LeaveDelete/{id}', [HR::class, 'LeaveDelete']);
        Route::get('/LeaveDetail/{id}', [HR::class, 'LeaveDetail']);

        Route::get('/Letter/', [HR::class, 'Letter']);
        Route::post('/save_letter/', [HR::class, 'save_letter']);
        Route::get('/letter_delete/{id}', [HR::class, 'letter_delete']);
        Route::get('/letter_edit/{LetterID}', [HR::class, 'letter_edit']);
        Route::post('/letter_update/', [HR::class, 'letter_update']);
        Route::get('/AttendanceImport', [HR::class, 'AttendanceImport']);
        Route::post('/Import', [HR::class, 'Import'])->name('Import');

        Route::get('/EmployeeAttendance/', [HR::class, 'EmployeeAttendance']);

        Route::get('/EmployeeSalary/', [HR::class, 'EmployeeSalary']);
        Route::get('/EmployeeComission/{EmployeeID}/{MonthName}', [HR::class, 'EmployeeComission']);
        Route::get('/EmployeeLetters/', [HR::class, 'EmployeeLetters']);
        Route::post('/letter_issue_preview/', [HR::class, 'letter_issue_preview']);
        Route::post('/letter_issue_save/', [HR::class, 'letter_issue_save']);
        Route::get('/issue_letter_delete/{id}', [HR::class, 'issue_letter_delete']);
        Route::get('/issue_letter_edit/{id}', [HR::class, 'issue_letter_edit']);
        Route::post('/issue_letter_update', [HR::class, 'issue_letter_update']);
        Route::get('/issue_letter_print/{issue_letter_id}', [HR::class, 'issue_letter_print']);

        Route::get('/EmployeeDocuments/', [HR::class, 'EmployeeDocuments']);
        Route::post('/EmployeeDocumentUpload/', [HR::class, 'EmployeeDocumentUpload']);
        Route::get('/EmployeeDocumentDelete/{id}', [HR::class, 'EmployeeDocumentDelete']);


        Route::get('/EmployeeLeaveReport/', [HR::class, 'EmployeeLeaveReport']);

        Route::get('/SalarySlip/{id?}', [HR::class, 'SalarySlip']);


        Route::post('/IssueLetter/', [HR::class, 'IssueLetter']);

        Route::get('/EmployeeFCB/', [HR::class, 'EmployeeFCB']);
        Route::get('/EmployeeWarningLeter/', [HR::class, 'EmployeeWarningLeter']);
        Route::get('/CalculateComission/', [HR::class, 'CalculateComission']);
        Route::get('/Salary/', [HR::class, 'Salary']);
        Route::post('/Salary2/', [HR::class, 'Salary2']);
        Route::post('/SaveSalary/', [HR::class, 'SaveSalary']);
        Route::get('/ViewSalary/', [HR::class, 'ViewSalary']);
        Route::post('/SearchSalary/', [HR::class, 'SearchSalary']);
        Route::get('/SalaryPrint/{MonthName}/{BranchID}', [HR::class, 'SalaryPrint']);
        Route::get('/SalaryDelete/{id}', [HR::class, 'SalaryDelete']);
        Route::get('/SalaryEdit/{id}', [HR::class, 'SalaryEdit']);
        Route::post('/SalaryUpdate', [HR::class, 'SalaryUpdate']);
        Route::get('/SalaryExport/{MonthName}/{BranchID}', [HR::class, 'SalaryExport']);
        Route::get('/EmployeeExport/{BranchID}', [Employee::class, 'EmployeeExport']);



        Route::get('/EU/', [HR::class, 'EU']);
        Route::Post('/EUSave/', [HR::class, 'EUSave']);

        Route::get('/EUEdit/{EuID}', [HR::class, 'EUEdit']);
        Route::Post('/EUUpdate/', [HR::class, 'EUUpdate']);

        Route::get('/EUView/{EuID}', [HR::class, 'EUView']);

        Route::get('/EUDelete/{id}', [HR::class, 'EUDelete']);

        Route::get('/EmployeeTeam', [HR::class, 'EmployeeTeam']);
        Route::get('/Team', [HR::class, 'Team']);



        Route::get('/VisaAlert', [HR::class, 'VisaAlert']);
        Route::get('/PassportAlert', [HR::class, 'PassportAlert']);
        Route::get('/LeaveAlert', [HR::class, 'LeaveAlert']);
        Route::get('/AttendanceAlert', [HR::class, 'AttendanceAlert']);


        Route::get('/UserProfile', [HR::class, 'UserProfile']);
        Route::get('/ChangePassword', [HR::class, 'ChangePassword']);
        Route::post('/UpdatePassword', [HR::class, 'UpdatePassword']);


        Route::get('/Users/', [HR::class, 'Users']);
        Route::post('/SaveUser/', [HR::class, 'SaveUser']);
        Route::get('/EditUser/{userid}', [HR::class, 'EditUser']);
        Route::post('/UpdateUser/', [HR::class, 'UpdateUser']);
        Route::get('/DeleteUser/{userid}', [HR::class, 'DeleteUser']);



        // FCB section
        Route::get('/FCBAdd', [FCB::class, 'FCBAdd']);
        Route::post('/FCBAdd', [FCB::class, 'saveFCB']);
        Route::get('/FCBListing', [FCB::class, 'fcbListing']);
        Route::get('/filterWiseFCBListing', [FCB::class, 'searchFcbListing']);
        Route::get('/getBranchWiseEmployees', [FCB::class, 'getBranchWiseEmployees']);
        Route::get('/checkDuplicateIds', [FCB::class, 'checkDuplicateIds']);
        Route::get('/fcbEdit/{id}', [FCB::class, 'editFcb'])->name('fcb.edit');
        Route::post('/fcbUpdate', [FCB::class, 'updateFcb'])->name('fcb.update');
        Route::get('/fcbDelete/{id}', [FCB::class, 'fcbDelete']);

        // Live Account section
        Route::get('/LiveAccountAdd', [LiveAccount::class, 'LiveAccountAdd']);
        Route::post('/LiveAccountAdd', [LiveAccount::class, 'saveLiveAccount']);
        Route::get('/LiveAccountListing', [LiveAccount::class, 'liveAccountListing']);
        Route::get('/filterWiseLiveAccountListing', [LiveAccount::class, 'searchLiveAccountListing']);
        Route::get('/checkDuplicateIdsInLiveAccounts', [LiveAccount::class, 'checkDuplicateIdsInLiveAccounts']);
        Route::get('/liveAccountEdit/{id}', [LiveAccount::class, 'editLiveAccount'])->name('live_account.edit');
        Route::post('/liveAccountUpdate', [LiveAccount::class, 'updateLiveAccount'])->name('liveAccount.update');

        // Month Setting section
        Route::get('/CurrentTarget', [MonthlyTarget::class, 'CurrentTarget']);
        Route::post('/CurrentTarget', [MonthlyTarget::class, 'MonthlyTargetSave']);
        Route::get('/TargetList', [MonthlyTarget::class, 'TargetList']);
        Route::get('/filterWiseTargetListing', [MonthlyTarget::class, 'searchTargetListing']);
        Route::get('/monthlyTarget/{id}', [MonthlyTarget::class, 'MonthlyTargetEdit'])->name('edit-monthly-target');
        Route::post('/CurrentTargetUpdate', [MonthlyTarget::class, 'MonthlyTargetUpdate']);
        Route::get('/monthlyTargetDelete/{id}', [MonthlyTarget::class, 'MonthlyTargetDelete']);


        // Reports section
        Route::get('/TopAgentReport', [FCBReports::class, 'TopAgentReport']);
        Route::post('/TopAgentReport', [FCBReports::class, 'SearchTopAgentReport']);
        Route::get('/YearlyReport', [FCBReports::class, 'YearlyReport']);
        Route::post('/YearlyReport', [FCBReports::class, 'SearchYearlyReport']);
        Route::get('/QuarterlyReport', [FCBReports::class, 'QuarterlyReport']);
        Route::post('/QuarterlyReport', [FCBReports::class, 'SearchQuarterlyReport']);

        Route::get('/TopLiveAccount', [FCBReports::class, 'TopLiveAccount']);
        Route::post('/TopLiveAccount', [FCBReports::class, 'SearchTopLiveAccount']);

        Route::get('/StaffDashboard/', [Employee::class, 'StaffDashboard']);
        Route::get('/StaffDocuments/', [Employee::class, 'StaffDocuments']);
        Route::get('/StaffSalary/', [Employee::class, 'StaffSalary']);
        Route::get('/StaffComission/{EmployeeID}/{MonthName}', [Employee::class, 'StaffComission']);
        Route::get('/StaffLetters/', [Employee::class, 'StaffLetters']);
        Route::get('/StaffLeave/', [Employee::class, 'StaffLeave']);
        Route::get('/ajax_StaffLeave/', [Employee::class, 'ajax_StaffLeave']);
        Route::post('/StaffLeaveSave/', [Employee::class, 'StaffLeaveSave']);




        Route::get('/ajax_leave_validate/{leavetypeid}/{employeeid}', [Employee::class, 'ajax_leave_validate']);


        Route::get('/StaffLeaveDelete/{id}', [Employee::class, 'StaffLeaveDelete']);
        Route::get('/StaffAttendance/', [Employee::class, 'StaffAttendance']);
        Route::get('/StaffFCB/', [Employee::class, 'StaffFCB']);
        Route::get('/StaffTeam/', [Employee::class, 'StaffTeam']);
        Route::get('/StaffDailyReport/', [Employee::class, 'StaffDailyReport']);
        Route::post('/DailyReportSave/', [Employee::class, 'DailyReportSave']);
        Route::get('/StaffDailyReportDelete/{id}', [Employee::class, 'StaffDailyReportDelete']);
        Route::get('/StaffDailyReportEdit/{id}', [Employee::class, 'StaffDailyReportEdit']);
        Route::post('/DailyReportUpdate/', [Employee::class, 'DailyReportUpdate']);

        Route::get('/StaffLead/', [Employee::class, 'StaffLead']);
        Route::post('/StaffLeadSave/', [Employee::class, 'StaffLeadSave']);
        Route::get('/StaffLeadDelete/{id}', [Employee::class, 'StaffLeadDelete']);

        Route::get('/StaffDeal/', [Employee::class, 'StaffDeal']);
        Route::post('/StaffDealSave/', [Employee::class, 'StaffDealSave']);
        Route::get('/StaffDealDelete/{id}', [Employee::class, 'StaffDealDelete']);

        Route::get('/StaffTarget/', [Employee::class, 'StaffTarget']);
        Route::post('/StaffTargetSave/', [Employee::class, 'StaffTargetSave']);
        Route::get('/StaffTargetDelete/{id}', [Employee::class, 'StaffTargetDelete']);


        Route::get('/StaffTargetReply/{id}', [Employee::class, 'StaffTargetReply']);
        Route::post('/StaffTargetReplySave/', [Employee::class, 'StaffTargetReplySave']);
        Route::get('/StaffTargetReplyDelete/{id}', [Employee::class, 'StaffTargetReplyDelete']);

        Route::get('/OMDashboard/', [OM::class, 'Dashboard']);



        Route::get('/logout', [HR::class, 'logout']);


        Route::post('/SendEmail/', [HR::class, 'SendEmail']);


        Route::get('/ComposeEmail/{EmployeeID}', [HR::class, 'ComposeEmail']);




        Route::get('/ForgotPassword/', [HR::class, 'ForgotPassword']);
        Route::post('/SendForgotEmail/', [HR::class, 'SendForgotEmail']);
        Route::get('/EmailPin/', [HR::class, 'EmailPin']);
        Route::post('/NewPassword/', [HR::class, 'NewPassword']);
        Route::post('/UpdateNewPassword/', [HR::class, 'UpdateNewPassword']);

        Route::get('/DepositExport/{type}', [HR::class, 'DepositExport']);
        // staff notice boad

        Route::get('/StaffNoticeBoard/', [Employee::class, 'StaffNoticeBoard']);
        Route::get('/NoticeBoardView/{id}', [Employee::class, 'NoticeBoardView']);
        Route::get('/ApproveStaffLeave/{id}', [Employee::class, 'ApproveStaffLeave']);
        Route::get('/RejectStaffLeave/{id}', [Employee::class, 'RejectStaffLeave']);
        Route::get('/AddTeamMemDayTask/{id}', [Employee::class, 'AddTeamMemDayTask']);
        Route::get('CheckOut', [AttendanceController::class, 'checkOut']);
        Route::post('saveCheckOut', [AttendanceController::class, 'saveCheckOut']);
    });
    Route::get('CheckIN', [AttendanceController::class, 'checkIN']);
    Route::post('saveCheckIN', [AttendanceController::class, 'saveCheckIN']);
    Route::get('/notCheckedIn', [HR::class, 'logout']);
});
