@extends('template.tmp')

@section('title', 'HR')
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Deposit</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3"  id="success-alert">
                    
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

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
 
                                       <!-- enctype="multipart/form-data" -->
                                       <form action="{{URL('/FCBSetMonthName')}}" method="post"> {{csrf_field()}} 

 

<div class="row">
        <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Select Month</label>
     <select name="MonthName" id="MonthName" class="form-select">
    <option value="">Select</option>
    <?php foreach ($monthname as $key => $value) { ?>
        <option value="{{$value->MonthName}}" {{($value->MonthName== old('MonthName')) ? 'selected=selected':'' }}
  >{{$value->MonthName}}</option>


<?php
    }
?>
 
  </select>
  </div>
   </div>

       <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Select Branch</label>
     <select name="BranchID" id="BranchID" class="form-select">
    <option value="">Select</option>
    <?php foreach ($branch as $key => $value) { ?>
        <option value="{{$value->BranchID}}" {{($value->BranchID== old('BranchID')) ? 'selected=selected':'' }}>{{$value->BranchName}}</option>


<?php
    }
?>
 
  </select>
  </div>
   </div>


</div>



 

 <?php 

 if($Type=='Print')
{

  ?>

 

 


 <div class="col-lg-4">  
  <div class="form-group">
  </div>     <div class="form-check form-check-inline pt-1">
  <input class="form-check-input" type="radio" name="Action" id="inlineRadio1"  checked value="Print" {{ old('Action') == 'Yes' ? 'checked' : '' }}>
  <label class="form-check-label" for="inlineRadio1">Print</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="Action" id="inlineRadio2" value="Download"   {{ old('Action') == 'No' ? 'checked' : '' }}>
  <label class="form-check-label" for="inlineRadio2">Download</label>
</div>
 </div>



<?php


}

else
  { 

    ?>

    <input type="hidden" class="form-control" name="Action" value="{{$Type}}">


<?php

  }


  ?>
 
  

 

 


   <div class="mt-3"><button type="submit" class="btn btn-success w-md float-right">Save / Update</button>
        
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

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection