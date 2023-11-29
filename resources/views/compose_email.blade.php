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
                                    <h4 class="mb-sm-0 font-size-18">Form Layouts</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                         
                                         <strong>Visa Expirty:</strong> {{dateformatman($employee[0]->VisaExpiryDate)}}<br>
                                         <strong>Passport Expirty:</strong> {{dateformatman($employee[0]->PassportExpiry)}}

                                        <!--  <a href="#" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" onclick="history.back()"><i class="mdi mdi-arrow-left me-1"></i> Go Back</a> -->
                                         
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3" id="success-alert">
                    
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
                                <div class="card">
                                    <div class="card-body">
<!-- enctype="multipart/form-data" -->
<form action="{{URL('/SendEmail')}}" method="post"> {{csrf_field()}} 


          <input type="hidden" name="PageLink" value="{{url()->previous()}}">                              
<div class="row">
  
                                          <div class="col-md-6">
                                        <div class="mb-3">
                                        <label for="basicpill-firstname-input">Name*</label>
                                        <input type="text" class="form-control" name="Name" value="{{$employee[0]->FirstName}} {{$employee[0]->MiddleName}} {{$employee[0]->LastName}}">
                                        </div>
                                        </div>
                                        


                                          <div class="col-md-6">
                                        <div class="mb-3">
                                        <label for="basicpill-firstname-input">Email*</label>
                                        <input type="text" class="form-control" name="Email" value="{{$employee[0]->Email}} ">
                                        </div>
                                        </div>



                                          <div class="col-md-12">
                                        <div class="mb-3">
                                        <label for="basicpill-firstname-input">Subject*</label>
                                        <input type="text" class="form-control" name="Subject" value="Friends Commodity Brokerage - Email Notification ">
                                        </div>
                                        </div>


                                          <div class="col-md-12">
                                        <div class="mb-3">
                                        <label for="basicpill-firstname-input">Message*</label>
                                         <textarea name="Message" id="basic-example" cols="30" rows="6" class="form-control">
 Dear {{$employee[0]->FirstName}} {{$employee[0]->MiddleName}} {{$employee[0]->LastName}},

<br>
<br>
<br>
<br>
<br>
<br>
<br>

 <strong>HR Department</strong>
                                         </textarea>

                                           <script src="{{URL('/assets/js/tinymce.min.js')}}"></script>
      <script id="rendered-js" >
tinymce.init({
  selector: 'textarea',
  height: 350,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor textcolor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code help wordcount'
  ],
  mobile: { 
    theme: 'mobile' 
  },
  toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
  content_css: [
    '//{{ asset("assets/css/css.css")}}',
    '//{{ asset("assets/css/codepen.min.css")}}'
  ],
});
//# sourceURL=pen.js
    </script>


                                        </div>
                                        </div>

                                       
                                        
            
                                        <div><button type="submit" class="btn btn-success w-md float-right"><i class="bx bxs-paper-plane"></i> Send Mail</button>
                                             <a href="#" onclick="history.back()" class="btn btn-secondary w-md float-right">Cancel</a>
                                        </div>
                                                                    
                                        
</div></form>


                                        
                                        
                                        
                                        
                                        

                                        
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