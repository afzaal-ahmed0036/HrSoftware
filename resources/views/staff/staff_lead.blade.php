@extends('template.staff_tmp')
@section('title', $pagetitle)
 

@section('content')
<style>
    .main-content {

    overflow: visible;
}
</style>
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Lead</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->

                                         

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
                            
                           <!-- enctype="multipart/form-data" -->
                              <form action="{{URL('/StaffLeadSave')}}" method="post"> 


                              {{csrf_field()}} 



                            <div class="row">
                              
                                  <div class="col-md-4">
                              <div class="mb-3">
                              <label for="basicpill-firstname-input">Name</label>
                              <input type="text" class="form-control" name="Name" value="{{old('Name')}} ">
                              </div>
                              </div>

                           
                              

                                <div class="col-md-4">
                              <div class="mb-3">
                              <label for="basicpill-firstname-input">Phone</label>
                              <input type="text" class="form-control" name="Phone" value="{{old('Phone')}} ">
                              </div>
                              </div>
                              

                                <div class="col-md-4">
                              <div class="mb-3">
                              <label for="basicpill-firstname-input">Email</label>
                              <input type="text" class="form-control" name="Email" value="{{old('Email')}} ">
                              </div>
                              </div>
                              

                                <div class="col-md-4">
                              <div class="mb-3">
                              <label for="basicpill-firstname-input">Company Name</label>
                              <input type="text" class="form-control" name="CompanyName" value="{{old('Email')}} ">
                              </div>
                              </div>


                               <div class="col-md-4">
                              <div class="mb-3">
                              <label for="basicpill-firstname-input">Business Type</label>
                              <input type="text" class="form-control" name="BusinessType" value="{{old('Email')}} ">
                              </div>
                              </div>


                                <div class="col-md-4">
                              <div class="mb-3">
                              <label for="basicpill-firstname-input">Lead Stage</label>
                             <select name="LeadStage" class="form-select" >
                                <option value="0">select</option>
                                <option value="New">New</option>
                                <option value="Converted">converted</option>
                                <option value="Lost">Lost</option>
                             </select>
                              </div>
                              </div>
                              
                              
                                  
                                <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input"> Date *</label>
                                     

                                        <div class="input-group" id="datepicker2">
  <input type="text" name="Date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" value="{{date('d/m/Y')}}">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
                 



                                                      
                                                            
                                                                                                       


 



                                                            </div>

                                      </div>


                              <div><button type="submit" class="btn btn-success w-lg float-right">Save </button>
                                   
                              </div>
                              

                            </form>   

                            
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->






                </div>


                <!-- end col -->

                
                  <div class="card">
                    <div class="card-header bg-transparent border-bottom">
                          Mangae Leads
                      </div>
                      <div class="card-body">
                        
                         @if(count($lead)>0)    
                        <table class="table table-sm align-middle table-nowrap mb-0">
                        <tbody><tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Company</th>
                        <th scope="col">Business Type</th>
                        <th scope="col">Stage</th>
                        <th scope="col">Date</th>
                        <th scope="col">Delete</th>
                        </tr>
                        </tbody>
                        <tbody>
                        @foreach ($lead as $key =>$value)
                         <tr>
                         <td class="col-md-1">{{$key+1}}</td>
                         <td class="col-md-1">{{$value->Name}}</td>
                         <td class="col-md-1">{{$value->Phone}}</td>
                         <td class="col-md-1">{{$value->Email}}</td>
                         <td class="col-md-1">{{$value->CompanyName}}</td>
                         <td class="col-md-1">{{$value->BusinessType}}</td>
                         <td class="col-md-1">{{$value->LeadStage}}</td>
                         <td class="col-md-1">{{dateformatman($value->Date)}}</td>
                         <td class="col-md-1"><a href="{{URL('/StaffLeadDelete').'/'.$value->LeadID}}">Delete</a></td>
                         </tr>
                         @endforeach   
                         </tbody>
                         </table>
                         @else
                           <p class=" text-danger">No data found</p>
                         @endif   


                      </div>
                  </div>

           
            </div>
            <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection