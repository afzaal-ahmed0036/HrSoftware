<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pay Slip</title>
 

<style>
	
	 @page {
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                margin-left: 0.5cm;
                margin-right: 0.5cm;
            }

 @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: normal;
             }
            @font-face {
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: bold;
             }
            @font-face {
                font-family: 'Open Sans';
                font-style: italic;
                font-weight: normal;
             }
            @font-face {
                font-family: 'Open Sans';
                font-style: italic;
                font-weight: bold;
             }

             body
             {
             	 font-family: 'Courier New', monospace;
    font-size: 11pt;

             }
 table {
                border-collapse: collapse;
                border-spacing: 0;
                page-break-inside: always;
                border: 0;
                margin: 0;
                padding: 0;

            }
           



.no-border tr {
                page-break-inside: always;
                page-break-after: auto;
            }
            .no-border td,
            .no-border th {
                border-bottom: 1px #ccc solid;
                border-left: 1px #ccc solid;
                border-right: 0px #ccc solid;
                border-top: 0px #ccc solid;
                
            }

</style>


</head>

<body>
<div align="center">
  <p><img name="" src="{{asset('uploads/'.$branch[0]->BranchLogo)}}"  height="51" alt="" /></p>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="50%" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col"><div align="left">Employee Name: </div></th>
        <th scope="col"><div align="left">{{$salary->EmployeeName}}</div></th>
      </tr>
      <tr>
        <td><div align="left">Designation : </div></td>
        <td><div align="left">{{$salary->JobTitle}}</div></td>
      </tr>
      <tr>
        <td><div align="left">Month:</div></td>
        <td>{{$salary->MonthName}} </td>
      </tr>
    </table></th>
    <th width="50%" valign="top" scope="col" align="right"> <div align="right">Dated: {{$salary->eDate}} </div></th>
  </tr>
</table>
<br />
<table width="100%" border="1" cellpadding="0"  cellspacing="0"  >
  <tr>
    <th height="35" valign="middle" scope="col"><div align="center">Earnings</div></th>
    <th height="35" align="right" valign="middle" scope="col"><div align="center">Deduction</div></th>
  </tr>
  <tr>
    <th width="50%" valign="top" scope="col">

    	<table width="100%" border="1" cellspacing="0" cellpadding="0" class="no-border">
      <tr>
        <th width="50%" scope="col"><div align="left">Basic Salary </div></th>
        <th width="50%" scope="col"><div align="left">{{$salary->BasicSalary}}</div></th>
      </tr>
      <tr>
        <td width="50%"><div align="left">HRA</div></td>
        <td width="50%"><div align="left">{{$salary->HRA}}</div></td>
      </tr>
      <tr>
        <td width="50%"><div align="left">Transpotation</div></td>
        <td width="50%">{{$salary->Transport}} </td>
      </tr>
      <tr>
        <td width="50%">Other Allowance </td>
        <td width="50%">{{$salary->OtherAllowance}}</td>
      </tr>
      <tr>
        <td width="50%">&nbsp;</td>
        <td width="50%">&nbsp;</td>
      </tr>
      <tr>
        <td width="50%">Total Addition </td>
        <td width="50%">{{$salary->BasicSalary+$salary->HRA+$salary->Transport+$salary->OtherAllowance}}</td>
      </tr>
    </table></th>
    <th width="50%" valign="top" scope="col" align="right">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="no-border">
      <tr>
        <th width="50%" scope="col"><div align="left">Leave Deduction </div></th>
        <th width="50%" scope="col"><div align="left">{{$salary->LeaveDeduction}}</div></th>
      </tr>
      <tr>
        <td width="50%"><div align="left">Advance Loan</div></td>
        <td width="50%"><div align="left"> {{$salary->AdvanceLoan}}</div></td>
      </tr>
      <tr>
        <td width="50%">.</td>
        <td width="50%"> </td>
      </tr>
      <tr>
        <td width="50%"> </td>
        <td width="50%"></td>
      </tr>
      <tr>
        <td width="50%">.</td>
        <td width="50%">&nbsp;</td>
      </tr>
      <tr>
        <td width="50%">Total Deduction </td>
        <td width="50%">{{$salary->LeaveDeduction+$salary->AdvanceLoan}}</td>
      </tr>
      <tr>
        <td width="50%">Net Salary </td>
        <td width="50%">{{$salary->NetSalary}}</td>
      </tr>
    </table></th>
  </tr>
</table>
<p>In words : {{convert_number_to_words($salary->NetSalary)}}. </p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr><tr>
    <th width="50%" scope="col">&nbsp;</th>
    <th width="50%" align="right" valign="top" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="50%" scope="col"><div align="center">Signature of the Employee </div></th>
    <th width="50%" align="right" valign="top" scope="col"><div align="center">Director</div></th>
  </tr>
</table>
 
</body>
</html>
