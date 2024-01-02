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
                                    <h4>User List</h4>
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
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Branch</th>
                                                    <th>Role</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($collection as $item)
                                                    <tr>
                                                        <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->branch_name }}</td>
                                                        <td>
                                                            @if($item->user_type == 1)
                                                                Loan Coordinator
                                                            @endif
                                                            @if($item->user_type == 2)
                                                                Processor
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <a href="/useredit/{{$item->id}}">
                                                                        <button class="btn btn-md btn-success btn-round"><i class="feather icon-edit"></i>Edit</button>
                                                                    </a>
                                                                    <button class="btn btn-md btn-danger btn-round userdelete" id="{{$item->id}}"><i class="feather icon-edit"></i>Delete</button></a>
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
