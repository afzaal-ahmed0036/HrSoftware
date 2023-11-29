

    <div class="col-md-4">
 <div class="mb-3">
    <label for="basicpill-firstname-input" >Select Month</label>
     <select name="MonthName" id="MonthName" class="form-select" required="">
    <option value="">Select</option>

     @foreach($MonthName as $value)
      <option value="{{$value->MonthName}}"  >{{$value->MonthName}}</option>
     @endforeach
    
 </div>
  </select>
  </div>
   </div>




   

