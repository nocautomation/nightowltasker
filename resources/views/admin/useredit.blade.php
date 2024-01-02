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
                                    <h4>Edit User</h4>
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
                                    <h4 class="sub-title">User Information</h4>
                                    <form method="POST" action="/edituser" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-4">
                                                <input type="hidden" name="userid" value="{{$data->id}}">
                                                <input type="text" name="first_name" id="firstname" class="form-control" value="{{$data->first_name}}" >
                                            </div>
                                            <label class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="last_name" class="form-control" value="{{$data->last_name}}" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control" value="{{$data->email}}" >
                                            </div>
                                            <label class="col-sm-2 col-form-label">Branch</label>
                                            <div class="col-sm-4">
                                                <select name="branch" class="form-control" >
                                                    <option></option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}" @if($branch->id == $data->branch) selected @endif>{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">User Role</label>
                                            <div class="col-sm-4">
                                                <select name="userrole" class="form-control">
                                                    <option></option>
                                                    <option value="1" @if($data->user_type == 1) selected @endif>Loan Coordinator</option>
                                                    <option value="2" @if($data->user_type == 2) selected @endif>Loan Officer Assistant</option>
                                                    <option value="0" @if($data->user_type == 0) selected @endif>Admin</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Avatar</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="avatar" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-5"></div>
                                            <div class="col-sm-7" style="margin-top: 20px">
                                                <button class="btn btn-md btn-success btn-round" style="padding: 10px 40px;" type="submit">Submit</button>
                                                <button class="btn btn-md btn-danger btn-round" style="padding: 10px 40px;"><a href="/dashboard" style="color: white">Cancel</a></button>
                                        </div>
                                    </form>
                                </div>
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

@include('admin/footer')
