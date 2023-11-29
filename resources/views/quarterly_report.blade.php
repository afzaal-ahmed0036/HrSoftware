@extends('template.tmp')
@section('title', 'Quarterly Report')
@section('content')
<style>
    .table-sm>:not(caption)>*>*{
        padding: 1.3rem 1.3rem;
    }
    .table>thead{
        background-color: #55607F;
        color: white;
    }
</style>
 <div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Quarterly Report</h4>
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
                            <form action="{{URL('/QuarterlyReport')}}" method="post">
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
                                            <label for="basicpill-firstname-input">Year*</label>
                                            <div class="input-group">
                                                <input type="text" id="yearPicker" name="year" class="form-control" value="{{@$active_year}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                       <div class="mb-3">
                                            <label for="basicpill-firstname-input">Quarter*</label>
                                            <select name="quarter" id="quarter" class="form-select">
                                                <option value="1" {{(@$quarter== 1) ? 'selected=selected': '' }}>Quarter 1</option>
                                                <option value="2" {{(@$quarter== 2) ? 'selected=selected': '' }}>Quarter 2</option>
                                                <option value="3" {{(@$quarter== 3) ? 'selected=selected': '' }}>Quarter 3</option>
                                                <option value="4" {{(@$quarter== 4) ? 'selected=selected': '' }}>Quarter 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-success w-lg float-right filter" style="float:right;">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div> 
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Quartly Report</h4>
                            @if(count($employees) >0)
                            <table  class="table table-bordered table-sm dt-responsive nowrap w-100 no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 1247px;">
                                <thead>
                                    <tr role="row" >
                                    <th scope="col" >S.No</th>
                                    <th scope="col">Agent</th>
                                    @if($quarter == 1)
                                    <th scope="col">January</th>
                                    <th scope="col">Feburary</th>
                                    <th scope="col">March</th>
                                    @elseif($quarter == 2)
                                    <th scope="col">April</th>
                                    <th scope="col">May</th>
                                    <th scope="col">June</th>
                                    @elseif($quarter == 3)
                                    <th scope="col">July</th>
                                    <th scope="col">August</th>
                                    <th scope="col">September</th>
                                    @elseif($quarter == 4)
                                    <th scope="col">October</th>
                                    <th scope="col">November</th>
                                    <th scope="col">December</th>
                                    @else
                                    <th scope="col">N/A</th>
                                    @endif
                                    <th scope="col">Total</th>
                                </tr>
                                </thead>
                                <tbody> 
                                    <?php $i=1; ?>
                                    @foreach($employees as $employee)
                                        <?php $emp_count = 0;  ?>
                                        <tr>
                                        <td>{{$i}}.</td>
                                        <td>{{$employee->FirstName}} {{$employee->MiddleName}} {{$employee->LastName}}</td>
                                        @foreach($months as $monthYear)
                                            @php
                                                $count = \DB::table('v_fcb')->where('EmployeeID',$employee->EmployeeID)->where('MonthName',$monthYear)->count();
                                                $emp_count = $emp_count + $count;
                                            @endphp
                                            @if($count > 0)
                                            <td><b>{{$count}}</b></td>
                                            @else
                                            <td>{{$count}}</td>
                                            @endif
                                        @endforeach
                                        <td><b>{{$emp_count}}</b></td>  
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach

                                    @foreach($unfcbemployee as $unfcb)
                                        <tr>
                                        <td>{{$i}}.</td>
                                        <td>{{$unfcb->FirstName}} {{$unfcb->MiddleName}} {{$unfcb->LastName}}</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach


                                </tbody>
                                <tfoot>
                                    <tr>
                                    <td colspan="2" style="text-align:right;"><b>Total</b></td>
                                    <?php $grand_total = 0; ?>
                                    @foreach($months as $monthYear)
                                        @php
                                            $total = \DB::table('v_fcb')->where('BranchID',$branch_id)->where('MonthName',$monthYear)->count();
                                            $grand_total = $grand_total + $total;
                                        @endphp
                                        <td><b>{{$total}}</b></td>
                                    @endforeach
                                    <td><b>{{$grand_total}}</b></td> 
                                    
                                    </tr>
                                </tfoot>
                            </table>
                            @endif
                           
                            @if(count($employees) ==0) 
                            <p class="text-danger h6">No record to display</p>
                            @endif
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
@endsection