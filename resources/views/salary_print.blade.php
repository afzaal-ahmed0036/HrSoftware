<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="shortcut icon" href="{{URL('/')}}/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
         <!-- Icons Css -->
         <!-- App Css-->
         <style type="text/css">
 
.style1 {
	font-size: 16px;
	font-weight: bold;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
    

 }
    

     @page {
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
            }

         </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body onload="window.print();">
  <div class="main-content">

                <div class="page-content">
                    <div class="container">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                  

                                    <div class="page-title-right "><div class="page-title-right text-danger"><div align="center">
                    <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td colspan="2"><div align="center"><img src="{{URL('/uploads/'.$branch[0]->BranchLogo)}}" width="222" height="61"></div></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="2"><div align="center">                                                  <span class="mb-sm-0 font-size-18 style1">Salary Detail</span></div></td>
                                              </tr>
                                              <tr>
                                                <td>Salary for the [{{session::get('MonthName')}}] </td>
                                                <td><div align="right">Branch Name: {{$branch[0]->BranchName}} <br> Print Date: {{date('d-m-Y G:i:s')}}</div></td>
                                              </tr>
                                            </table>
                                          </div>
                                        </div>
                                  </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-12">
  
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"> </h4>


<div class="row">
                                         
                                        </div>
                                      
                                        <table   style="border-collapse: collapse; width: 100%" border="1">
                                            <thead>
                                             
                                                <tr style="background-color: #eee;">
                                                    <th scope="col">S.No</th>
                                                     <th scope="col">Employee</th>
                                                    <th scope="col">Job Title </th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Days Present</th>
                                                    <th scope="col">LWPay</th>
                                                    <th scope="col">PerDay</th>
                                                    
                                                    <th scope="col">Basic</th>
                                                    <th scope="col">HRA</th>
                                                    <th scope="col">Transport</th>
                                                    <th scope="col">Other Com</th>
                                                    <th scope="col">Adv Loan</th>
                                                    
                                                    <th scope="col">Leave Ded</th>
                                                    <th scope="col">Total Ded</th>
                                                    
                                                    <th scope="col">Grand Salary</th>
                                                    <th scope="col">Net Salary</th>
                                                     
                                                   </tr>


                                             

                                          
                                             </thead>
        
        
                                            <tbody>

<?php 

$BasicSalary=0;
$HRA=0;
$Transport=0;
$OtherAllowance=0;
$AdvanceLoan=0;
$LeaveDeduction=0;
$GrandSalary=0;
$NetSalary=0;
$TotalDeduction=0;

 ?>

                                            
                                             
                                              <?php foreach ($salary as $key => $value): ?>

<?php 

$BasicSalary=$BasicSalary+$value->BasicSalary;
$HRA=$HRA+$value->HRA;
$Transport=$Transport+$value->Transport;
$OtherAllowance=$OtherAllowance+$value->OtherAllowance;
$AdvanceLoan=$AdvanceLoan+$value->AdvanceLoan;
$LeaveDeduction=$LeaveDeduction+$value->LeaveDeduction;
$TotalDeduction=$TotalDeduction+$value->TotalDeduction;
$GrandSalary=$GrandSalary+$value->GrandSalary;
$NetSalary=$NetSalary+$value->NetSalary;



 ?>


                                            <tr>
                                                
                                              
                                                <td> {{$key+1}} </td>
                                                 <td> {{$value->EmployeeName}} </td>
                                                 <td> {{$value->JobTitle}} </td>
                                                 <td> {{$value->Department}} </td>
                                                 <td align="right"> {{$value->DaysPresent}} </td>
                                                 <td align="right"> {{$value->LWPay}} </td>
                                                 <td align="right"> {{number_format($value->PerDay)}} </td>
                                                 <td align="right"> {{number_format($value->BasicSalary)}} </td>
                                                 <td align="right"> {{number_format($value->HRA)}} </td>
                                                 <td align="right"> {{number_format($value->Transport)}} </td>
                                                 <td align="right"> {{number_format($value->OtherAllowance)}} </td>
                                                 <td align="right"> {{number_format($value->AdvanceLoan)}} </td>
                                                 <td align="right"> {{number_format($value->LeaveDeduction)}} </td>
                                                 <td align="right"> {{number_format($value->GrandSalary)}} </td>
                                                 <td align="right"> {{number_format($value->NetSalary)}} </td>
                                                 <td align="right"> {{number_format($value->NetSalary)}} </td>

                                                 
                                                
                                                 
                                            </tr>
                                            <?php endforeach ?>

                                             <tr class="bg-light ">
                                                    <td colspan="7" align="right"><strong>Grand Total  </strong></td>
                                                
                                                    
                                                    <th align="right">{{number_format($BasicSalary)}}</th>
                                                    <th align="right">{{number_format($HRA)}}</th>
                                                    <th align="right">{{number_format($Transport)}}</th>
                                                    <th align="right">{{number_format($OtherAllowance)}}</th>
                                                    <th align="right">{{number_format($AdvanceLoan)}}</th>
                                                    
                                                    <th align="right">{{number_format($LeaveDeduction)}}</th>
                                                    <th align="right">{{number_format($TotalDeduction)}}</th>
                                                    
                                                    <th align="right">{{number_format($GrandSalary)}}</th>
                                                    <th align="right">{{number_format($NetSalary)}}</th>
                                                     
                                                   </tr>

                                        </tbody>
                                        </table>
                                      
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>

</body>
</html>