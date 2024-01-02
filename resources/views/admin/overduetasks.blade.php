@include('admin/header')
@include('admin/navbar')

@php(date_default_timezone_set('Asia/Manila'))

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Overdue Tasks List</h4>
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
                                                    <th>Task Name</th>
                                                    <th>Borrower</th>
                                                    <th>Requestor</th>
                                                    <th>Loan Coordinator</th>
                                                    <th>Date Started</th>
                                                    <th>Days passed from interval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php ($x = 0)
                                                @foreach ($data as $overduetasks)
                                                    <tr>
                                                        <td><a href="loaninformation/{{$overduetasks->id}}">{{ $overduetasks->loan_number }}</a></td>
                                                        <td>{{ $overduetasks->branch_name }}</td>
                                                        <td>{{ $overduetasks->task_name }}</td>
                                                        <td>{{ $overduetasks->borrower }}</td>
                                                        <td>{{ $overduetasks->requestor }}</td>
                                                        <td>{{ $coordinatorslist[$x] }}</td>
                                                        <td>{{ date('F d, Y',strtotime($overduetasks->start)) }}</td>
                                                        <td style="color: red;">{{ date_diff(new DateTime(), new DateTime(date('F d, Y',strtotime($overduetasks->start))))->format('%d days') }}</td>
                                                    </tr>
                                                    @php($x++)
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
