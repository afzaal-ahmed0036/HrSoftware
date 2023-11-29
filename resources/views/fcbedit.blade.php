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
                                    <h4 class="mb-sm-0 font-size-18"> Desposite Update</h4>

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

                                        <form action="{{URL('/FCBUpdate')}}" method="post"  >

                                         {{csrf_field()}} 
                                         <input type="hidden" name="FCBID" value="{{$fcb[0]->FCBID}}">
                                         <div class="row">
                                           <div class="col-md-1">
                                         <div class="mb-3">
                                         <label for="basicpill-firstname-input">ID*</label>
                                         <input type="text" class="form-control" name="ID" value="{{$fcb[0]->ID}} ">
                                         </div>
                                         </div>


                                                      <div class="col-md-4">
                                                      <div class="mb-3">
                                                         <label for="basicpill-firstname-input">Employee*</label>
                                                          <select name="EmployeeID" id="EmployeeID" class="form-select select2">
                                                         <option value="">Select</option>

                                                          @foreach($employee as $value)
                                                           <option value="{{$value->EmployeeID}}" {{($fcb[0]->EmployeeID== $value->EmployeeID) ? 'selected=selected': '' }}>{{$value->FirstName}}</option>
                                                          @endforeach
                                                         
                                                     
                                                       </select>
                                                       </div>
                                                        </div>
                                                     
                                                     
                                                                
                                         
                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">FTD Amount*</label>
                                                     <input type="text" class="form-control" name="FTDAmount" value="{{$fcb[0]->FTDAmount}}">
                                                     </div>
                                                     </div>
                                                     

                                                    
                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Date*</label>
                                                       

                                                      <div class="input-group" id="datepicker2">
  <input type="text" name="Date"  value="{{$fcb[0]->Date}}" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
                         


                                                     </div>
                                                     </div>
                                                     

                                                       <div class="col-md-3">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Compliant*</label>
                                                    

                                                      <select name="Compliant" id="Compliant" class="form-select">
                                                         <option value="">Select</option>
                                                         <option value="YES" {{($fcb[0]->Compliant=='YES') ? 'selected=selected':'' }} >Yes</option>
                                                         <option value="NO" {{($fcb[0]->Compliant=='NO') ? 'selected=selected':'' }}>NO</option>
                                                         <option value="WD" {{($fcb[0]->Compliant=='WD') ? 'selected=selected':'' }}>WD</option>
                                                    
                                                       </select>


                                                     </div>
                                                     </div>
                                                      

                                                       <div class="col-md-2">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">KYC Sent*</label>
                                                   


                                                      <select name="KYCSent" id="KYCSent" class="form-select">
                                                         <option value="">Select</option>
                                                         <option value="YES" {{($fcb[0]->KYCSent=='YES') ? 'selected=selected':'' }} >Yes</option>
                                                         <option value="NO" {{($fcb[0]->KYCSent=='NO') ? 'selected=selected':'' }}>NO</option>
                                                         
                                                    
                                                       </select>



                                                     </div>
                                                     </div>

                                                      <div class="col-md-1">
                                                     <div class="mb-3">
                                                     <label for="basicpill-firstname-input">Dialer</label>
                                                     <input type="text" class="form-control" name="Dialer" value="{{$fcb[0]->Dialer}}">
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
                                                     <input type="text" class="form-control" name="Remarks" value="{{$fcb[0]->Remarks}} ">
                                                     </div>
                                                     </div>
                                                     
                                                     
                                                     
                                                     
                                                      
                                                            

                                        

                                         	<div><button type="submit" class="btn btn-success w-lg float-right">Save</button>


                                           <a href="{{URL('/FCB')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
                                                 
                                            </div>
                                            
                                         	     
                                         	</div>
                                         	
                                         
                                         </div>
                                         
                                     
                                         
                                         
                                         
                                         
                                         
                                         

                                     </form>

                                        
                                    </div>
                                    <!-- end card body -->
                                </div> 
 
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection