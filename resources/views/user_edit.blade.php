@extends('template.tmp')

@section('title', 'Users')
 

@section('content')

 <div class="main-content">

 <div class="page-content">
<div class="container-fluid">

 <!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
 <h4 class="mb-sm-0 font-size-18">Manage Users</h4>

 <div class="page-title-right">
<div class="page-title-right">

</div>
</div>
</div>
</div>
<div>
 <!-- end page title -->

 @if (session('error'))

 <div class="alert alert-{{ Session::get('class') }} p-3">
                    
                   {{ Session::get('error') }}  
                </div>

@endif

 @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3">
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
 <div class="col-12">
    <form action="{{URL('/UpdateUser')}}" method="post">
        {{csrf_field()}}
<div class="card">
<div class="card-body">

<h4 class="card-title">Update User</h4>
<p class="card-title-desc"></p>

 <div class="mb-3 row">
<label for="example-text-input" class="col-md-2 col-form-label">Branch Name</label>
<div class="col-md-10">
<input type="hidden" name="UserID" value="{{$v_users[0]->UserID}}">
<select name="BranchID" class="form-select">
    @foreach($branch as $value)
    <option value="{{$value->BranchID}}" {{($v_users[0]->BranchID == $value->BranchID ) ? 'selected=selected':'' }}>{{$value->BranchName}}</option>
    @endforeach
</select>
</div>
 </div>



<div class="mb-3 row">
<label for="example-email-input" class="col-md-2 col-form-label">Full Name</label>
<div class="col-md-10">
<input class="form-control" type="text"   name="FullName" id="example-email-input" value="{{$v_users[0]->FullName}}">
</div>
</div>
<div class="mb-3 row">
<label for="example-url-input" class="col-md-2 col-form-label">Username</label>
<div class="col-md-10">
<input class="form-control" type="text"  name="Email" required value="{{$v_users[0]->Email}}">
</div>

</div>
<div class="mb-3 row">
<label for="example-url-input" class="col-md-2 col-form-label">Password</label>
<div class="col-md-10">
<input class="form-control" type="text"  name="Password" required value="{{$v_users[0]->Password}}">
</div>

</div>
<div class="mb-3 row">
<label for="example-tel-input" class="col-md-2 col-form-label">User Type</label>
<div class="col-md-10">
<select name="UserType" class="form-select">

     
      <option value="HR" {{($v_users[0]->UserType == 'HR' ) ? 'selected=selected':'' }}>HR</option>
    <option value="OM" {{($v_users[0]->UserType == 'OM' ) ? 'selected=selected':'' }}>OM</option>
    <option value="GM" {{($v_users[0]->UserType == 'GM' ) ? 'selected=selected':'' }}>GM</option>
      
     




</select> </div>
 </div>
 <div class="mb-3 row">
<label for="example-tel-input" class="col-md-2 col-form-label">Active</label>
<div class="col-md-10">
<select name="Active" class="form-select">

     
    <option value="Y" {{($v_users[0]->Active == 'Y' ) ? 'selected=selected':'' }}>Yes</option>
    <option value="N" {{($v_users[0]->Active == 'N' ) ? 'selected=selected':'' }}>No</option>
    
    


</select> </div>
 </div>

 
                                      
    <input type="submit" class="btn btn-primary w-md" value="Update">  

    <a href="{{URL('/Users')}}" class="btn btn-secondary w-md">Cancel</a>                                
                                   
    
                                      
                                        

                                       

                                    </div>
                                </div>

                            </form>
                            </div> <!-- end col -->
                        </div>
                      

  
                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


    
</div>
  @endsection