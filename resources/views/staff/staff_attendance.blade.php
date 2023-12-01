@extends('template.staff_tmp')

@section('title', 'Emplyee Section')


@section('content')

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
                            <div class="alert alert-{{ Session::get('class') }} p-3 ">

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


                        <div class="card p-5">
                            <div class="card-header bg-transparent border-bottom h5  ">
                                Attendance Summary Section
                            </div>
                            <div class="card-body">
                                @if (count($attendance) != 0)
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-sm" id="AttendanceTable">

                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
                                                    <th>Status</th>
                                                    <th>Working Hours</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($attendance as $value)
                                                    <tr
                                                        class="{{ $value->Status == 'Absent' ? 'bg-danger text-white' : '' }}">
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ dateformatman($value->date) }}</td>
                                                        <td>{{ $value->CheckIn != null ? $value->CheckIn : 'N/A' }}</td>
                                                        <td>{{ $value->CheckOut != null ? $value->CheckOut : 'N/A' }}</td>
                                                        <td>{{ $value->Status }}</td>
                                                        @if ($value->CheckIn == null && $value->CheckOut == null)
                                                            <td>00 hrs : 00 mins</td>
                                                        @elseif ($value->CheckOut != null)
                                                            @php
                                                                $checkinDateTime = Carbon\Carbon::createFromFormat('H:i:s', $value->CheckIn, 'Asia/Dubai');
                                                                $checkoutDateTime = Carbon\Carbon::createFromFormat('H:i:s', $value->CheckOut, 'Asia/Dubai');

                                                                $timeDifference = $checkoutDateTime->diff($checkinDateTime);
                                                                $hours = $timeDifference->h;
                                                                $minutes = $timeDifference->i;
                                                                // dd($timeDifference);
                                                            @endphp
                                                            <td>{{ $hours . ' hrs : ' . $minutes . ' mins' }}</td>
                                                        @else
                                                            @php
                                                                $checkinDateTime = Carbon::createFromTimeString($value->CheckIn, 'Asia/Dubai');
                                                                $checkoutDateTime = Carbon\Carbon::now('Asia/Dubai');
                                                                $timeDifference = $checkoutDateTime->diff($checkinDateTime);
                                                                $hours = $timeDifference->h;
                                                                $minutes = $timeDifference->i;
                                                            @endphp
                                                            <td>{{ $hours . ' hrs : ' . $minutes . ' mins' }} <i
                                                                    class="fa fa-arrow-up text-success"></i></td>
                                                        @endif

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-danger text-center">No Record Found</p>
                                @endif


                            </div>
                        </div>
                        <div class="card p-5">
                            <div class="card-header bg-transparent border-bottom h5  ">
                                Attendance Detail Section
                            </div>
                            <div class="card-body">
                                @if (count($attendance) != 0)
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-sm" id="AttendanceDetailTable">

                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Hours Worked</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($attendances as $value)
                                                    <tr
                                                        class="{{ $value->Status == 'Absent' ? 'bg-danger text-white' : '' }}">
                                                        <th scope="row">{{ $i++ }}</th>
                                                        <td>{{ dateformatman($value->attendance_date) }}</td>
                                                        <td>{{ $value->Status }}</td>
                                                        <td>
                                                            @php
                                                                $totalHours = floor($value->total_hours);
                                                                $totalMinutes = round(($value->total_hours - $totalHours) * 60);
                                                            @endphp
                                                            {{ $value->Status == 'CheckedIN' ? 'Still Working' : $totalHours . ' hrs : ' . $totalMinutes . ' mins' }}
                                                        </td>

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-danger text-center">No Record Found</p>
                                @endif


                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->




                </div>
                <!-- end row -->








            </div> <!-- container-fluid -->
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#AttendanceTable').dataTable();
                $('#AttendanceDetailTable').dataTable();

            });
        </script>

    @endsection
