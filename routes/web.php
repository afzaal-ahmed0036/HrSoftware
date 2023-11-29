<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;


 
use App\Http\Controllers\HR;

use App\Http\Controllers\Employee;

use App\Http\Controllers\CompanyController;
 
 

Route::get('/',[HR::class,'Login']);
Route::post('/UserVerify',[HR::class,'UserVerify']);

 

route::get('/EmployeeVerify/',[HR::class,'EmployeeVerify']);


Route::group(['middleware' => ['CheckAdmin']], function () {


Route::get('/Employee',[HR::class,'Employee']);
Route::get('/ajax_employee',[HR::class,'ajax_employee']);
Route::get('/Dashboard',[HR::class,'Dashboard'])->name('kashif');
Route::get('/EmployeeCreate',[HR::class,'EmployeeCreate']);
Route::post('/EmployeeSave',[HR::class,'EmployeeSave']);
Route::get('/EmployeeDelete/{id}',[HR::class,'EmployeeDelete']);
Route::get('/Login',[HR::class,'Login']);
Route::get('/EmployeeDetail/{id?}',[HR::class,'EmployeeDetail']);
Route::get('/EmployeeEdit/{id}',[HR::class,'EmployeeEdit']);
Route::post('/EmployeeUpdate',[HR::class,'EmployeeUpdate']);

 route::post('/EmpSalarySave/',[HR::class,'EmpSalarySave']);
 route::post('/EmpSalaryUpdate/',[HR::class,'EmpSalaryUpdate']);
 route::post('/EmpAllowanceSave/',[HR::class,'EmpAllowanceSave']);
 route::get('/EmpAllowanceDelete/{id}',[HR::class,'EmpAllowanceDelete']);
 route::get('/EmployeeLoan/',[HR::class,'EmployeeLoan']);
 route::post('/LoanSave/',[HR::class,'LoanSave']);
 route::get('/LoanDelete/{id}',[HR::class,'LoanDelete']);
 route::get('/LoanInstallmentDelete/{id}',[HR::class,'LoanInstallmentDelete']);
 





 // branch section
 route::get('/Branches',[HR::class,'Branches']);
 route::Post('/BranchSave',[HR::class,'BranchSave']);
 route::get('/BranchDelete/{id}',[HR::class,'BranchDelete']);
 route::get('/BranchEdit/{id}',[HR::class,'BranchEdit']);
 route::post('/BranchUpdate/',[HR::class,'BranchUpdate']);

 // Department section
 route::get('/Departments',[HR::class,'Departments']);
 route::Post('/DepartmentSave',[HR::class,'DepartmentSave']);
 route::get('/DepartmentDelete/{id}',[HR::class,'DepartmentDelete']);
 route::get('/DepartmentEdit/{id}',[HR::class,'DepartmentEdit']);
 route::post('/DepartmentUpdate/',[HR::class,'DepartmentUpdate']);

 
 // Department section
 route::get('/JobTitle',[HR::class,'JobTitle']);
 route::Post('/JobTitleSave',[HR::class,'JobTitleSave']);
 route::get('/JobTitleDelete/{id}',[HR::class,'JobTitleDelete']);
 route::get('/JobTitleEdit/{id}',[HR::class,'JobTitleEdit']);
 route::post('/JobTitleUpdate/',[HR::class,'JobTitleUpdate']);



// ............Company............
Route::get('/Company',[CompanyController::class,'Company']);
Route::post('/SaveCompany',[CompanyController::class,'SaveCompany']);
Route::get('/CompanyEdit/{id}',[CompanyController::class,'CompanyEdit']);
Route::post('/CompanyUpdate/',[CompanyController::class,'CompanyUpdate']);
Route::get('/CompanyDelete/{id}',[CompanyController::class,'CompanyDelete']);

// document
route::get('/DocumentCategory',[HR::class,'DocumentCategory']);
 route::Post('/DocumentCategorySave',[HR::class,'DocumentCategorySave']);
 route::get('/DocumentCategoryDelete/{id}',[HR::class,'DocumentCategoryDelete']);
 route::get('/DocumentCategoryEdit/{id}',[HR::class,'DocumentCategoryEdit']);
 route::post('/DocumentCategoryUpdate/',[HR::class,'DocumentCategoryUpdate']);

 

route::get('/Document/{id?}',[HR::class,'Document']);
route::post('/DocumentSave',[HR::class,'DocumentSave']);
route::get('/DocumentDelete/{id}/{file}',[HR::class,'DocumentDelete']);


// Fleet manage

Route::get('/Fleet/',[HR::class,'Fleet']);
Route::post('/FleetSave/',[HR::class,'FleetSave']);
Route::get('/FleetEdit/{id}',[HR::class,'FleetEdit']);
Route::post('/FleetUpdate/',[HR::class,'FleetUpdate']);
route::get('/FleetDelete/{id}',[HR::class,'FleetDelete']);
route::get('/FleetDetail/{id?}',[HR::class,'FleetDetail']);
Route::post('/FleetDetailSave/',[HR::class,'FleetDetailSave']);
route::get('/FleetDetailDelete/{id}',[HR::class,'FleetDetailDelete']);


Route::get('/DailyReport/',[HR::class,'DailyReport']);
Route::post('/DailyReport1/',[HR::class,'DailyReport1']);

Route::get('/NoticeBoard/',[HR::class,'NoticeBoard']);
Route::post('/NoticeBoardSave/',[HR::class,'NoticeBoardSave']);

Route::get('/NoticeBoardEdit/{id}',[HR::class,'NoticeBoardEdit']);
Route::post('/NoticeBoardUpdate/',[HR::class,'NoticeBoardUpdate']);





 // FCB section
 route::get('/FCB',[HR::class,'FCB']);

route::post('/FCBPrint/',[HR::class,'FCBPrint']);
 

route::get('/FCBMonth/{type}',[HR::class,'FCBMonth']);
route::post('/FCBSetMonthName/',[HR::class,'FCBSetMonthName']);
 
route::get('/FCBView/',[HR::class,'FCBView']); 
route::post('/Ajax_FCBMonthName/',[HR::class,'Ajax_FCBMonthName']); 

 route::Post('/FCBSave',[HR::class,'FCBSave']);
 route::get('/FCBDelete/{id}',[HR::class,'FCBDelete']);
 route::get('/FCBEdit/{id}',[HR::class,'FCBEdit'])->name('edit-fcb');
 route::post('/FCBUpdate/',[HR::class,'FCBUpdate']);

 
 route::get('/Role/{UserID}',[HR::class,'Role']);
 route::post('/RoleSave',[HR::class,'RoleSave']);
 route::get('/RoleView/{UserID}',[HR::class,'RoleView']);
 route::post('/RoleUpdate',[HR::class,'RoleUpdate']);

 route::get('/checkUserRole/{UserID}',[HR::class,'checkUserRole']);


 route::get('/Leave/',[HR::class,'Leave']);
 route::post('/LeaveSave/',[HR::class,'LeaveSave']);
 route::get('/ajax_leave',[HR::class,'ajax_leave']);
 route::get('/LeaveEdit/{id}',[HR::class,'LeaveEdit']);
 route::post('/LeaveUpdate',[HR::class,'LeaveUpdate']);

 route::get('/LeaveDelete/{id}',[HR::class,'LeaveDelete']);
 route::get('/LeaveDetail/{id}',[HR::class,'LeaveDetail']);
 
 route::get('/Letter/',[HR::class,'Letter']);
 route::post('/save_letter/',[HR::class,'save_letter']);
 route::get('/letter_delete/{id}',[HR::class,'letter_delete']);
 route::get('/letter_edit/{LetterID}',[HR::class,'letter_edit']);
 route::post('/letter_update/',[HR::class,'letter_update']);
 route::get('/AttendanceImport',[HR::class,'AttendanceImport']);
 route::post('/Import',[HR::class,'Import'])->name('Import');

 route::get('/EmployeeAttendance/',[HR::class,'EmployeeAttendance']);

 route::get('/EmployeeSalary/',[HR::class,'EmployeeSalary']);
 route::get('/EmployeeComission/{EmployeeID}/{MonthName}',[HR::class,'EmployeeComission']);
 route::get('/EmployeeLetters/',[HR::class,'EmployeeLetters']);
 route::post('/letter_issue_preview/',[HR::class,'letter_issue_preview']);
 route::post('/letter_issue_save/',[HR::class,'letter_issue_save']);
 route::get('/issue_letter_delete/{id}',[HR::class,'issue_letter_delete']);
 route::get('/issue_letter_edit/{id}',[HR::class,'issue_letter_edit']);
 route::post('/issue_letter_update',[HR::class,'issue_letter_update']);
 route::get('/issue_letter_print/{issue_letter_id}',[HR::class,'issue_letter_print']);

 route::get('/EmployeeDocuments/',[HR::class,'EmployeeDocuments']);
 route::post('/EmployeeDocumentUpload/',[HR::class,'EmployeeDocumentUpload']);
 route::get('/EmployeeDocumentDelete/{id}',[HR::class,'EmployeeDocumentDelete']);


 route::get('/EmployeeLeaveReport/',[HR::class,'EmployeeLeaveReport']);

route::get('/SalarySlip/{id?}',[HR::class,'SalarySlip']);


 route::post('/IssueLetter/',[HR::class,'IssueLetter']);

 route::get('/EmployeeFCB/',[HR::class,'EmployeeFCB']);
 route::get('/EmployeeWarningLeter/',[HR::class,'EmployeeWarningLeter']);
 route::get('/CalculateComission/',[HR::class,'CalculateComission']);
 route::get('/Salary/',[HR::class,'Salary']);
 route::post('/Salary2/',[HR::class,'Salary2']);
 route::post('/SaveSalary/',[HR::class,'SaveSalary']);
 route::get('/ViewSalary/',[HR::class,'ViewSalary']);
 route::post('/SearchSalary/',[HR::class,'SearchSalary']);
 route::get('/SalaryPrint/{MonthName}/{BranchID}',[HR::class,'SalaryPrint']);
 route::get('/SalaryDelete/{id}',[HR::class,'SalaryDelete']);
 route::get('/SalaryEdit/{id}',[HR::class,'SalaryEdit']);
 route::post('/SalaryUpdate',[HR::class,'SalaryUpdate']);
route::get('/SalaryExport/{MonthName}/{BranchID}', [HR::class, 'SalaryExport']);
route::get('/EmployeeExport/{BranchID}', [Employee::class, 'EmployeeExport']);



 route::get('/EU/',[HR::class,'EU']);
 route::Post('/EUSave/',[HR::class,'EUSave']);

 route::get('/EUEdit/{EuID}',[HR::class,'EUEdit']);
 route::Post('/EUUpdate/',[HR::class,'EUUpdate']);
 
 route::get('/EUView/{EuID}',[HR::class,'EUView']);

 route::get('/EUDelete/{id}',[HR::class,'EUDelete']);
 
 route::get('/EmployeeTeam',[HR::class,'EmployeeTeam']);
 route::get('/Team',[HR::class,'Team']);
 


 route::get('/VisaAlert',[HR::class,'VisaAlert']);
 route::get('/PassportAlert',[HR::class,'PassportAlert']);
 route::get('/LeaveAlert',[HR::class,'LeaveAlert']);
 route::get('/AttendanceAlert',[HR::class,'AttendanceAlert']);
 

 route::get('/UserProfile',[HR::class,'UserProfile']);
 route::get('/ChangePassword',[HR::class,'ChangePassword']);
 route::post('/UpdatePassword',[HR::class,'UpdatePassword']);


route::get('/Users/',[HR::class,'Users']);
route::post('/SaveUser/',[HR::class,'SaveUser']);
route::get('/EditUser/{userid}',[HR::class,'EditUser']);
route::post('/UpdateUser/',[HR::class,'UpdateUser']);
route::get('/DeleteUser/{userid}',[HR::class,'DeleteUser']);

 

// FCB section
Route::get('/FCBAdd', [FCB::class,'FCBAdd']);
Route::post('/FCBAdd', [FCB::class,'saveFCB']);
Route::get('/FCBListing', [FCB::class,'fcbListing']);
Route::get('/filterWiseFCBListing', [FCB::class,'searchFcbListing']);
Route::get('/getBranchWiseEmployees', [FCB::class,'getBranchWiseEmployees']);
Route::get('/checkDuplicateIds', [FCB::class,'checkDuplicateIds']);
Route::get('/fcbEdit/{id}',[FCB::class,'editFcb'])->name('fcb.edit');
Route::post('/fcbUpdate',[FCB::class,'updateFcb'])->name('fcb.update');
Route::get('/fcbDelete/{id}',[FCB::class,'fcbDelete']);

// Live Account section
Route::get('/LiveAccountAdd', [LiveAccount::class,'LiveAccountAdd']);
Route::post('/LiveAccountAdd', [LiveAccount::class,'saveLiveAccount']);
Route::get('/LiveAccountListing', [LiveAccount::class,'liveAccountListing']);
Route::get('/filterWiseLiveAccountListing', [LiveAccount::class,'searchLiveAccountListing']);
Route::get('/checkDuplicateIdsInLiveAccounts', [LiveAccount::class,'checkDuplicateIdsInLiveAccounts']);
Route::get('/liveAccountEdit/{id}',[LiveAccount::class,'editLiveAccount'])->name('live_account.edit');
Route::post('/liveAccountUpdate',[LiveAccount::class,'updateLiveAccount'])->name('liveAccount.update');

 // Month Setting section
Route::get('/CurrentTarget',[MonthlyTarget::class,'CurrentTarget']);
Route::post('/CurrentTarget',[MonthlyTarget::class,'MonthlyTargetSave']);
Route::get('/TargetList',[MonthlyTarget::class,'TargetList']);
Route::get('/filterWiseTargetListing',[MonthlyTarget::class,'searchTargetListing']);
Route::get('/monthlyTarget/{id}',[MonthlyTarget::class,'MonthlyTargetEdit'])->name('edit-monthly-target');
Route::post('/CurrentTargetUpdate',[MonthlyTarget::class,'MonthlyTargetUpdate']);
Route::get('/monthlyTargetDelete/{id}',[MonthlyTarget::class,'MonthlyTargetDelete']);


// Reports section
Route::get('/TopAgentReport', [FCBReports::class,'TopAgentReport']);
Route::post('/TopAgentReport', [FCBReports::class,'SearchTopAgentReport']);
Route::get('/YearlyReport', [FCBReports::class,'YearlyReport']);
Route::post('/YearlyReport', [FCBReports::class,'SearchYearlyReport']);
Route::get('/QuarterlyReport', [FCBReports::class,'QuarterlyReport']);
Route::post('/QuarterlyReport', [FCBReports::class,'SearchQuarterlyReport']);

Route::get('/TopLiveAccount', [FCBReports::class,'TopLiveAccount']);
Route::post('/TopLiveAccount', [FCBReports::class,'SearchTopLiveAccount']);


});

 route::get('/StaffDashboard/',[Employee::class,'StaffDashboard']);
 route::get('/StaffDocuments/',[Employee::class,'StaffDocuments']);
 route::get('/StaffSalary/',[Employee::class,'StaffSalary']);
 route::get('/StaffComission/{EmployeeID}/{MonthName}',[Employee::class,'StaffComission']);
 route::get('/StaffLetters/',[Employee::class,'StaffLetters']);
 route::get('/StaffLeave/',[Employee::class,'StaffLeave']);
 route::get('/ajax_StaffLeave/',[Employee::class,'ajax_StaffLeave']);
 route::post('/StaffLeaveSave/',[Employee::class,'StaffLeaveSave']);




 route::get('/ajax_leave_validate/{leavetypeid}/{employeeid}',[Employee::class,'ajax_leave_validate']);


 route::get('/StaffLeaveDelete/{id}',[Employee::class,'StaffLeaveDelete']);
 route::get('/StaffAttendance/',[Employee::class,'StaffAttendance']);
 route::get('/StaffFCB/',[Employee::class,'StaffFCB']);
 route::get('/StaffTeam/',[Employee::class,'StaffTeam']);
 route::get('/StaffDailyReport/',[Employee::class,'StaffDailyReport']);
 route::post('/DailyReportSave/',[Employee::class,'DailyReportSave']);
 route::get('/StaffDailyReportDelete/{id}',[Employee::class,'StaffDailyReportDelete']);
 route::get('/StaffDailyReportEdit/{id}',[Employee::class,'StaffDailyReportEdit']);
 route::post('/DailyReportUpdate/',[Employee::class,'DailyReportUpdate']);
 
Route::get('/StaffLead/',[Employee::class,'StaffLead']);
Route::post('/StaffLeadSave/',[Employee::class,'StaffLeadSave']);
Route::get('/StaffLeadDelete/{id}',[Employee::class,'StaffLeadDelete']);

Route::get('/StaffDeal/',[Employee::class,'StaffDeal']);
Route::post('/StaffDealSave/',[Employee::class,'StaffDealSave']);
Route::get('/StaffDealDelete/{id}',[Employee::class,'StaffDealDelete']);

Route::get('/StaffTarget/',[Employee::class,'StaffTarget']);
Route::post('/StaffTargetSave/',[Employee::class,'StaffTargetSave']);
Route::get('/StaffTargetDelete/{id}',[Employee::class,'StaffTargetDelete']);


Route::get('/StaffTargetReply/{id}',[Employee::class,'StaffTargetReply']);
Route::post('/StaffTargetReplySave/',[Employee::class,'StaffTargetReplySave']);
Route::get('/StaffTargetReplyDelete/{id}',[Employee::class,'StaffTargetReplyDelete']);

route::get('/OMDashboard/',[OM::class,'Dashboard']);



Route::get('/logout',[HR::class,'logout']);


route::post('/SendEmail/',[HR::class,'SendEmail']);


route::get('/ComposeEmail/{EmployeeID}',[HR::class,'ComposeEmail']);




route::get('/ForgotPassword/',[HR::class,'ForgotPassword']);
route::post('/SendForgotEmail/',[HR::class,'SendForgotEmail']);
route::get('/EmailPin/',[HR::class,'EmailPin']);
route::post('/NewPassword/',[HR::class,'NewPassword']);
route::post('/UpdateNewPassword/',[HR::class,'UpdateNewPassword']);

route::get('/DepositExport/{type}',[HR::class,'DepositExport']);
 


// staff notice boad

Route::get('/StaffNoticeBoard/',[Employee::class,'StaffNoticeBoard']);
Route::get('/NoticeBoardView/{id}',[Employee::class,'NoticeBoardView']);
Route::get('/ApproveStaffLeave/{id}', [Employee::class, 'ApproveStaffLeave']);
Route::get('/RejectStaffLeave/{id}', [Employee::class, 'RejectStaffLeave']);
Route::get('/AddTeamMemDayTask/{id}', [Employee::class, 'AddTeamMemDayTask']);
