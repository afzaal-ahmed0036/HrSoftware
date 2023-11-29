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
                                    <h4 class="mb-sm-0 font-size-18">EU Calculation</h4>

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                         <!-- button will appear here -->
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->


@php

$result=eu($eu[0]->No,$eu[0]->Sum,$eu[0]->NetDeposit,$eu[0]->FTD,$eu[0]->Per,$eu[0]->Total);



           



@endphp


                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>

                                       <table class="table table-sm align-middle table-nowrap mb-0">
                                       <tbody><tr>
                                       <th scope="col"></th>
                                       <th scope="col"></th>
                                       <th scope="col" class="bg bg-secondary bg-soft">Comission 1</th>
                                       <th scope="col" class="bg bg-secondary bg-soft">Comission 2</th>
                                       <th scope="col" class="bg bg-secondary bg-soft">Comission 3</th>
                                       <th scope="col"  class="bg bg-secondary bg-soft"></th>
                                       
                                       </tr>
                                       </tbody>
                                       <tbody>
                                        
                                        <tr>
                                        <td class="col-md-1 bg bg-secondary bg-soft "> <strong>No</strong></td>
                                        <td class="col-md-1">{{$eu[0]->No}}</td>
                                        <td class="col-md-1 "> {{number_format($result['comission1'],2)}}</td>
                                        <td class="col-md-1"> {{number_format($result['comission2'],2)}}</td>
                                        <td class="col-md-1"> {{number_format($result['comission3'],2)}}</td>
                                        <td class="col-md-1"> </td>
                                        </tr>
                                        <tr>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>Sum</strong></td>
                                        <td class="col-md-1"> {{number_format($eu[0]->Sum,2)}}</td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        </tr>
                                         <tr>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>Net Deposite</strong></td>
                                        <td class="col-md-1"> {{number_format($eu[0]->NetDeposit,2)}}</td>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>USD</strong></td>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>EUR</strong></td>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>RON</strong></td>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>AED</strong></td>
                                        </tr> 
                                        <tr>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>Quick nr FTD</strong></td>
                                        <td class="col-md-1">{{number_format($eu[0]->FTD,2)}} </td>
                                        <td class="col-md-1"> {{number_format($result['USD'],2)}}</td>
                                        <td class="col-md-1"> {{number_format($result['EUR'],2)}}</td>
                                        <td class="col-md-1"> {{number_format($result['RON'],2)}}</td>
                                        <td class="col-md-1"> {{number_format($result['AED'],2)}}</td>
                                       
                                        </tr> 
                                        <tr>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>SUM</strong></td>
                                        <td class="col-md-1">{{number_format($eu[0]->Per,2)}} </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        </tr>
                                         <tr>
                                        <td class="col-md-1 bg bg-secondary bg-soft"> <strong>TOTAL</strong></td>
                                        <td class="col-md-1">{{number_format($eu[0]->Total,2)}}</td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
                                        <td class="col-md-1"> </td>
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

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection