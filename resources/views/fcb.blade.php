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
                                    <h4 class="mb-sm-0 font-size-18">Desposite</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->

                                    <strong>Active : </strong>     {{session::get('FCBMonthName')}}
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

            
                                <div class="card ">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>

                                        <form action="{{URL('/FCBSave')}}" method="post"  >

                                         {{csrf_field()}} 

                                         <div class="row">
                                           <div class="col-md-1">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">ID*</label>
                                         <input type="text" class="form-control" name="ID" value="{{old('ID')}} ">
                                         </div>
                                         </div>


                                                 
                                                     
                                                     


                                                     
                                                         <div class="col-md-4">
                                                      <div class="mb-3">
                                                         <label for="basicpill-firstname-input">Employee*</label>
                                                          <select name="EmployeeID" id="EmployeeID" class="form-select select2">
                                                         <option value="">Select</option>

                                                          @foreach($employee as $value)
                                                           <option value="{{$value->EmployeeID}}" {{(old('EmployeeID')== $value->EmployeeID) ? 'selected=selected': '' }}>{{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}</option>
                                                          @endforeach
                                                         
                                                     
                                                       </select>
                                                       </div>
                                                        </div>
                                                     
                                                     
                                                     
                                                                
                                         
                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">FTD Amount USD *</label>
                                                     <input type="text" class="form-control" name="FTDAmount" value="{{old('FTDAmount')}} ">
                                                     </div>
                                                     </div>
                                                     
                                                    
                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Date*</label>
                                                     <div class="input-group" id="datepicker2">
  <input type="text" name="Date"  value="{{date('d/m/Y')}}" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true"  >
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
                                                     </div>
                                                     </div>
                                                     



                                                      
                                                      

                                                         <div class="col-md-2">
                                                      <div class="mb-3">
                                                         <label for="basicpill-firstname-input">Compliant *</label>
                                                          <select name="Compliant" id="Compliant" class="form-select">
                                                         <option value="">Select</option>
                                                         <option value="Yes">Yes</option>
                                                         <option value="No">No</option>
                                                         <option value="WithD">WD</option>
                                                    
                                                       </select>
                                                       </div>
                                                        </div>
                                                     

                                                      
                                                     
                                                         <div class="col-md-2">
                                                      <div class="mb-3">
                                                         <label for="basicpill-firstname-input">KYC Sent*</label>
                                                          <select name="KYCSent" id="KYCSent" class="form-select">
                                                         <option value="">Select</option>
                                                         <option value="Yes">Yes</option>
                                                         <option value="No">No</option>
                                                    
                                                       </select>
                                                       </div>
                                                        </div>
                                                     
                                                     
                                                     

                                                      <div class="col-md-1">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Dialer</label>
                                                     <input type="text" class="form-control" name="Dialer" value="{{old('Dialer')}} ">
                                                     </div>
                                                     </div>
                                                     
                                                     
                                                    

                                                  
                                                      <div class="col-md-4">
                                                   <div class="mb-3">
                                                      <label for="basicpill-firstname-input">Branch*</label>
                                                       <select name="BranchID" id="BranchID" class="form-select">
                                                      
                                                       @foreach($branch as $value)
                                                        <option value="{{$value->BranchID}}" {{(old('BranchID')== $value->BranchID) ? 'selected=selected': '' }}>{{$value->BranchName}}</option>
                                                       @endforeach
                                                      
                                                     </select>
                                                    </div>
                                                     </div>
                                                  
                                                  
                                                  
                                                    <div class="col-md-4">
                                                  <div class="mb-3">
                                                  <label for="basicpill-firstname-input">Remarks</label>
                                                  <input type="text" class="form-control" name="Remarks" value="{{old('Remarks')}} ">
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
                                        <h4 class="card-title mb-4">FCB Desposite</h4>


 @if(count($fcb) >0) 
  <table id="datatable" class="table table-bordered table-sm dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 1247px;" data-page-length='50'>
                                            <thead>
                                            <tr role="row" >
                                             <th scope="col" >S.No</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Agent</th>
                                                    <th scope="col">FTD Amount</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Compliant</th>
                                                    <th scope="col">KYC Sent</th>
                                                    <th scope="col">Dialer</th>
                                                    
                                                    <th scope="col">Action</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody>
                                         <?php $i=1; ?>
                                               @foreach($fcb as $value)    
                                            
                                            <tr  >
                                               <td >{{$i}}.</td>
                                                <td  >{{$value->ID}}</td>
                                                <td  >{{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}</td>
                                                        <td >{{number_format($value->FTDAmount,2)}}</td>
                                                        <td >{{$value->Date}}</td>
                                                        <td >{{$value->Compliant}}</td>
                                                        <td >{{$value->KYCSent}}</td>
                                                        <td >{{$value->Dialer}}</td>
                                                <td><center><a href="{{URL('/FCBEdit/'.$value->FCBID)}}"><i class="bx bx-pencil align-middle me-1"></i></a> <a href="#" onclick="delete_confirm2('FCBDelete',{{$value->FCBID}})"><i class="bx bx-trash  align-middle me-1"></i></a></center></td>
                                             </tr>
                                                <?php $i++; ?>
                                                    @endforeach </tbody>
                                        </table>

 @endif

                                          @if(count($fcb) ==0) 
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