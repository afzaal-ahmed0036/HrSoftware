@extends('template.tmp')

@section('title', 'Edit Live Account')
 
@section('content')

 <div class="main-content" style="overflow:visible;">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"> Live Account Update</h4>

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

                <form action="{{URL('/liveAccountUpdate')}}" method="post"  >

                 {{csrf_field()}} 
                 <input type="hidden" name="LiveAccountID" value="{{$live_account->LiveAccountID}}">
                 <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                         <label for="basicpill-firstname-input">Branch*</label>
                          <select name="BranchID" id="BranchID" class="form-select">
                         
                          @foreach($branch as $value)
                           <option value="{{$value->BranchID}}" {{($live_account->BranchID == $value->BranchID) ? 'selected=selected': '' }}>{{$value->BranchName}}</option>
                          @endforeach
                         
                    
                       </select>
                       </div>
                    </div>
                     
                     <div class="col-md-4">
                      <div class="mb-3">
                         <label for="basicpill-firstname-input">Employee*</label>
                          <select name="EmployeeID" id="EmployeeID" class="form-select select2">
                             <option value="">Select</option>
                              @foreach($employees as $value)
                               <option value="{{$value->EmployeeID}}" {{($live_account->EmployeeID== $value->EmployeeID) ? 'selected=selected': '' }}>{{$value->FirstName}}&nbsp;{{$value->MiddleName}}&nbsp;{{$value->LastName}}</option>
                              @endforeach
                           </select>
                       </div>
                    </div>
                    <div class="col-md-4">
                         <div class="mb-3">
                             <label for="basicpill-firstname-input">ID*</label>
                             <input type="text" class="form-control" name="ID" value="{{$live_account->ID}} ">
                         </div>
                     </div>
                    
                 </div>
                 <div class="row">
                     <div class="col-md-4">
                         <div class="mb-3">
                             <label for="basicpill-firstname-input">Date*</label>
                              <div class="input-group" id="datepicker2">
                                  <input type="text" name="Date"  value="{{$live_account->Date}}" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true">
                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                              </div>

                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="mb-3">
                         <label for="basicpill-firstname-input">Dialer</label>
                         <input type="text" class="form-control" name="Dialer" value="{{$live_account->Dialer}}">
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="mb-3">
                         <label for="basicpill-firstname-input">KYC</label>
                         <textarea class="form-control" name="Remarks" value="{{old('Remarks')}} " style="height: 200px;">{{$live_account->Remarks}}</textarea>
                         </div>
                     </div>
                 </div>

                 <div align="right">
                    <button type="submit" class="btn btn-success w-lg float-right">Update</button>
                    <a href="{{URL('/LiveAccountListing')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
                    
                 	     
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
 <script type="text/javascript">
     $(document).ready(function(){

        $(document.body).on('change','#BranchID',function(){
            var branch_id = $(this).val();
            $.ajax({
            url:'{{ url("/getBranchWiseEmployees") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"GET",
            data:{branch_id:branch_id},
            dataType:"JSON",
            success:function(data)
            {
                $('#EmployeeID').empty();
                if(data)
                {
                    $('#EmployeeID').append('<option value="">--Select Agent--</option>');
                    var full_name;
                    $.each(data, function(key, value)
                    {
                      if(value.FirstName && !value.MiddleName && value.LastName){
                        full_name = value.FirstName+'&nbsp;'+value.LastName;
                      }
                      else if(value.FirstName && value.MiddleName && !value.LastName){
                        full_name = value.FirstName+'&nbsp;'+value.MiddleName;
                      }
                      else if(value.FirstName && !value.MiddleName && !value.LastName){
                        full_name = value.FirstName;
                      }
                      else{
                        full_name = value.FirstName+'&nbsp;'+value.MiddleName+'&nbsp;'+value.LastName;
                      }
                      $('#EmployeeID').append('<option value="'+ value.EmployeeID +'">'+ full_name +'</option>');
                    })
                }
                
            }
        });
            
        });
     });
    </script>

  @endsection