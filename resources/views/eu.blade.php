@extends('template.tmp')

@section('title', 'HR')
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">EU Detail</h4>

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
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>

                                        <form action="{{URL('/EUSave')}}" method="post"  >

                                         {{csrf_field()}} 

                                         <div class="row">
                                          


                                                 
                                                     
                                     
                                                         <div class="col-md-2">
                                                   <div class="mb-3">
                                                      <label for="basicpill-firstname-input">Month*</label>
                                                       <select name="MonthName" id="MonthName" class="form-select">
                                                       @foreach ($monthname as $key => $value)
                                                          <option value="{{$value->MonthName}}">{{$value->MonthName}}</option>
                                                      @endforeach
                                                     </select>
                                                    </div>
                                                     </div>

                                                           <div class="col-md-4">
                                                   <div class="mb-3">
                                                      <label for="basicpill-firstname-input">Branch*</label>
                                                       <select name="BranchID" id="BranchID" class="form-select">
                                                       @foreach ($branch as $key => $value)
                                                          <option value="{{$value->BranchID}}">{{$value->BranchName}}</option>
                                                      @endforeach
                                                     </select>
                                                    </div>
                                                     </div>
                                                   
                                                   <div class="clearfix"></div>
                                                     
                                                       <div class="col-md-2">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">No*</label>
                                         <input type="text" class="form-control" name="No" value="{{old('No')}} " id="No">
                                         </div>
                                         </div>     

                                         
                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Sum*</label>
                                                     <input type="text" class="form-control" name="Sum" value="{{old('Sum')}} " id="Sum1">
                                                     </div>
                                                     </div>  

                                                      <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">NetDeposit*</label>
                                                     <input type="text" class="form-control" name="NetDeposit" value="{{old('NetDeposit')}} " id="NetDeposit">
                                                     </div>
                                                     </div>
                                                      <div class="clearfix"></div>
                                                         <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">FTD*</label>
                                                     <input type="text" class="form-control" name="FTD" value="{{old('FTD')}} " id="FTD">
                                                     </div>
                                                     </div>
                                                          
                                   
                                        

                                         	<div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
                                         	     
                                         	</div>
                                         	
                                         
                                         </div>
                                         
                                     
                                         
                              
                                         
                                         

                                     </form>

                                        
                                    </div>
                                    <!-- end card body -->
                                </div> 

                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">EU Overall Detail Monthwise</h4>


                                               @if(count($eu) >0) 
                                        <div class="table-responsive">
                                            <table class="table table-sm align-middle table-nowrap mb-0">
                                                <thead><tr class="bg-light">
                                                    <th scope="col" >S.No</th>
                                                    <th scope="col">Month</th>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Sum</th>
                                                    <th scope="col">Net Deposit</th>
                                                    <th scope="col">FTD</th>
                                                    <th scope="col">Per</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">AED</th>
                                                    
                                                    <th scope="col">Entry Date</th>
                                                    <th scope="col">Manage</th>
                                                  </tr>
                                                </thead> 
                                               <?php $i=1; ?>
                                               @foreach($eu as $value)

                                               <?php 

$result = eu($value->No,$value->Sum,$value->NetDeposit,$value->FTD,$value->Per,$value->Total );

 

                                                ?>
                                                    <tr>
                                                        <td class="col-md-1">{{$i}}.</td>
                                                         
                                                        <td class="col-md-2">{{$value->MonthName}}</td>
                                                        <td class="col-md-1">{{$value->No}} </td>
                                                        <td class="col-md-1">{{number_format($value->Sum,2)}}</td>
                                                        <td class="col-md-1">{{number_format($value->NetDeposit,2)}}</td>
                                                        <td class="col-md-1">{{number_format($value->FTD,2)}}</td>
                                                        <td class="col-md-1">{{number_format($value->Per,2)}}</td>
                                                        <td class="col-md-1">{{number_format($eu[0]->Total,2)}}</td>
                                                        <td class="col-md-1"> {{number_format($result['AED'],2)}}</td>
                                                        <td class="col-md-1">{{$value->eDate}}</td>
                                                            
                                                             
                                                         
                                                        <td class="col-md-1">
                                                            <a href="{{URL('/EUView/'.$value->EuID)}}"><i class="mdi mdi-eye-outline align-middle me-1"></i></a>

                                                              <a href="{{URL('/EUEdit/'.$value->EuID)}}"><i class="bx bx-pencil align-middle me-1"></i></a>

                                                             <a href="#" onclick="delete_confirm2('EUDelete',{{$value->EuID}})"><i class="bx bx-trash  align-middle me-1"></i></a>

                                                             

                                                         </td>
                                                        <td>
                                                            
                                                        </td>
                                                    </tr>
                                                   <?php $i++; ?>
                                                    @endforeach

                                                     

                                                   
                                                
                                            </table>
                                            
                                              
                                        </div>
                                        @endif

                                          @if(count($eu) ==0) 
                                        <p class="text-danger h6">No record to display</p>

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