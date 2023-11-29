<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{URL('/Dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                  
                </li>

                <li>
                    <a href="{{URL('/Employee')}}" class="waves-effect">
                        <i class="bx bxs-user-plus"></i>
                        <span key="t-calendar">Employee</span>
                    </a>
                </li> 
                
               

               


              


                <li>
                    <a href="{{URL('/AttendanceImport')}}" class="waves-effect">
                        <i class="mdi mdi-database-import-outline"></i>
                        <span key="t-calendar">Import Attendance</span>
                    </a>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-dollar-circle"></i>
                        <span key="t-ecommerce">Salary Section</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{URL('/Salary')}}" key="t-products">Make Salary</a></li>
                        <li><a href="{{URL('/ViewSalary')}}" key="t-products">Search Salary</a></li>
                          
                     
                    </ul>
                </li>
                
                <li>
                    <a href="{{URL('/Document')}}" class="waves-effect">
                        <i class="mdi mdi-database-import-outline"></i>
                        <span key="t-calendar">All Documents </span>
                    </a>
                </li> 

                <li>
                    <a href="{{URL('/Fleet')}}" class="waves-effect">
                        <i class="mdi mdi-car"></i>
                        <span key="t-calendar">Fleet Management </span>
                    </a>
                </li> 

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-hammer-wrench"></i>
                        <span key="t-ecommerce">Setting</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{URL('/Branches')}}" key="t-products">Branch</a></li>
                        
                        <li><a href="{{URL('/DocumentCategory')}}" key="t-products">Document Category</a></li>
                         <li><a href="{{URL('/Departments')}}" key="t-products">Departments</a></li>
                        <li><a href="{{URL('/JobTitle')}}" key="t-products">Job Title</a></li>
                         <li><a href="{{URL('/Letter')}}" key="t-products">Letter Templates</a></li>
                         <li><a href="{{URL('/Team')}}" key="t-products">Team Structure</a></li>
                         <li><a href="{{URL('/Users')}}" key="t-products">Users</a></li> 
                         <!-- <li><a href="{{URL('/Role')}}" key="t-products">User Rights & Control</a></li>  -->

                     
                    </ul>
                </li>

               <li>
                    <a href="{{URL('/DailyReport')}}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-calendar">Daily Report</span>
                    </a>
                </li>

    <li>
                    <a href="{{URL('/NoticeBoard')}}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-calendar">Notice Board</span>
                    </a>
                </li>


                    <li>
                    <a href="{{URL('/Company')}}" class="waves-effect">
                        <i class="bx bx-file"></i>
                        <span key="t-calendar">Company</span>
                    </a>
                </li>

       

                <li>
                    <a href="{{URL('/logout')}}" class="waves-effect">
                        <i class="bx bx-power-off"></i>
                        <span key="t-calendar">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>