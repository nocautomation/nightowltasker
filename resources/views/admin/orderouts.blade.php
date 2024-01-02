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
                                    <h4>Order Outs</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div>
                                <form action="/filteredorderouts" method="POST">
                                    @csrf
                                    <select class="form-control form-control-inverse filterstatus" style="float: right; width: 170px; height: 40px;" name="status">
                                        <option value="" disabled selected>Filter status here</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Ordered">Ordered</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Waiting on Processor">Waiting on Processor</option>
                                        <option value="Waiting on Borrower" >Waiting on Borrower</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Withdrawn"> Withdrawn</option>
                                        <option value="Closing Stage">Closing Stage</option>
                                    </select>
                                </form>
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
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php ($x = 0)
                                                @foreach ($data as $orderout)
                                                    <tr>
                                                        <td><a href="/loaninfo/{{ $orderout->loan_number}}">{{ $orderout->loan_number }}</a></td>
                                                        <td>{{ $orderout->branch_name }}</td>
                                                        <td>{{ $orderout->orderouts_name }}</td>
                                                        <td>{{ $orderout->borrower }}</td> 
                                                        <td>{{ $orderout->requestor }}</td>
                                                        <td contenteditable="true">{{ $coordinatorslist[$x] }}</td>
                                                        <td>
                                                            @if (!empty($orderout->first))
                                                                {{ date('F d, Y, g:i a',strtotime($orderout->first)) }}
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            @if (!empty($orderout->second))
                                                                {{ date('F d, Y, g:i a',strtotime($orderout->second)) }}
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            @if (!empty($orderout->third))
                                                                {{ date('F d, Y, g:i a',strtotime($orderout->third)) }}
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            <select name="select" class="form-control form-control-inverse orderoutstatus" style="width: 150px; height: 20px;" id={{$orderout->id}}>
                                                                <option value="" disabled selected>Please select status here</option>
                                                                <option value="Completed" @if($orderout->status == 'Completed') selected @endif>Completed - {{date('F j, Y');}}</option>
                                                                <option value="Ordered" @if($orderout->status == 'Ordered') selected @endif>Ordered</option>
                                                                <option value="Pending" @if($orderout->status == 'Pending') selected @endif>Pending</option>
                                                                <option value="Waiting on Processor" @if($orderout->status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                <option value="Waiting on Borrower" @if($orderout->status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                <option value="Cancelled" @if($orderout->status == 'Cancelled') selected @endif>Cancelled</option>
                                                                <option value="Withdrawn" @if($orderout->status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                <option value="Closing Stage" @if($orderout->status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                            </select>
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
