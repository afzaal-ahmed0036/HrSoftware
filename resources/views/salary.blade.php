@extends('template.tmp')

@section('title', 'Branches')
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Branches</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3">
                    
                  <strong>{{ Session::get('error') }} </strong>
                </div>

@endif

  @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3 bg-danger text-white">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
                </div>

            @endif
                              
                                </div> 

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">List of Branches</h4>



                                     
                                       <table class="table table-bordered table-sm">
  <tr>
    <td>SNO</td>
    <td>EMP-ID</td>
    <td>NAME</td>
    <td>DESIGNATION</td>
    <td>SALARY</td>
    <td>EXTRA COMISSION</td>
    <td>SALARY REMARKS</td>
    <td>Staff Type</td>
    <td>NO OF CLIENTS</td>
    <td>FCB DEPOSITE</td>
    <td>Formula Type</td>
  </tr>
  <?php $no=1; ?>
  @foreach($employee as $value)
  <?php 



 $v_salary = DB::table('v_union_salary')->where('EmployeeID',$value->EmployeeID)->get();
 
 if(count($v_salary)>0){
    $data= agent($v_salary[0]->Total,$v_salary[0]->FTDAmount);
        
       $result= $data['comission1']+$data['comission2']+$data['comission3'];
}
 

 
  ?>

  <tr>
    <td>{{$no}}</td>
    <td>{{$value->EmployeeID}}</td>
    <td>{{$value->FirstName}}</td>
    <td>{{$value->JobTitleName}}</td>
    <td>{{$value->Salary}}</td>
    <td> {{$value->ExtraComission}} </td>
    <td> {{$value->SalaryRemarks}} </td>
    <td> {{$value->StaffType}} </td>
   
    <td> <input type="text" name="Sal" value="{{$result}}" class="form-control form-control-sm w-75  "></td>
    <td> <input type="text" name="Sal" value="{{$result}}" class="form-control form-control-sm w-75  "></td>
    <td> <?php 

if($value->StaffType=='Agent')
{
  echo 'agent(0,00)';
}
elseif ($value->StaffType=='Closer') {
 echo 'closeri(0,00)'; 
}
elseif ($value->StaffType=='Floor Manager') {
 echo 'noel(0,00)'; 
}
else
{
  echo 'nil';
}

     ?></td>
  </tr>
  <?php $no++; ?>
   @endforeach
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


  @endsection