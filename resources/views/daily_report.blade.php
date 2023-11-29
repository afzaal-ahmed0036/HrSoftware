@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Staff Daily Report</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->

                                         <!-- enctype="multipart/form-data" -->
                                         <form action="{{URL('/DailyReport1')}}" method="post"> {{csrf_field()}} 

                                                  

                                            
                                                <input name="Date" id="input-date1" class="form-control form-control-sm input-mask" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="{{date('d/m/Y')}}" im-insert="false">
                                                <button type="submit" class="btn btn-success btn-sm mt-1 float-right">Generate Report</button>
                                                    </div>



                                         </form>

                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3"  id="success-alert">
                    
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

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            
                             @if(count($employee)>0)        
                            <table class="table table-sm align-middle table-nowrap mb-0">
                            <tbody><tr>
                            <th width="1%" >S.No</th>
                            <th  width="15%">Employee ID</th>
                            <th  width="84%">Report</th>
                            </tr>
                            </tbody>
                            <tbody>
                            @foreach ($employee as $key =>$value)

                            <?php 

                           if(request()->Date)
                           {



                            $daily_report = DB::table('daily_report')->where('EmployeeID',$value->EmployeeID)->where('Date',dateformatpc(request()->Date))->get();

                        }
                        else
                        {
                            
                            $daily_report = DB::table('daily_report')->where('EmployeeID',$value->EmployeeID)->get();                            
                        }

                             ?>

                             <tr>
                             <td valign="top" >{{$key+1}}</td>
                             <td valign="top">{{$value->FirstName}}</td>
                             <td >

                                @if(count($daily_report)>0) 

                                <strong>Title:</strong> {{$daily_report[0]->Title}}<br><strong>Detail :</strong> {{$daily_report[0]->Detail}}<br><strong>Detail :</strong> {{dateformatman($daily_report[0]->Date)}}<br><strong>Detail :</strong> {{$daily_report[0]->SupervisorComments}}<br><strong>Attachment If any :</strong> <a href="{{URL('/reports/').'/'.$daily_report[0]->File}}" target="_blank">File</a>

                                @else
                                <p class="text-muted">No report for this date</p>

                                @endif

                            </td>
                             </tr>
                             @endforeach   
                             </tbody>
                             </table>
                             @else
                               <p class=" text-danger">No data found</p>
                             @endif   

                            
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