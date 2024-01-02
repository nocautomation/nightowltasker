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
                                    <h4>New Loan</h4>
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
                                    <h4 class="sub-title">Loan Information</h4>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="/addloantest" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Loan Number</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <input type="text" class="form-control" name="loannumber" value="{{old('loannumber')}}">
                                            </div>
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Branch</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <select name="branch" id="branch" class="form-control" >
                                                    <option></option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Requestor</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <input type="text" class="form-control" name="requestor" value="{{old('requestor')}}">
                                            </div>
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Assigned Loan Coordinator</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <select class="js-example-basic-multiple col-sm-12 select2-hidden-accessible" name="coordinator[]" id="coordinator" multiple="" tabindex="-1" aria-hidden="true" disabled>
                                                    <option value="" disabled></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Borrower's Name</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <input type="text" name="borrower" value="{{old('borrower')}}" class="form-control">
                                            </div>
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Remarks</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <textarea rows="2" cols="5" name="loanremarks" value="{{old('remarks')}}" class="form-control" placeholder="Remarks"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Scrub</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-success btn-round" id="scrubstart" style="padding: 0.4rem 1.7rem;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="scrubstart" id="datetimescrubstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-danger btn-round" id="scrubend" style="padding: 0.4rem 1.7rem;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="scrubend" id="datetimescrubend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">File Setup</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-success btn-round" id="filesetupstart" style="padding: 0.4rem 1.7rem;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="filesetupstart" id="datetimefilesetupstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-danger btn-round" id="filesetupend" style="padding: 0.4rem 1.7rem;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="filesetupend" id="datetimefilesetupend"  class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Disclosure</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-success btn-round" id="disclosurestart" style="padding: 0.4rem 1.7rem;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="disclosurestart" id="datetimedisclosurestart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-danger btn-round" id="disclosureend" style="padding: 0.4rem 1.7rem;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="disclosureend" id="datetimedisclosureend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Appraisal</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-success btn-round" id="appraisalstart" style="padding: 0.4rem 1.7rem;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="appraisalstart" id="datetimeappraisalstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-danger btn-round" id="appraisalend" style="padding: 0.4rem 1.7rem;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="appraisalend" id="datetimeappraisalend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">FasTrack Disclosure</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-success btn-round" id="fastrackdisclosurestart" style="padding: 0.4rem 1.7rem;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="fastrackdisclosurestart" id="datetimeftdisclosurestart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastrackdisclosureend" style="padding: 0.4rem 1.7rem;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="fastrackdisclosureend" id="datetimeftdisclosureend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">FasTrack Submission</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-success btn-round" id="fastracksubmissionstart" style="padding: 0.4rem 1.7rem;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="fastracksubmissionstart" id="datetimeftsubmissionstart" class="form-control" step="any">
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastracksubmissionend" style="padding: 0.4rem 1.7rem;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="datetime-local" name="fastracksubmissionend" id="datetimeftsubmissionend" class="form-control" step="any">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clone-rightside-btn-1">
                                            <div class="row toclone">
                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="input-group">
                                                        <select name="orderout[]" class="form-control">
                                                            <option value="" disabled selected>Order outs</option>
                                                            <option value="EOI">Completed</option>
                                                            <option value="Master Insurance">Master Insurance</option>
                                                            <option value="Flood Insurance">Flood Insurance</option>
                                                            <option value="Mortgage Payoff">Mortgage Payoff</option>
                                                            <option value="Collection Payoff">Collection Payoff</option>
                                                            <option value="Credit Supplement">Credit Supplement</option>
                                                            <option value="VVOE">VVOE</option>
                                                            <option value="WVOE Borrower 1">WVOE Borrower 1</option>
                                                            <option value="WVOE Borrower 2">WVOE Borrower 2</option>
                                                            <option value="WVOE Borrower 3">WVOE Borrower 3</option>
                                                            <option value="WVOE Co-borrower 1">WVOE Co-borrower 1</option>
                                                            <option value="WVOE Co-borrower 2">WVOE Co-borrower 2</option>
                                                            <option value="WVOE Co-borrower 3">WVOE Co-borrower 3</option>
                                                            <option value="Tax Transcript">Tax Transcript</option>
                                                            <option value="Pest Inspection">Pest Inspection</option>
                                                            <option value="24 Payment-VOM">24 Payment-VOM</option>
                                                            <option value="Title Docs">Title Docs</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">1st</span>
                                                        <input type="datetime-local" name="first[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                        <input type="datetime-local" name="second[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                        <input type="datetime-local" name="third[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="input-group">
                                                        <select name="status[]" class="form-control">
                                                            <option value="" disabled selected>Status</option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="Ordered">Ordered</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Waiting on Processor">Waiting on Processor</option>
                                                            <option value="Waiting on Borrower">Waiting on Borrower</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                            <option value="Withdrawn">Withdrawn</option>
                                                            <option value="Closing Stage">Closing Stage</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 col-sm-12 col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group">
                                                            <input type="text" name="remarks[]" class="form-control" placeholder="Remarks">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-1 col-md-12 col-sm-12 clone">
                                                    <button type="button" class="btn btn-primary float-end" style="height: 2.3rem;">
                                                        <i class="icofont icofont-plus"></i>
                                                    </button>
                                                </div>
                                                
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-5"></div>
                                            <div class="col-sm-7">
                                                <button class="btn btn-md btn-success btn-round" style="padding: 10px 40px;" type="submit">Submit</button>
                                                <button class="btn btn-md btn-danger btn-round" style="padding: 10px 40px;"><a href="/dashboard" style="color: white">Cancel</a></button>
                                        </div>
                                    </div>
                                    </form>
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
