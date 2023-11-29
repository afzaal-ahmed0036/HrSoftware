@extends('template.tmp')
@section('title', 'Edit Month Target')
@section('content')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/light.css">
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Update Monthly Target</h4>
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

                <form action="{{URL('/CurrentTargetUpdate')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="target_id" value="{{$monthly_target->MonthlyTargetID}}">
                    <input type="hidden" name="no_of_agents" value="{{$no_of_agents}}">
                    <input type="hidden" name="low_target" id="low_result" value="{{@$get_full_target_detail[0]->target}}">
                    <input type="hidden" name="medium_target" id="medium_result" value="{{@$get_full_target_detail[1]->target}}">
                    <input type="hidden" name="high_target" id="high_result" value="{{@$get_full_target_detail[2]->target}}">
                    <input type="hidden" name="manual_target" id="manual_result" value="{{@$get_full_target_detail[3]->target}}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4"></h4> 
                                <div class="row">
                                    <div class="col-md-4">
                                       <div class="mb-3">
                                            <label for="basicpill-firstname-input">Branch*</label>
                                            <p><b>{{$branch_name}}</b></p>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Month*</label>
                                            <p><b>{{$monthYear}}</b></p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- end card body -->
                    </div> 
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Current Month Target</h4>
                            <div class="row">
                                <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Select Disable Days*</label>
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col">Disable Days</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <td>

                                            <div class="input-group" id="datepicker2">
                                                    <input id="date1" name="disable_dates" value="{{$disabled_dates}}" data-input class="form-control" style="width:100px;"/>
                                                </div>
                                                </td>
                                                  
                                                </tr>
                                              </tbody>
                                            </table>
                                        </div>
                                </div>
                                <div class="col-md-8">
                                        <div class="mb-3 ms-2">
                                            <label for="basicpill-firstname-input">Select Target*</label>
                                            <!-- <div class="input-group">
                                                                    
                                            </div> -->
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col">Type</th>
                                                  <th scope="col" style="width: 30%;">Average</th>
                                                  <th scope="col">No of Agents</th>
                                                  <th scope="col">Target</th>
                                                  <th scope="col">Action</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <td>Low</td>
                                                  <td><input type="text" id="low_input" name="low_average" value="{{@$get_full_target_detail[0]->average}}" required class="form-control"/></td>
                                                  <td id="low" align="center">{{$no_of_agents}}</td>
                                                  <td id="low_target" align="center">{{@$get_full_target_detail[0]->target}}</td>
                                                  <td align="center"><input type="radio" name="btnRadio" required value="Low" {{(@$get_full_target_detail[0]->type == $monthly_target->CurrentTarget) ? 'checked': '' }} /></td>
                                                </tr>
                                                <tr>
                                                  <td>Medium</td>
                                                  <td><input type="text" id="medium_input" name="medium_average" value="{{@$get_full_target_detail[1]->average}}" required class="form-control"/></td>
                                                  <td id="medium" align="center">{{$no_of_agents}}</td>
                                                  <td id="medium_target" align="center">{{@$get_full_target_detail[1]->target}}</td>
                                                  <td align="center"><input type="radio" name="btnRadio" value="Medium" {{(@$get_full_target_detail[1]->type == $monthly_target->CurrentTarget) ? 'checked': '' }}  /></td>
                                                </tr>
                                                <tr>
                                                  <td>High</td>
                                                  <td><input type="text" id="high_input" name="high_average" value="{{@$get_full_target_detail[2]->average}}" required class="form-control"/></td>
                                                  <td id="high" align="center">{{$no_of_agents}}</td>
                                                  <td id="high_target" align="center">{{@$get_full_target_detail[2]->target}}</td>
                                                  <td align="center"><input type="radio" name="btnRadio" value="High" {{(@$get_full_target_detail[2]->type == $monthly_target->CurrentTarget) ? 'checked': '' }} /></td>
                                                </tr>
                                                <tr>
                                                  <td>Manual</td>
                                                  <td><input type="text" id="manual_input" name="manual_average" value="{{@$get_full_target_detail[3]->average}}" required class="form-control"/></td>
                                                  <td id="manual" align="center">{{$no_of_agents}}</td>
                                                  <td id="manual_target" align="center">{{@$get_full_target_detail[3]->target}}</td>
                                                  <td align="center"><input type="radio" name="btnRadio" value="Manual" {{(@$get_full_target_detail[3]->type == $monthly_target->CurrentTarget) ? 'checked': '' }} /></td>
                                                </tr>
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-firstname-input">Enter Live Targer*</label>
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th scope="col">Live Targer</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <tr>
                                                  <td>
                                                    <div class="input-group" id="datepicker2" >
                                                    <input type="text" name="LiveTarget" class="form-control" value="{{@$monthly_target->LiveTarget}}" style="width:100px;" required>
                                                    </div>
                                                </td>
                                                  
                                                </tr>
                                              </tbody>
                                            </table>
                                              
                                            
                                        </div>
                                </div>
                                
                                <div>
                                    <button type="submit" class="btn btn-success w-lg float-right filter" style="float:right;">Save</button>
                                </div>
                                        
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                </form>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

<script type="text/javascript">
        $(document).ready(function(){
            $("#date1").flatpickr({
            dateFormat: "Y-m-d",
            // inline:true,
            "disable": [
                function(date) {
                   return (date.getDay() === 0);  // disable weekends
                }
            ],
            "locale": {
                "firstDayOfWeek": 0 // set start day of week to Monday
            },
            mode: "multiple",
            clickOpens: true
            // maxDate: new Date().fp_incr(14)
        });
            
        $('#low_input').keyup(function(){
            var input = $(this).val();
            var no_of_agents = $('#low').text();
            var result = Math.round(input * no_of_agents);
            $('#low_target').html(result);
            $('#low_result').val(result);
        });
        $('#medium_input').keyup(function(){
            var input = $(this).val();
            var no_of_agents = $('#medium').text();
            var result = Math.round(input * no_of_agents);
            $('#medium_target').html(result);
            $('#medium_result').val(result);
        });
        $('#high_input').keyup(function(){
            var input = $(this).val();
            var no_of_agents = $('#high').text();
            var result = Math.round(input * no_of_agents);
            $('#high_target').html(result);
            $('#high_result').val(result);
        });
        $('#manual_input').keyup(function(){
            var input = $(this).val();
            var no_of_agents = $('#manual').text();
            var result = Math.round(input * no_of_agents);
            $('#manual_target').html(result);
            $('#manual_result').val(result);
        });

        // calender js
            


        // end calender js
    });
</script>    
@endsection