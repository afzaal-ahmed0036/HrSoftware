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
                                    <a href="{{ URL('/StaffTeam') }}"
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
                        <div class="card">
                            <div class="card-header bg-transparent border-bottom h5  ">
                                Add Daily Task
                            </div>
                            <div class="card-body">

                                <!-- enctype="multipart/form-data" -->
                                <form action="{{ URL('/DailyReportSave') }}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}


                                    <input type="hidden" name="EmployeeID" value="{{ $id}}">

                                    <div class="col-md-4 mb-3"> <label for="basicpill-firstname-input">Date</label>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" name="Date" class="form-control"
                                                placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy"
                                                data-date-container="#datepicker2" data-provide="datepicker"
                                                data-date-autoclose="true" value="{{ date('d/m/Y') }}">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Title</label>
                                            <input type="text" class="form-control" name="Title" required=""
                                                value="{{ old('Title') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="verticalnav-address-input">Detail</label>
                                            <textarea id="verticalnav-address-input" class="form-control" rows="4" name="Detail" required="">{{ old('Title') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Any file/document<br></label>
                                            <br><input type="file" name="File" id="File">
                                        </div>
                                    </div>
                                    <div><button type="submit" class="btn btn-success  btn-sm float-right">Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    @endsection
