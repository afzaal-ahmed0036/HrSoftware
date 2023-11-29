 
<!--  {{$leavetypeid}} -->
	<?php 

$Total=0;
 $allow=1;

  ?>
<table class="table table-sm table-bordered align-middle table-nowrap mb-2">
<thead>
	<tr class="bg-light">
<th >S.No</th>
<th >Leave Type</th>
<th >Month </th>
<th >Total </th>
</tr>
</thead>

<tbody>

	@if(count($v_leave_summary)>0)		
<?php $Total=0;

$PaymentStatus=0;

 ?>

@foreach ($v_leave_summary as $key => $value)


<?php 

$Total = $Total + $value->Total;

 ?>
 <tr>
 <td class="col-md-1">{{$key+1}}</td>
 <td class="col-md-2">{{$value->LeaveTypeName}}</td>
 <td class="col-md-1">{{$value->MonthName}}</td>
 <td class="col-md-1">{{$value->Total}}</td>
 </tr>
 @endforeach  
 <tr>
 	<td></td>
 	
 	<td colspan="2" class="bg-light" ><strong>Total</strong></td>
 	<td class="bg-light" > {{$Total}}</td>
 </tr> 

 @else
  <tr>
  	<td colspan="4"> <p class=" text-danger  text-center">No data found</p></td>
  </tr>

<?php $Total=0; 
$PaymentStatus=0;
 
?>

 @endif   
 </tbody>
 </table>



<?php 






switch ($leavetypeid) {
 

	case 1:				//Annual Leave 
						// 30 allowed full year, 2.5 allow per month

						 $v_leave_summary1 = DB::table('v_leave_summary')->where('EmployeeID',$employeeid)->where('MonthName',$month=date('F-Y'))->where('LeaveTypeID',$leavetypeid)->get();


						 if( count( $v_leave_summary1) >0) {

						echo 'Your this month annual leaves are: '.$v_leave_summary1[0]->Total."<BR>";

						if(($v_leave_summary1[0]->Total<2) && ($Total<30))
						{
							echo '2 Annual leaves are allowed per month';

							$allow=0;
						}

						else
						{
							$allow=0;
						}


					 

						echo '<br>Total Annual Remaining are : '. 30-$Total ."<br>";

						$PaymentStatus='0';
						}
					 
						break;

	case 2:				//Short Leave
						
						if($Total <7)
						{
								$PaymentStatus='0';
								$allow=1;
						}
						else
						{
							$PaymentStatus='1';
							$allow=1;
						}



						break;

	case 3:				//Sick Leave
						if($Total <15)
						{
							$PaymentStatus='0';
							$allow=1;
						}elseif($Total>14 && $Total <=30)
						{
							$PaymentStatus='0.5';
							$allow=1;
						}else
						{
							$PaymentStatus='1';
							$allow=1;
						}
						break;

	case 4:				//Maternity leave
						if($Total <45)
						{
							$PaymentStatus='0';
							$allow=1;
						}elseif($Total>44 && $Total <=60)
						{
							$PaymentStatus='0.5';
							$allow=1;
						}else
						{
							$PaymentStatus='1';
							$allow=1;
						}
						break;

	case 5:				//Bereavement
						if($Total <5)
						{
								$PaymentStatus='0';
								$allow=1;
						}
						else
						{
							 $PaymentStatus='Not Allowed';
							$allow=0;
						}

						break;

	case 6:				// Study  leave
						if(($Total <10) && (Session::get('Months')>=24))
						{
							$PaymentStatus='0';
							$allow=1;
						}
						else
						{
							// $PaymentStatus='1';
							echo '2 year of job is the requirement';
							$allow=0;
						}
						break;

	case 7:				//Emergency - 7 allowed
						if($Total <7)
							{
									$PaymentStatus='1';
									$allow=1;
							}
							else
							{
								// $PaymentStatus='1';
								$allow=0;
							}
						break;

	case 8:				//Paternity Leave
						if($Total <5)
							{
									$PaymentStatus='0';
									$allow=1;
							}
							else
							{
								// $PaymentStatus='1-';
								$allow=0;
							}
						break;

	case 9:			//Emergency Leave
					$PaymentStatus='1';
					$allow=1;
					break;

	case 10:		//Unpaid leave
					$PaymentStatus='1';
					$allow=1;
					break;

	case 11:		//Casual Leave 
					if($Total<7)
					{
						$PaymentStatus='0';
						$allow=1;

					}
					else
					 
					{
						$PaymentStatus='Not Allowed';
						$allow=0;
						echo "Total 7 Casual Leaves Allowed<br>";
					}
					break;
					
	default:
		echo 'default';
		break;
}


 



?>

{{$PaymentStatus}}
<input type="hidden" name="PaymentStatus" value="{{$PaymentStatus}}">
<input type="hidden" name="Allow" value="{{$allow}}" id="allow">
 
<div class="mb-3"></div>

 
 

