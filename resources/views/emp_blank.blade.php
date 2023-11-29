@extends('template.tmp')

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

                                         <a href="{{URL('/Employee')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-arrow-left  me-1 pt-5"></i> Go Back</a>
                                         
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-9">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3 ">
                    
                  {{ Session::get('error') }} 
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="me-3">
                                                <img src="{{URL('/emp-picture/'.$employee[0]->Picture)}}" alt="" class="avatar-md rounded  ">
                                            </div>
                                            <div class="media-body align-self-center">
                                                <div class="text-muted">
                                                    <h5>{{$employee[0]->FirstName}} {{$employee[0]->MiddleName}} {{$employee[0]->LastName}}</h5>
                                                    <p class="mb-1">{{$employee[0]->JobTitleName}} , {{$employee[0]->DepartmentName}}</p>
                                                    <p class="mb-0">{{$employee[0]->BranchName}}</p>
                                                     
                                                </div>
                                            </div>
                                    

                                                        <div class="dropdown ms-2">
                                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="bx bxs-cog align-middle me-1"></i> Manage
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end" style="margin: 0px;">
                                                            <a class="dropdown-item" href="{{URL('/EmployeeEdit/'.$employee[0]->EmployeeID)}}"><i class="mdi mdi-pencil text-secondary font-size-16 me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="#"> <i class="mdi mdi-trash-can text-secondary font-size-16 me-2"></i>Delete</a>
                                                         </div>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                             <div class="card">
                                  <div class="card-header bg-transparent border-bottom h5  ">
                                        Offical Details
                                    </div>
                                    <div class="card-body">

                                        dddd

 
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                         
                         <!-- employee detail side bar -->
                         @include('template.emp_sidebar')

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection