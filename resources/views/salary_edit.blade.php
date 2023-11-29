@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')

 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Edit Salary</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                         <a href="#" onclick="history.back()" class="btn btn-success w-md float-right btn-rounded">Go Back</a>
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

                       <!-- enctype="multipart/form-data" -->
                       <form action="{{URL('/SalaryUpdate')}}" method="post"> {{csrf_field()}} 


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                    
<input type="hidden" name="SalaryID" value="{{$salary[0]->SalaryID}}">
                      <div class="col-md-4">
                    <div class="mb-3">
                    <label for="basicpill-firstname-input">Salary </label>
                    <input type="text" class="form-control" name="Salary" value="{{$salary[0]->Salary}} " id="Salary">
                    </div>
                    </div>

                        <div class="col-md-4">
                    <div class="mb-3">
                    <label for="basicpill-firstname-input">Comission </label>
                    <input type="text" class="form-control" name="Comission" value="{{$salary[0]->Comission}}" id="Comission">
                    </div>
                    </div>

                        <div class="col-md-4">
                    <div class="mb-3">
                    <label for="basicpill-firstname-input">Bonus</label>
                    <input type="text" class="form-control" name="Bonus" value="{{$salary[0]->Bonus}}" id="Bonus">
                    </div>
                    </div>

                        <div class="col-md-4">
                    <div class="mb-3">
                    <label for="basicpill-firstname-input">Grand </label>
                    <input type="text" class="form-control" name="Grand" value="{{$salary[0]->Grand}}" id="Grand">
                    </div>
                    </div>
                    

                      <div><button type="submit" class="btn btn-success w-lg float-right">Update Salary</button>
                             <a href="#" onclick="history.back()" class="btn btn-secondary w-md float-right">Cancel</a>
                        </div>
                        

                    
                    
                                        
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->


                    </form>

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

  $('#Salary').keyup(function () {
   CalculateSalary();
                 
            });

$('#Comission').keyup(function () {
    CalculateSalary();
                 
            });


$('#Bonus').keyup(function () {
    CalculateSalary();
                 
            });




 
});
 


 

    


    



 function CalculateSalary() {
     
   
  var   Salary = parseFloat($('#Salary').val());
  var    Comission = parseFloat($('#Comission').val());
  var    Bonus = parseFloat($('#Bonus').val());


  if (Bonus == '') {

          // Bonus = 0.1;
           //alert(Bonus);
           // var Total = parseInt(Bonus) + parseInt(Grand);
           
           $('#Bonus').val(    0      );
        }




    var Grand=0;
           Grand = parseFloat(Salary) + parseFloat(Comission) + parseFloat(Bonus);
           $('#Grand').val(     parseFloat(Grand).toFixed(2)     );     
  // if (TotalMarks > 0 && obtainedMarks > 0) {
  // $('#Percentage').val(((obtainedMarks * 100) / TotalMarks).toFixed(2));
              

    

    }
</script>
  @endsection