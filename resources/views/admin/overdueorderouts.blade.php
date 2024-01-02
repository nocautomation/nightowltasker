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
                                    <h4>Overdue Order Outs List</h4>
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
                                                    <th>Order Out Name</th>
                                                    <th>Borrower</th>
                                                    <th>Requestor</th>
                                                    <th>Loan Coordinator</th>
                                                    <th>First</th>
                                                    <th>Second</th>
                                                    <th>Third</th>
                                                    <th>Days passed from interval</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php ($x = 0)
                                                @foreach ($data as $overdueorderout)
                                                    <tr>
                                                        <td><a href="/loaninformation/{{$overdueorderout->id}}">{{ $overdueorderout->loan_number }}</a></td>
                                                        <td>{{ $overdueorderout->branch_name }}</td>
                                                        <td>{{ $overdueorderout->orderouts_name }}</td>
                                                        <td>{{ $overdueorderout->borrower }}</td> 
                                                        <td>{{ $overdueorderout->requestor }}</td>
                                                        <td>{{ $coordinatorslist[$x] }}</td>
                                                        <td>
                                                            @if (!empty($overdueorderout->first))
                                                                {{ date('F d, Y',strtotime($overdueorderout->first)) }}
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            @if (!empty($overdueorderout->second))
                                                                {{ date('F d, Y',strtotime($overdueorderout->second)) }}
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            @if (!empty($overdueorderout->third))
                                                                {{ date('F d, Y',strtotime($overdueorderout->third)) }}
                                                            @endif
                                                            
                                                        </td>
                                                        <td style="color: red;">
                                                            @if (!empty($overdueorderout->third))
                                                                {{ date_diff(new DateTime(), new DateTime(date('F d, Y',strtotime($overdueorderout->third))))->format('%d days') }}

                                                                @else
                                                                    @if (!empty($overdueorderout->second))
                                                                        {{ date_diff(new DateTime(), new DateTime(date('F d, Y',strtotime($overdueorderout->second))))->format('%d days') }}
                                                                    @else
                                                                        {{ date_diff(new DateTime(), new DateTime(date('F d, Y',strtotime($overdueorderout->first))))->format('%d days') }}
                                                                    @endif
                                                            @endif
                                                        </td>
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
