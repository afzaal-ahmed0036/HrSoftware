@extends('template.staff_tmp')

@section('title', 'Emplyee Section')


@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        function view_data(id) {
            window.open("{{ URL('/EmployeeDetail') }}/" + id, "_self");
            //alert(id);
        }

        function edit_data(id) {
            window.open("{{ URL('/edit_customer') }}/" + id, "_self");
            //alert(id);
        }

        function del_data(id) {

            var txt;
            var r = confirm("Do you want to delete");
            if (r == true) {
                window.open("{{ URL('/LeaveDelete') }}/ " + id, "_self");
            } else {
                txt = "You pressed Cancel!";
            }



            //alert(id);
        }
    </script>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Employee Detail</h4>

                            <div class="page-title-right">
                                <div class="page-title-right">
                                    <!-- button will appear here -->

                                    <a href="{{ URL('/StaffDashboard') }}"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                            class="mdi mdi-arrow-left  me-1 pt-5"></i> Go Back</a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">
                        @if (session('error'))
                            <div class="alert alert-{{ Session::get('class') }} p-3 " id="success-alert">

                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if (count($errors) > 0)

                            <div>
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

                        @include('staff.staff_info')

                        <div class="card">
                            <div class="card-header bg-transparent border-bottom h5  ">
                                Apply for Leave
                                <span style="float: right;"
                                    class="text-success btn btn-light btn-outline-success rounded-pill ">{{ Session::get('Months') }}
                                    Months since you have joined us.</span>
                            </div>
                            <div class="card-body">

                                <form action="{{ URL('/StaffLeaveSave') }}" method="post">
                                    @csrf





                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Leave Type</label>
                                            <select name="LeaveTypeID" id="LeaveTypeID" class="form-select" required="">
                                                <option value="">Select</option>
                                                @foreach ($leave_type as $value)
                                                    <option value="{{ $value->LeaveTypeID }}"
                                                        {{ old('LeaveTypeID') == $value->LeaveTypeID ? 'selected=selected' : '' }}>
                                                        {{ $value->LeaveTypeName }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>



                                    <div id="result" class="col-md-4">...</div>

                                    <div class="col-md-4 d-none">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Branch </label>
                                            <select name="BranchID" id="BranchID" class="form-select">

                                                @foreach ($branch as $value)
                                                    <option value="{{ $value->BranchID }}"
                                                        {{ old('BranchID') == $value->BranchID ? 'selected=selected' : '' }}>
                                                        {{ $value->BranchName }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-md-4 d-none">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Employee Name*</label>
                                            <select name="EmployeeID" id="EmployeeID" class="form-select">

                                                @foreach ($employee as $value)
                                                    <option value="{{ $value->EmployeeID }}"
                                                        {{ old('EmployeeID') == $value->EmployeeID ? 'selected=selected' : '' }}>
                                                        {{ $value->FirstName }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">



                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label>Select Date </label>

                                                <div class="input-daterange input-group" id="datepicker6"
                                                    data-date-format="dd/mm/yyyy" data-date-autoclose="true"
                                                    data-provide="datepicker" data-date-container="#datepicker6">
                                                    <input type="text" class="form-control" name="FromDate"
                                                        id="FromDate" placeholder="Start Date"
                                                        value="{{ old('FromDate') ? old('FromDate') : date('d/m/Y') }}"
                                                        required="">
                                                    <input type="text" class="form-control" name="ToDate" id="ToDate"
                                                        placeholder="End Date"
                                                        value="{{ old('ToDate') ? old('ToDate') : date('d/m/Y') }}"
                                                        required="">
                                                </div>
                                            </div>

                                        </div>











                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <label class="form-label">Time From </label>

                                                    <div class="input-group" id="timepicker-input-group2">
                                                        <input name="FromTime" id="timepicker2" type="text"
                                                            class="form-control" data-provide="timepicker"
                                                            value="{{ old('FromTime') }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div>
                                                    <label class="form-label">To Time</label>

                                                    <div class="input-group" id="timepicker-input-group2-to">
                                                        <input name="ToTime" id="timepicker2_to" type="text"
                                                            class="form-control" data-provide="timepicker"
                                                            value="{{ old('ToTime') }}">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        </script>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="verticalnav-address-input">Reason</label>
                                                <textarea id="verticalnav-address-input" class="form-control" rows="2" name="Reason" required="">{{ old('Reason') }}</textarea>
                                            </div>
                                        </div>
                                    </div>









                                    <div><button type="submit" class="btn btn-success w-lg float-right"
                                            disabled="">Save </button>
                                        <a href="{{ URL('/StaffLeave') }}"
                                            class="btn btn-secondary w-lg float-right">Cancel</a>
                                    </div>


                                </form>


                            </div>
                        </div>
                        <!-- end card -->

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Leave List</h4>




                                </div>
                            </div>
                        </div>
                        <!-- end page title -->



                        <?php

                        $v_leave = DB::table('v_leave')
                            ->where('EmployeeID', Session::get('EmployeeID'))
                            ->get();
                        $employee = DB::table('employee')
                            ->where('EmployeeID', Session::get('EmployeeID'))
                            ->first();
                        if ($employee->IsSupervisor == 'Yes') {
                            $staffMembers = DB::table('employee')
                                ->where('SupervisorID', Session::get('EmployeeID'))
                                ->get();
                        }
                        ?>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>

                                                    <th>Leave Type</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>No of Days</th>
                                                    <th>Time From</th>
                                                    <th>To</th>
                                                    <th>Reason</th>
                                                    <th>TL</th>
                                                    <th>HR</th>
                                                    <th>GM</th>


                                                    <th>Action</th>


                                                </tr>
                                            </thead>

                                            @foreach ($v_leave as $value)
                                                <tr>
                                                    <td>{{ $value->LeaveTypeName }}</td>
                                                    <td>{{ $value->FromDate }}</td>
                                                    <td>{{ $value->ToDate }}</td>
                                                    <td>{{ $value->NoOfDays }}</td>
                                                    <td>{{ $value->FromTime }}</td>
                                                    <td>{{ $value->ToTime }}</td>
                                                    <td>{{ $value->Reason }}</td>
                                                    <td
                                                        class="{{ $value->OMStatus != 'Approved' ? 'text-danger' : 'text-success' }}">
                                                        {{ $value->OMStatus }}</td>
                                                    <td
                                                        class="{{ $value->HRStatus != 'Approved' ? 'text-danger' : 'text-success' }}">
                                                        {{ $value->HRStatus }}</td>
                                                    <td
                                                        class="{{ $value->GMStatus != 'Approved' ? 'text-danger' : 'text-success' }}">
                                                        {{ $value->GMStatus }}</td>
                                                    <td><a href="javascript:void(0)"
                                                            onclick="delete_confirm2(`StaffLeaveDelete`,'{{ $value->LeaveID }}')"
                                                            class="dropdown-item"> Delete</a></td>
                                                </tr>
                                            @endforeach
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!-- end card -->
                            </div>
                            <!-- end col -->


                        </div>
                        @if ($employee->IsSupervisor == 'Yes')
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Team Pending Leaves List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Leave Type</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>No of Days</th>
                                                    <th>Time From</th>
                                                    <th>To</th>
                                                    <th>Reason</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            @foreach ($staffMembers as $staffmember)
                                            @php
                                                $staffLeaves = DB::table('v_leave')
                                                    ->where('EmployeeID', $staffmember->EmployeeID)
                                                    ->where('OMStatus', 'Pending')
                                                    ->get();
                                            @endphp
                                            @foreach ($staffLeaves as $value)

                                                <tr>
                                                    <td>{{ $value->LeaveTypeName }}</td>
                                                    <td>{{ $value->FromDate }}</td>
                                                    <td>{{ $value->ToDate }}</td>
                                                    <td>{{ $value->NoOfDays }}</td>
                                                    <td>{{ $value->FromTime }}</td>
                                                    <td>{{ $value->ToTime }}</td>
                                                    <td>{{ $value->Reason }}</td>
                                                    <td><a href="{{ url('ApproveStaffLeave', $value->LeaveID) }}" class="btn btn-sm btn-success"> Approve</a>
                                                        <a href="{{ url('RejectStaffLeave', $value->LeaveID) }}" class="btn btn-sm btn-danger"> Reject</a></td>
                                                </tr>
                                            @endforeach
                                            @endforeach
                                            <tbody>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                                <!-- end card -->
                            </div>
                            <!-- end col -->


                        </div>
                        <!-- end row -->



                    </div>
                    <!-- end col -->

                    <!-- employee detail side bar -->


                </div>
                <!-- end row -->

                @endif





            </div> <!-- container-fluid -->
        </div>


        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
            crossorigin="anonymous"></script>

        <script type="text/javascript">
            $("#success-alert").fadeTo(4000, 500).slideUp(100, function() {
                // $("#success-alert").slideUp(500);
                $("#success-alert").alert('close');
            });



            $("#LeaveTypeID").change(function() {
                // alert($('#EmployeeID').val());
                // alert({{ Session::token() }});

                var LeaveTypeID = $('#LeaveTypeID').val();
                var EmployeeID = $('#EmployeeID').val();



                console.log(LeaveTypeID);


                $.ajax({
                    url: "{{ URL('/ajax_leave_validate') }}/" + LeaveTypeID + "/" + EmployeeID,
                    type: "GET",
                    data: {
                        // _token: 43DeWyo3MzTaTYdg5iqACJ2nPyPwCa7NZO9KClYa,
                        "_token": "{{ csrf_token() }}",
                        LeaveTypeID: LeaveTypeID,
                        EmployeeID: EmployeeID,
                    },
                    cache: false,
                    success: function(data) {

                        // alert(data);
                        $('#result').html(
                            '<div class="spinner-border text-primary m-1" role="status"><span class="sr-only">Loading...</span>                  </div>'
                        );


                        $('#result').html(data);
                        if ($('#allow').val() == 0) {
                            $(':input[type="submit"]').prop('disabled', true);
                        } else {
                            $(':input[type="submit"]').prop('disabled', false);
                        }


                    }
                });

            });


            $(document).ready(function() {




                var LeaveTypeID = $('#LeaveTypeID').val();
                var EmployeeID = $('#EmployeeID').val();



                console.log(LeaveTypeID);


                $.ajax({
                    url: "{{ URL('/ajax_leave_validate') }}/" + LeaveTypeID + "/" + EmployeeID,
                    type: "GET",
                    data: {
                        // _token: 43DeWyo3MzTaTYdg5iqACJ2nPyPwCa7NZO9KClYa,
                        "_token": "{{ csrf_token() }}",
                        LeaveTypeID: LeaveTypeID,
                        EmployeeID: EmployeeID,
                    },
                    cache: false,
                    success: function(data) {

                        // alert(data);
                        $('#result').html(
                            '<div class="spinner-border text-primary m-1" role="status"><span class="sr-only">Loading...</span>                  </div>'
                        );


                        $('#result').html(data);
                        if ($('#allow').val() == 0) {
                            $(':input[type="submit"]').prop('disabled', true);
                        } else {
                            $(':input[type="submit"]').prop('disabled', false);
                        }


                    }
                });

            });
        </script>


    @endsection
