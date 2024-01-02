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
                                    <h4>Branch List</h4>
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
                                                    <th>Branch Name</th>
                                                    <th>Address</th>
                                                    <th>Contact Number</th>
                                                    <th>Overdue Interval</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($collection as $item)
                                                    <tr>
                                                        <td>{{ $item->branch_name }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->contact_number }}</td>
                                                        <td>{{ $item->overdue_interval }}</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <a href="/branchedit/{{$item->id}}">
                                                                        <button class="btn btn-md btn-success btn-round"><i class="feather icon-edit"></i>Edit</button>
                                                                    </a>
                                                                    <button class="btn btn-md btn-danger btn-round branchdelete" id="{{$item->id}}"><i class="feather icon-edit"></i>Delete</button>
                                                                </div>     
                                                            </div>
                                                        </td>
                                                    </tr>    
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
