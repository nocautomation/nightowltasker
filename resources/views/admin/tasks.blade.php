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
                                    <h4>Tasks</h4>
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
                                                    <th>Satus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php ($x = 0)
                                                @foreach ($data as $tasks)
                                                    <tr>
                                                        <td><a href="loaninformation/{{$tasks->loan}}">{{ $tasks->loan_number }}</a></td>
                                                        <td>{{ $tasks->branch_name }}</td>
                                                        <td>{{ $tasks->task_name }}</td>
                                                        <td>{{ $tasks->borrower }}</td>
                                                        <td>{{ $tasks->requestor }}</td>
                                                        <td>{{ $coordinatorslist[$x] }}</td>
                                                        <td>{{ date('F d, Y, g:i a',strtotime($tasks->start)) }}</td>
                                                        <td>
                                                            @if (!@empty($tasks->end))
                                                                Completed
                                                            @else
                                                                <button class="btn btn-md btn-warning btn-round completetask" id="{{$tasks->id}}">Mark as complete</button>
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
