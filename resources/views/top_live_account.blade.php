@extends('template.tmp')
@section('title', 'HR')
@section('content')
<style>
    .table-sm>:not(caption)>*>*{
        padding: 0.5rem 0.5rem;
        font-size: 1.5rem;
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
                        <h4 class="mb-sm-0 font-size-18">Top Live Account Report</h4>
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
                            <form action="{{URL('/TopLiveAccount')}}" method="post">
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
                                            <label for="basicpill-firstname-input">Month*</label>
                                            <div class="input-group">
                                                <input type="text" id="monthpicker" name="month" class="form-control" value="{{@$active_monthYear}}">
                                            </div>
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
                            <h4 class="card-title mb-2">Top Live Account Report</h4>
                            @if(count($fcbsummary) >0)
                            <table  class="table table-bordered table-sm dt-responsive nowrap w-100 no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 1247px;">
                                <thead>
                                    <tr role="row" >
                                    <th scope="col" >S.No</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; $actual_accounts=0; ?>
                                    @foreach($fcbsummary as $value)
                                    @php
                                    $actual_accounts += $value->tot;
                                    @endphp    
                                    <tr>
                                    <td>{{$i}}.</td>
                                    <td>{{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}</td>
                                    <td>{{$value->tot}}</td>
                                    <td>{{ round((@$value->tot / (@$Daily_Live_Target/@$current_target))*100) }}%</td>
                                    </tr>
                                        <?php $i++; ?>
                                    @endforeach

                                    @foreach($unfcbemployee as $unfcb)
                                    <tr>
                                    <td>{{$i}}.</td>
                                    <td>{{$unfcb->FirstName}} {{$unfcb->MiddleName}} {{$unfcb->LastName}}</td>
                                    <td>0</td>
                                    <td>0%</td>
                                    </tr>
                                        <?php $i++; ?>
                                    @endforeach

                                </tbody>
                                <tfoot >
                                    <tr>
                                    <td colspan="2" style="text-align:right;"><b>Total</b></td>
                                    <td><b>{{$actual_accounts}}</b></td>
                                    <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered table-sm dt-responsive nowrap w-100 dtr-inline" style="padding:20px;" >
                                <thead>
                                    <tr role="row" >   
                                        <th scope="col" >Live Target </th>
                                        <th scope="col">Daily Live Target</th>
                                        <th scope="col">Actual number </th>
                                        <th scope="col">Difference to target</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr>
                                        <td style="background-color: #FFFF00;">{{ @$live_target }}</td>
                                        <td style="background-color: #FFFF00;">{{ @$Daily_Live_Target}}</td>
                                        <td style="background-color: #00FF00;">{{ @$actual_accounts}}</td>
                                        <td style="background-color: #D9EAD3;">{{ @$Daily_Live_Target-@$actual_accounts}}</td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered table-sm dt-responsive nowrap w-100 dtr-inline" role="grid" >
                                        <thead>
                                            <tr role="row" >         
                                                <th scope="col" >Total Working <br> Days </th>
                                                <th scope="col">Elapsed <br> Days </th>
                                                <th scope="col">Remaining <bR> Days </th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            <tr>
                                                <td>{{ @$working_days}}</td>
                                                <td>{{ @$elapsed_days}}</td>
                                                <td style="background-color:#FF00FF;"><b style="font-size:20px;color:white;">{{ @$working_days-@$elapsed_days}}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                           
                            @if(count($fcbsummary) ==0) 
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