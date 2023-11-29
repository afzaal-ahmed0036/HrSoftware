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
                                    <h4 class="mb-sm-0 font-size-18">Deals</h4>

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
          <div class="card">
                    <div class="card-header bg-transparent border-bottom">
                          Mangae Deals
                      </div>
                      <div class="card-body">
                        
                        
                         @if($target->isNotEmpty()) 
                        <table class="table table-sm align-middle table-nowrap mb-0">
                        <tbody><tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Target Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Target Period</th>
                        <th scope="col">Detail</th>
                        
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        
                        <th scope="col">Date</th>
                        <th scope="col">Delete</th>
                        </tr>
                        </tbody>
                        <tbody>
                        @foreach ($target as $key =>$value)
                         <tr>
                         <td class="col-md-1">{{$key+1}}</td>
                         <td class="col-md-1">{{$value->TargetType}}</td>
                         <td class="col-md-1">{{$value->TargetName}}</td>
                         <td class="col-md-1">{{$value->TargetPeriod}}</td>
                         <td class="col-md-1">{{$value->Detail}}</td>
                        
                         <td class="col-md-1">{{dateformatman($value->StartDate)}}</td>
                         <td class="col-md-1">{{dateformatman($value->EndDate)}}</td>
                         <td class="col-md-1">{{dateformatman($value->Date)}}</td>
                         
                         <td class="col-md-1"><a href="{{URL('/StaffTargetReply').'/'.$value->TargetID}}">Reply</a></td>
                         </tr>
                         @endforeach   
                         </tbody>
                         </table>
                         @else
                           <p class=" text-danger">No data found</p>
                         @endif   


                      </div>
                  </div>     
                
         <div class="card">
         <div class="card-header bg-transparent border-bottom">
         <!-- enctype="multipart/form-data" -->
         <form action="{{URL('/StaffTargetReplySave')}}" method="post">
          {{csrf_field()}}



  <div class="col-md-4">
<div class="mb-3">
<label for="basicpill-firstname-input">Name*</label>
<input type="text" class="form-control form-con-sm" name="TargetID" value="{{request()->id}} ">
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

<div class="col-md-4">
<div class="mb-3">
<label for="verticalnav-address-input">Detail</label>
<textarea id="verticalnav-address-input" class="form-control" rows="" name="Detail"></textarea>
</div>
</div>

 

<div><button type="submit" class="btn btn-success w-lg float-right">Save </button>
     
</div>



           </form>
         </div>
         <div class="card-body">      

         </div>
         </div>
                  

   
            </div>
            

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection