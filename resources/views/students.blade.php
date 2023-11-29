@extends('template.tmp')

@section('title', 'Online Admissions')
 

@section('content')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 s
 <script type="text/javascript">

           

         function printout(id)
    {
 window.open("{{URL('/PrintOut')}}/"+id,"_self"); 
//alert(id);
    }  

     function edit_data(id)
    {
 window.open("{{URL('/edit_customer')}}/"+id,"_self"); 
//alert(id);
    }

    function del_data(id)
    {

        var txt;
var r = confirm("Do you want to delete");
if (r == true) {
   window.open("{{URL('/customer_detail')}}/ "+id,"_self");  
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
                                    <h4 class="mb-sm-0 font-size-18">Online Admissions</h4>

                                    <div class="page-title-right d-none">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                         <a href="{{URL('/customer')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> New Customer</a>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
 @if (Session('error'))

 <div class="alert alert-{{ Session::get('class') }} p-3" id="success-alert">
                    
                  {{ Session::get('error') }}
                </div>

@endif
                        <div class="row">
                            <div class="col-xl-12">
                                 <div class="card">
                                     <div class="card-body p-4">
                                         <table id="datatable" class="table   dt-responsive  nowrap w-100 table-sm">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Middle Name</th>
                                                <th>Last Name</th>
                                                <th>Job Title</th>
                                                <th>Department</th>
                                                <th>Branch</th>
                                                
                                                <th>Action</th>
                                           
                                                
                                             </tr>
                                            </thead>
        
        
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

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>




<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->

 

<script type="text/javascript">
$(document).ready(function() {

     

     $('#datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength":50,
        "ajax": "{{ url('ajax_employee') }}",
        "columns":[
            { "data": "FirstName" },
            { "data": "MiddleName" },
            { "data": "LastName" },
            { "data": "JobTitleName" },
            { "data": "DepartmentName" },
            { "data": "BranchName" },
             
            
           
        
            { "data": "action" }
        ]
     
     });
});

$("#success-alert").fadeTo(4000, 500).slideUp(100, function(){
    // $("#success-alert").slideUp(500);
    $("#success-alert").alert('close');
});


</script>

 
  @endsection