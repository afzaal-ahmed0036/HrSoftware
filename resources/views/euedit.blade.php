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

                                        <form action="{{URL('/EUUpdate')}}" method="post"  >

                                         {{csrf_field()}} 
<input type="hidden" name="EuID" value="{{$eu[0]->EuID}}">
                                         <div class="row">
                                          


      @php

$MonthName = old('MonthName') ? old('MonthName') : $eu[0]->MonthName ;
$BranchID = old('BranchID') ? old('BranchID') : $eu[0]->BranchID ;
$No = old('No') ? old('No') : $eu[0]->No ;
$Sum = old('Sum') ? old('Sum') : $eu[0]->Sum ;
$NetDeposit = old('NetDeposit') ? old('NetDeposit') : $eu[0]->NetDeposit ;
$FTD = old('FTD') ? old('FTD') : $eu[0]->FTD ;

      @endphp                                           
                                                     
                                     
                                                         <div class="col-md-2">
                                                   <div class="mb-3">
                                                      <label for="basicpill-firstname-input">Month*</label>
                                                       <select name="MonthName" id="MonthName" class="form-select">
                                                       @foreach ($monthname as $key => $value)
                                                          <option value="{{$value->MonthName}}" {{($value->MonthName== $MonthName) ? 'selected=selected':'' }}>{{$value->MonthName}}</option>
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
                                         <input type="text" class="form-control" name="No" value="{{$No}} " id="No">
                                         </div>
                                         </div>     

                                         
                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Sum*</label>
                                                     <input type="text" class="form-control" name="Sum" value="{{$Sum}} " id="Sum1">
                                                     </div>
                                                     </div>  

                                                      <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">NetDeposit*</label>
                                                     <input type="text" class="form-control" name="NetDeposit" value="{{$NetDeposit}} " id="NetDeposit">
                                                     </div>
                                                     </div>
                                                      <div class="clearfix"></div>
                                                         <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">FTD*</label>
                                                     <input type="text" class="form-control" name="FTD" value="{{$FTD}} " id="FTD">
                                                     </div>
                                                     </div>
                                                          
                                   
                                        

                                         	<div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
                                         	     
                                         	</div>
                                         	
                                         
                                         </div>
                                         
                                     
                                         
                              
                                         
                                         

                                     </form>

                                        
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