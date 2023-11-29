@extends('template.tmp')
@section('title', 'Live Account Add')
@section('content')
 <div class="main-content" style="overflow:visible;">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Live Account ADD</h4>
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
                    <div>
                        <div class="alert alert-danger pt-3 pl-0 border-3 bg-danger text-white">
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
                                <form action="{{URL('/LiveAccountAdd')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Branch*</label>
                                                <select name="BranchID" id="BranchID" class="form-select">
                                                    <option value="">--Select Branch--</option>
                                                    @foreach($branch as $value)
                                                    <option value="{{$value->BranchID}}" {{(@$branch_id== $value->BranchID) ? 'selected=selected': '' }}>{{$value->BranchName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="mb-3">
                                            <label for="basicpill-firstname-input">Employee*</label>
                                            <select name="EmployeeID" id="EmployeeID" class="form-select select2">
                                             <option value="">Select</option>
                                              @foreach($employee as $value)
                                               <option value="{{$value->EmployeeID}}" {{(old('EmployeeID')== $value->EmployeeID) ? 'selected=selected': '' }}>{{$value->FirstName}}</option>
                                              @endforeach
                                            </select>
                                           </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">ID*</label>
                                                <input type="text" class="form-control" name="ID" id="ID" value="{{old('ID')}} ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Date*</label>
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" name="Date" value="{{$today_date}}" autocomplete="off" class="form-control" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Dialer</label>
                                                <input type="text" class="form-control" name="Dialer" value="{{old('Dialer')}} ">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">KYC</label>
                                                <textarea class="form-control" name="Remarks" value="{{old('Remarks')}} " style="height: 200px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div align="right">
                                        <button type="submit" class="btn btn-success w-lg float-right">Save</button>
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
             <!-- my own model -->
             <div class="modal fade" id="idModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="idModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                       <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Alert</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                     <div class="modal-body">
                     <p class="text-center">Record Already Exists againt entered ID</p>
                     <p class="text-center">
                        
                     <button type="button" class="btn btn-info" data-bs-dismiss="modal">Ok</button>
                                
                     </p>
                     </div>
                          
                     </div>
                </div>
             </div>
            <!-- end of my own model -->  
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

        $(document.body).on('blur','#ID',function(){
            var liveAccountID = $(this).val();
            $.ajax({
            url:'{{ url("/checkDuplicateIdsInLiveAccounts") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method:"GET",
            data:{liveAccountID:liveAccountID},
            dataType:"JSON",
            success:function(data)
            {
                if(data.length > 0)
                {
                    $('#idModal').modal('show', {backdrop: 'static'});
                    $('#ID').val('');
                    return;
                }
                
            }
        });
            
        });

     });
    </script>
@endsection