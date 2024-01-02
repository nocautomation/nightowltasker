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
                                    <h4>Branch Edit</h4>
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
                                    <h4 class="sub-title">Branch Information</h4>
                                    <form method="POST" action="/editbranch">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Branch Name</label>
                                            <div class="col-sm-4">
                                                <input type="hidden" name="branchid" value="{{$data->id}}">
                                                <input type="text" name="branchName" class="form-control" value="{{$data->branch_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Address Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="addressName" class="form-control" value="{{$data->address}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Contact Number</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="contact_number" class="form-control" value="{{$data->contact_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Overdue Interval</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="overdue_interval" class="form-control" value="{{$data->overdue_interval}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-5"></div>
                                            <div class="col-sm-7" style="margin-top: 20px">
                                                <button class="btn btn-md btn-success btn-round" style="padding: 10px 40px;" type="submit">Submit</button>
                                                <button class="btn btn-md btn-danger btn-round" style="padding: 10px 40px;"><a href="/dashboard" style="color: white">Cancel</a></button>
                                            </div>
                                        </div>
                                    </form>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
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
