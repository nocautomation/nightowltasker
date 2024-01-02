@include('admin/header')
@include('admin/navbar')

<?php
date_default_timezone_set('America/Los_Angeles');
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
    
                        <div class="col-xl-3 col-md-6">
                            <a href="/userlist">
                                <div class="card bg-c-lite-green update-card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                        <div class="col">
                                         <p class="m-b-5">Users</p>
                                        <h4 class="m-b-0">{{$data['users']}}</h4>
                                        </div>
                                        <div class="col col-auto text-right">
                                        <i class="feather icon-user f-60 text-c-lite-green"></i>
                                        </div>
                                        </div>
                                        </div>
                                    <div class="card-footer">
                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : {{date('Y/m/d H:i:s')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <a href="/loanlist">
                                <div class="card bg-c-green update-card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                        <div class="col">
                                         <p class="m-b-5">Loans</p>
                                        <h4 class="m-b-0">{{$data['loans']}}</h4>
                                        </div>
                                        <div class="col col-auto text-right">
                                        <i class="feather icon-list f-60 text-c-green"></i>
                                        </div>
                                        </div>
                                        </div>
                                    <div class="card-footer">
                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : {{date('Y/m/d H:i:s')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <a href="/branchlist">
                                <div class="card bg-c-blue update-card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                        <div class="col">
                                         <p class="m-b-5">Branches</p>
                                        <h4 class="m-b-0">{{$data['branches']}}</h4>
                                        </div>
                                        <div class="col col-auto text-right">
                                        <i class="feather icon-share-2 f-60 text-c-blue"></i>
                                        </div>
                                        </div>
                                        </div>
                                    <div class="card-footer">
                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : {{date('Y/m/d H:i:s')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <a href="/overduetasks">
                                <div class="card bg-c-pink update-card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                        <div class="col">
                                         <p class="m-b-5">Over Due Tasks</p>
                                        <h4 class="m-b-0">{{$data['overduetasks']}}</h4>
                                        </div>
                                        <div class="col col-auto text-right">
                                        <i class="feather icon-alert-triangle f-60 text-c-pink"></i>
                                        </div>
                                        </div>
                                        </div>
                                    <div class="card-footer">
                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : {{date('Y/m/d H:i:s')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <a href="/overdueorderouts">
                                <div class="card bg-c-yellow update-card">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                        <div class="col">
                                         <p class="m-b-5">Over Due Order Outs</p>
                                        <h4 class="m-b-0">{{$data['overdueorderouts']}}</h4>
                                        </div>
                                        <div class="col col-auto text-right">
                                        <i class="feather icon-alert-circle f-60 text-c-yellow"></i>
                                        </div>
                                        </div>
                                        </div>
                                    <div class="card-footer">
                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : {{date('Y/m/d H:i:s')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin/footer')
