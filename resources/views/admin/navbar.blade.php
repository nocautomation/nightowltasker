<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header"> 
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="/dashboard">
                         Tasker
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-right">
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <span>{{session('name')}}</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    {{-- <li>
                                        <a href="#!">
                                            <i class="feather icon-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="user-profile.htm">
                                            <i class="feather icon-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="feather icon-lock"></i> Change Password
                                        </a>
                                    </li> --}}
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <li id="logout">
                                            <i class="feather icon-log-out"></i> Logout
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
 
            <!-- Sidebar inner chat end-->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar" >
            <div class="pcoded-inner-navbar main-menu">
                <div class="pcoded-navigatio-lavel">Navigation</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class=" ">
                        <a href="/dashboard">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu active pcoded">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                            <span class="pcoded-mtext">User Management</span>
                        </a>
                        <ul class="pcoded-submenu">
                            @if (session('user_type') == 0 || session('user_type') == 2)
                            <li class=" ">
                                <a href="/newuser">
                                    <i class="feather icon-user-plus" style="margin-right:10px;"></i>
                                    <span class="pcoded"> Add User </span>
                                </a>
                            </li>
                            @endif
                            <li class=" ">
                                <a href="/userlist">
                                    <i class="feather icon-user-check" style="margin-right:5px;"></i> 
                                    <span class="pcoded"> User List </span>                                            
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu active pcoded">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-share-2"></i></span>
                            <span class="pcoded-mtext">Branch Management</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="/newbranch">
                                    <i class="feather icon-shuffle" style="margin-right:10px;"></i>
                                    <span class="pcoded"> Add Branch </span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="/branchlist">
                                    <i class="feather icon-layers" style="margin-right:5px;"></i> 
                                    <span class="pcoded"> Branch List </span>                                            
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu active pcoded">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-list"></i> </span>
                            <span class="pcoded-mtext">Loan Management</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="/newloan">
                                    <i class="feather icon-file-plus" style="margin-right:10px;"></i>
                                    <span class="pcoded"> New Loan</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="/loanlist">
                                    <i class="feather icon-file-text" style="margin-right:10px;"></i>
                                    <span class="pcoded"> List of Loans</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu active pcoded">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-file-text"></i> </span>
                            <span class="pcoded-mtext">Order Outs</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="/orderoutnamelist">
                                    <i class="feather icon-file-plus" style="margin-right:10px;"></i>
                                    <span class="pcoded"> Order outs name list</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="/orderouts">
                                    <i class="feather icon-file-text" style="margin-right:10px;"></i>
                                    <span class="pcoded"> List of Order Outs</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="/overdueorderouts">
                                    <i class="feather icon-external-link" style="margin-right:10px;"></i>
                                    <span class="pcoded"> Overdue Order Outs</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu active pcoded">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-airplay"></i> </span>
                            <span class="pcoded-mtext">Tasks</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="/tasknamelist">
                                    <i class="feather icon-file-plus" style="margin-right:10px;"></i>
                                    <span class="pcoded"> Tasks name list</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="/tasks">
                                    <i class="feather icon-file-text" style="margin-right:10px;"></i>
                                    <span class="pcoded"> List of Tasks</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="/overduetasks">
                                    <i class="feather icon-external-link" style="margin-right:10px;"></i>
                                    <span class="pcoded"> Overdue Tasks</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="pcoded-item pcoded-left-item">
                    <li class=" ">
                        <a href="/reports">
                            <span class="pcoded-micon"><i class="feather icon-bar-chart-2"></i></span>
                            <span class="pcoded-mtext">Reports</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
   