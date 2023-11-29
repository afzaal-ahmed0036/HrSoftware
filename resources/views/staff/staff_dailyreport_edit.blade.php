@extends('template.staff_tmp')

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
                            <div class="col-xl-12">
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

           @include('staff.staff_info')




<div class="card">
       <div class="card-header bg-transparent border-bottom h5  ">
                                       Add Daily Task 
                                    </div>
    <div class="card-body">

      <!-- enctype="multipart/form-data" -->
      <form action="{{URL('/DailyReportUpdate')}}" method="post"  > 

        {{csrf_field()}} 


<input type="hidden" name="DailyReportID" value="{{$daily_report[0]->DailyReportID}}"> 

          <div class="col-md-4 mb-3">  <label for="basicpill-firstname-input">Date : </label>
           {{$daily_report[0]->Date}}
          </div>

          <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Title</label>
        <input type="text" class="form-control" name="Title" required="" value="{{$daily_report[0]->Title}}">
        </div>
        </div>
        

<div class="col-md-12">
<div class="mb-3">
<label for="verticalnav-address-input">Detail</label>
<textarea id="verticalnav-address-input" class="form-control" rows="4" name="Detail" required="" >{{$daily_report[0]->Detail}}</textarea>
</div>
</div>



<div class="col-md-4">
  <div class="mb-3">
    <label for="basicpill-firstname-input">Any file/document<br></label>
    <br><a href="{{URL('/reports/').'/'.$daily_report[0]->File}}" target="_blank">File</a>
  </div>
</div> 
        
        

<div class="col-md-12">
<div class="mb-3 ">
<label for="verticalnav-address-input">Supervisor Comments</label>
<textarea id="verticalnav-address-input" class="form-control border-1 border-danger" name="SupervisorComments" rows="4" name="Detail" required="" ></textarea>
</div>
</div>

        <div><button type="submit" class="btn btn-success  btn-sm float-right">Update</button>
             
        </div>
        

      </form>

    </div>
</div>


                             



 


                            </div>
                            <!-- end col -->
                         
                    

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection