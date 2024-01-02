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
                                    <h4>New User</h4>
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
                                    <form method="POST" action="/adduser" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="first_name" id="firstname" class="form-control" value="{{old('first_name')}}" >
                                            </div>
                                            <label class="col-sm-2 col-form-label">Last Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="email" name="email" class="form-control" value="{{old('email')}}" >
                                            </div>
                                            <label class="col-sm-2 col-form-label">Branch</label>
                                            <div class="col-sm-4">
                                                <select name="branch" class="form-control" >
                                                    <option></option>
                                                    @foreach ($collection as $item)
                                                        <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-4">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Confirmed Password</label>
                                            <div class="col-sm-4">
                                                <input type="password" name="password_confirmation" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">User Role</label>
                                            <div class="col-sm-4">
                                                <select name="userrole" class="form-control">
                                                    <option></option>
                                                    <option value="1" >Loan Coordinator</option>
                                                    <option value="0">Admin</option>
                                                    <option value="2">Loan Officer Assistant</option>
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
