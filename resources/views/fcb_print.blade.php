<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="shortcut icon" href="{{URL('/')}}/assets/images/favicon.ico">

        <!-- Bootstrap Css -->
         <!-- Icons Css -->
         <!-- App Css-->
         <style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
}
-->
         </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body  >
  <div class="main-content">

                <div class="page-content">
                    <div class="container">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                  

                                    <div class="page-title-right "><div class="page-title-right text-danger"><div align="center">
                    <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td colspan="2"><div align="center"><img src="{{URL('/uploads/'.$branch[0]->BranchLogo)}}" width="222" height="61"></div></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="2"><div align="center">                                                  <span class="mb-sm-0 font-size-18 style1">Deposit Detail</span></div></td>
                                              </tr>
                                              <tr>
                                                <td>Deposit Detail for <strong>[{{$MonthName}}]</strong> </td>
                                                <td><div align="right">Branch Name: <strong>{{$branch[0]->BranchName}}</strong> <br> Print Date: <strong>{{date('d-m-Y G:i:s')}}</strong></div></td>
                                              </tr>
                                            </table>
                                          </div>
                                        </div>
                                  </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-md-12">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3">
                    
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
                                        <h4 class="card-title mb-4"> </h4>

 
<div class="row">
                                         
                                        </div>
                                     <center>
                                        @if(count($fcb) >0) 
                                        <div class="table-responsive">
  <table   style="border-collapse: collapse; width: 95%" border="1">                                                <tbody><tr>
                                                    <th scope="col" >S.No</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Agent</th>
                                                    <th scope="col"><div align="right">FTD Amount</div></th>
                                                    <th scope="col"><div align="right">Date</div></th>
                                                    <th scope="col"><div align="center">Compliant</div></th>
                                                    <th scope="col"><div align="center">KYC Sent</div></th>
                                                    <th scope="col">Dialer</th>
                                                    
                                                   </tr>
                                                </tbody><tbody>
                                               <?php $i=1; ?>
                                               @foreach($fcb as $value)
                                                    <tr>
                                                        <td class="col-md-1"><div align="center">{{$i}}.</div></td>
                                                         
                                                        <td class="col-md-1"><div align="center">{{$value->ID}}</div></td>
                                                        <td class="col-md-2">{{$value->FirstName}} {{$value->MiddleName}} {{$value->LastName}}</td>
                                                        <td class="col-md-1"><div align="right">{{number_format($value->FTDAmount,2)}}</div></td>
                                                        <td class="col-md-1"><div align="right">{{$value->Date}}</div></td>
                                                        <td class="col-md-2"><div align="center">{{$value->Compliant}}</div></td>
                                                        <td class="col-md-2"><div align="center">{{$value->KYCSent}}</div></td>
                                                        <td class="col-md-1"><div align="center">{{$value->Dialer}}</div></td>
                                                    </tr>
                                                   <?php $i++; ?>
                                                    @endforeach

                                                     

                                                   
                                                </tbody>
                                            </table>
                                            
                                              
                                        </div>
                                        @endif
                                      </center>
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

</body>
</html>