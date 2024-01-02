@include('admin/header')
@include('admin/navbar')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Loans List</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="order-table" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Loan Number</th>
                                                    <th>Branch</th>
                                                    <th>Borrower</th>
                                                    <th>Requestor</th>
                                                    <th>Assigned Loan Coordinators</th>
                                                    <th>Remarks</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $x = 0;
                                                ?>
                                                @foreach ($loans as $loan)
                                                    
                                                    <tr>
                                                        <td> {{ $loan->loan_number }} </td>
                                                        <td> {{ $loan->branch_name }} </td>
                                                        <td> {{ $loan->borrower }} </td>
                                                        <td> {{ $loan->requestor }} </td>
                                                        <td> {{$coordinators[$x]}}</td>
                                                        <td> {{$loan->remarks}} </td>
                                                        <td> {{ date('F d, Y',strtotime($loan->date_created)) }} </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <a href="/loaninformation/{{$loan->id}}">
                                                                        <button class="btn btn-md btn-success btn-round"><i class="feather icon-edit"></i>Full Information</button>
                                                                    </a>
                                                                    <button class="btn btn-md btn-danger btn-round deleteloan" id="{{$loan->id}}"><i class="feather icon-edit"></i>Delete</button>
                                                                </div>     
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                        $x++;
                                                    ?> 
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin/footer')





