@extends('template.tmp')
@section('title', 'FCB Listing')
@section('content')
 <div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">FCB Listing</h4>

                        <div class="page-title-right">
                             <!-- button will appear here -->
                            <!-- <strong>Active : {{@$active_monthYear}}</strong>     -->
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
            <form>
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
                            <label for="basicpill-firstname-input">Agent*</label>
                            <select name="agent_id" id="agent_id" class="form-select select2">
                                <option value="">--Select Agent--</option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->EmployeeID }}">{{@$employee->FirstName}}&nbsp;{{@$employee->MiddleName}}&nbsp;{{@$employee->LastName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="basicpill-firstname-input">Month*</label>
                            <div class="input-group">
                                <input type="text" id="monthpicker" name="month" class="form-control" value="{{@$active_monthYear}}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success w-lg float-right filter" style="float:right;">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end card body -->
    </div> 

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">FCB Desposit</h4>


                    <table class="table datatable table-hover dt-responsive nowrap w-100 table-sm">
                        <thead>
                        <tr>
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


                        <tbody class="fcb_data">
                            
                        </tbody>
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
 <script type="text/javascript">
     $(document).ready(function(){

        $('.datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength":50,
            "ajax": "{{ url('FCBListing') }}",
            "columns":[
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable: false},
                { "data": "ID" },
                { "data": "agent" },
                { "data": "FTDAmount" },
                { "data": "Date" },
                { "data": "Compliant" },
                { "data": "KYCSent" },
                { "data": "Dialer" },
                { "data": "action" }
                ]
             
         });

        $(document.body).on('click','.filter',function(){
            var branch_id = $('#BranchID').val();
            var month = $('#monthpicker').val();
            var agent_id = $('#agent_id').val();
            $('.datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength":50,
                "destroy": true,
                ajax: {
                url: '{{ url("filterWiseFCBListing") }}',
                data: function (d) {
                    d.branch_id = branch_id;
                    d.month = month;
                    d.agent_id = agent_id;
                    }
                },
                "columns":[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable: false},
                    { "data": "ID" },
                    { "data": "agent" },
                    { "data": "FTDAmount" },
                    { "data": "Date" },
                    { "data": "Compliant" },
                    { "data": "KYCSent" },
                    { "data": "Dialer" },
                    { "data": "action" }
                    ]
                 
             });
            
        
        });

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
                $('#agent_id').empty();
                if(data)
                {
                    $('#agent_id').append('<option value="">--Select Agent--</option>');
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
                      $('#agent_id').append('<option value="'+ value.EmployeeID +'">'+ full_name +'</option>');
                    })
                }
                
            }
        });
            
        });


     });
 </script>   
@endsection