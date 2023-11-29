  
<a href="{{URL('/StaffNoticeBoard')}}">go back</a>

<table class="table table-sm align-middle table-nowrap mb-0">
                                        
                                         <tr >
                                         <th style="width: 600px;" > </th>
                                         <th style="width: 10px;" >Status</th>
                                        <th style="width: 10px;" >Date</th>
                                          </tr>
                                        
                                        <tbody>
                                         @if(!$notice->isEmpty())        
                                        @foreach ($notice as $key =>$value)
                                         <tr valign="top" >
                                          <td ><strong>{{$value->Title}}</strong></td>
                                         
                                         <td ><span class="badge  {{($value->Status=='Draft') ?'badge bg-warning' : 'bg-primary'}}">{{$value->Status}}</span></td>
                                         <td >{{dateformatman($value->Date)}}</td>
                                      
                                         
                                        
                                         </tr>
                                        <tr>
                                             <td><div style="width: 1000px !important; overflow: auto;" 
                                                ><?php echo   $value->Detail; ?></div></td>
                                            <td></td>
                                            <td></td>
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
