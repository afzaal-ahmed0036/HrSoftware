
<!doctype html>
<html  >

    
 <head>
        
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="HR Extensive Software" name="HR Software" />
        <meta content="Software" name="Kashif Mushtaq" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
       <!-- enctype="multipart/form-data" -->
       <form action="{{URL('/SendForgotEmail')}}" method="post"> {{csrf_field()}} 

         <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Reset Password</h5>
                                            <p>Re-Password with FCB HR.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="#">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="assets/images/logo.svg" alt="" class="rounded-circle" height="45">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="p-2">
                                    <div class="alert alert-success text-center mb-4" role="alert" id="success-alert">
                                        Enter your Email and instructions will be sent to you!
                                    </div>
                                    <form class="form-horizontal" action="https://themesbrand.com/skote-django/layouts/index.html">
            
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="Email" name="Email" class="form-control" id="useremail" placeholder="Enter email">
                                        </div>
                         <div class="mb-3">
                                                        <label class="d-block mb-2">Choose Staff Type</label>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="StaffType" id="inlineRadio1" value="Management" checked="">
                                                            <label class="form-check-label" for="inlineRadio1">Management (HR,GM,OM)</label>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="StaffType" id="inlineRadio2" value="Employee" {{ old('StaffType') == 'Employee' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio2">Employee</label>
                                                        </div>                                                          
                                                    </div>
                                        <div class="text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                        </div>
    
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p><a href="{{URL('/Login')}}" class="fw-medium text-primary"> Sign In here</a> </p>
                                <p>Copyright &copy <script>document.write(new Date().getFullYear())</script> HR Extensive System. All rights reserved</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

       </form>

           <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>

<script>
    $("#success-alert").fadeTo(4000, 500).slideUp(100, function(){
     $("#success-alert").slideUp("slow");
    $("#success-alert").alert('close');
});
</script>


    </body>

<!-- Mirrored from themesbrand.com/skote-django/layouts/auth-recoverpw.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 May 2021 18:23:06 GMT -->
</html>
