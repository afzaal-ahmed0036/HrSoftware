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
                                    <h4 class="mb-sm-0 font-size-18">Notices</h4>

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
                                        



                                        <table class="table table-sm align-middle table-nowrap mb-0">
                                        <tbody>
                                            <tr >
                                        <th style="width: 10px;" >S.No</th>
                                        <th style="width: 600px;" >Title</th>
                                         <th style="width: 10px;" >Status</th>
                                        <th style="width: 10px;" >Date</th>
                                        <th style="width: 10px;" >Action</th>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                         @if(!$notice->isEmpty())        
                                        @foreach ($notice as $key =>$value)
                                         <tr valign="top" >
                                         <td >{{$key+1}}</td>
                                         <td >{{$value->Title}}</td>
                                         
                                         <td ><span class="badge  {{($value->Status=='Draft') ?'badge bg-warning' : 'bg-primary'}}">{{$value->Status}}</span></td>
                                         <td >{{dateformatman($value->Date)}}</td>
                                         
                                         <td >

                                            <a href="{{URL('/NoticeBoardView/').'/'.$value->NoticeBoardID}}"><i class="mdi mdi-eye align-middle me-1"></i></a> 

                                            <a href="{{URL('/NoticeBoardEdit/').'/'.$value->NoticeBoardID}}"><i class="bx bx-pencil align-middle me-1"></i></a> 

                                            <a href="#" onclick="delete_confirm2('NoticeBoardDelete',{{$value->NoticeBoardID}})"><i class="bx bx-trash  align-middle me-1"></i></a></td>
                                         </tr>
                                        
                                         @endforeach  
                                          @else
                                           
                                         <tr>
                                             <td colspan="6" class="bg bg-light text-center">
                                           No data found      
                                             </td>
                                         @endif
                                         </tr> 
                                         </tbody>
                                         </table>
                                           
                                        
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->



                       
<div class="row">
    

<div class="col-md-12">
    
    <div class="card">
        <div class="card-body">
            <!-- enctype="multipart/form-data" -->
            <form action="{{URL('/NoticeBoardSave')}}" method="post"> 

            {{csrf_field()}} 


              <div class="col-md-12">
            <div class="mb-3">
            <label for="basicpill-firstname-input">Title</label>
            <input type="text" class="form-control" name="Title" value="{{old('Title')}} ">
            </div>
            </div>
            
            <div class="col-md-12">
            <div class="mb-3">
             <textarea id="verticalnav-address-input" class="form-control" rows="10" name="Detail"></textarea>
              <script src="{{URL('/assets/js/tinymce.min.js')}}"></script>
      <script id="rendered-js" >
tinymce.init({
  selector: 'textarea',
  height: 500,
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
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ],
});
//# sourceURL=pen.js
    </script>


            </div>
            </div>
            

        <div class="row">
                      <div class="col-md-2">
             <div class="mb-3">
                <label for="basicpill-firstname-input">Status</label>
                 <select name="Status" id="Status" class="form-select">
                <option value="">Select</option>
                <option value="Draft" selected>Draft</option>
                <option value="Publish">Publish</option>
            
              </select>
              </div>
               </div>

                 <div class="col-md-2">
              <div class="mb-3">
              <label for="basicpill-firstname-input"> Date *</label>                                   
             <div class="input-group" id="datepicker2">
              <input type="text" name="Date" autocomplete="off" class="form-control" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy" data-date-container="#datepicker2" data-provide="datepicker" data-date-autoclose="true" value="{{date('d/m/Y')}}">
              <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                </div>
             </div>
            </div>

            <div class="col-md-2 mt-4">
            <div><button type="submit" class="btn btn-success w-md float-right">Save </button>
                 
            </div>
            </div>


            
          
        </div>
            
            
            


        </form>
        </div>
    </div>
    
</div>

</div>



                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection