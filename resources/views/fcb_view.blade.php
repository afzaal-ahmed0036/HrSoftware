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
                                       <form action="{{URL('/FCBPrint')}}" method="post">  

     <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">


<div class="row">

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


     <div   id="result" >  
          <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input">Select Month</label>
     <select name="MonthName" id="MonthName" class="form-select">
    <option value="">Select</option>
  
 
  </select>
  </div>
   </div>
     </div>




</div>



 

  
 
  

 

 


   <div class="mt-3"><button type="submit" class="btn btn-success w-md float-right">Submit</button>
        
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
 

<script>
 

 
   
    $("#BranchID").change(function(){
      
      // alert('ddd');
      
      var BranchID = $('#BranchID').val();

      // alert(BranchID);
       if(BranchID!=""  ){
        /*  $("#butsave").attr("disabled", "disabled"); */
          $.ajax({
              url: "{{URL('/Ajax_FCBMonthName/')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                   BranchID: BranchID,
                 
              },
              cache: false,
              success: function(data){
            

              
                    $('#result').html(data);
           
                 
                  
              }
          });
      }
      else{
          alert('Please Select Branch');
      }
  });
 
</script>
  @endsection