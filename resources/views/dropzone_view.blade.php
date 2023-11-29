<html>
<head>
    <title>Drag and Drop File Upload Using Dropzone JS in Laravel 8 - Techsolutionstuff</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Drag and Drop File Upload Using Dropzone JS in Laravel 8 - Techsolutionstuff</h1><br>
            <form action="{{route('dropzone.store')}}" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="image-upload">
                {{csrf_field()}}
                <div>
                <h3 class="text-center">Upload Multiple Images</h3>
            </div>    
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
        Dropzone.options.imageUpload = {
            maxFilesize: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        };
</script>
</body>
</html>