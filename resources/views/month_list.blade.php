@extends('template.tmp')
@section('title', 'Month Setting')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Month Target Listing</h4>
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
                             <div class="row">
                               <div class="col-md-4">
                                   <div class="mb-3">
                                        <label for="basicpill-firstname-input">Branch*</label>
                                        <select name="BranchID" id="BranchID" class="form-select">
                                            <option value="">--Select Branch--</option>
                                            @foreach($branch as $value)
                                            <option value="{{$value->BranchID}}">{{$value->BranchName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                               <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">Month*</label>
                                        <div class="input-group">
                                            <input type="month" id="month" name="month" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                             	<div align="right">
                                    <button type="button" class="btn btn-success w-lg float-right filter">Search</button>                             	     
                             	</div>
                             </div>                          
                        </div>
                        <!-- end card body -->
                    </div> 

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Target Listing</h4>

                            <div class="table-responsive">
                                <table class="table datatable table-hover dt-responsive nowrap w-100 table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Branch Name</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">Target Type</th>
                                        <th scope="col">Target Value</th>
                                        <th scope="col">Disable Dates</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>


                                    <tbody class="month_data">
                                        
                                    </tbody>
                                </table>
                                
                                  
                            </div>
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
        "ajax": "{{ url('TargetList') }}",
        "columns":[
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable: false},
                { "data": "branch_name" },
                { "data": "MonthName" },
                { "data": "CurrentTarget" },
                { "data": "target_value" },
                { "data": "disable_dates" },
                { "data": "action" }
            ]
         
     });

        $(document.body).on('click','.filter',function(){
            var branch_id = $('#BranchID').val();
            var month = $('#month').val();
            $('.datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength":50,
                "destroy": true,
                ajax: {
                url: '{{ url("filterWiseTargetListing") }}',
                data: function (d) {
                    d.branch_id = branch_id;
                    d.month = month;
                    }
                },
                "columns":[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable: false},
                        { "data": "branch_name" },
                        { "data": "MonthName" },
                        { "data": "CurrentTarget" },
                        { "data": "target_value" },
                        { "data": "disable_dates" },
                        { "data": "action" }
                    ]
                 
             });
            
        
        });
        });
</script>    
@endsection