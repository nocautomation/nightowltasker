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
                                    <h4>Edit Loan Information</h4>
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
                                    <form method="POST" id="editloanform" action="/loanedit">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Loan Number</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="loannumber" value="{{$loan->loan_number}}">
                                                <input type="hidden" class="form-control" name="loanid" value="{{$loan->id}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Branch</label>
                                            <div class="col-sm-4">

                                                <?php 
                                                    
                                                $coordinators = explode(",", $loan->loan_coordinator)
                                                    
                                                ?>
                                                <select name="branch" id="branch" class="form-control" >   
                                                    @foreach($branches as $branch)
                                                        <option @if($branch->id == $loan->branch) selected @endif value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Requestor</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="requestor" value="{{$loan->requestor}}">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Assigned Loan Coordinator</label>
                                            <div class="col-sm-4">
                                                <select class="js-example-basic-multiple col-sm-12 select2-hidden-accessible" name="coordinator[]" id="coordinator" multiple="" tabindex="-1" aria-hidden="true">
                                                    @foreach($loancoordinators as $loancoordinator)
                                                        <option value="{{$loancoordinator->id}}" @for($x=0; $x < count($coordinators); $x++) @if($loancoordinator->id == $coordinators[$x]) selected @endif @endfor>{{$loancoordinator->first_name}} {{$loancoordinator->last_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Borrower's Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="borrower" value="{{$loan->borrower}}" class="form-control">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Remarks</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <textarea rows="2" cols="5" name="loanremarks" class="form-control" placeholder="Remarks">{{$loan->remarks}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-md-2 col-sm-12 col-form-label">Date Created</label>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <input type="text" readonly value="{{date('F j, Y, g:i a',strtotime($loan->date_created))}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Scrub")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Scrub</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="scrubstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="scrubstart" value="{{ $start }}" id="datetimescrubstart" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="scrubend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="scrubend" value="{{ $end }}" id="datetimescrubend" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "File Setup")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">File Setup</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="filesetupstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="filesetupstart" value="{{ $start }}" id="datetimefilesetupstart" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="filesetupend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="filesetupend" id="datetimefilesetupend" value="{{ $end }}"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Disclosure")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="disclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="disclosurestart" id="datetimedisclosurestart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="disclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="disclosureend" id="datetimedisclosureend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Appraisal")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Appraisal</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="appraisalstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="appraisalstart" id="datetimeappraisalstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="appraisalend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="appraisalend" id="datetimeappraisalend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "FasTrack Disclosure")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">FasTrack Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="fastrackdisclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastractdisclosurestart" id="datetimeftdisclosurestart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastrackdisclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastractdisclosureend" id="datetimeftdisclosureend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "FasTrack Submission")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">FasTrack Submission</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="fastracksubmissionstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastracksubmissionstart" id="datetimeftsubmissionstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="fastracksubmissionend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="fastracksubmissionend" id="datetimeftsubmissionend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "COC/CIC Disclosure")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">COC/CIC Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="cocdisclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="cocdisclosurestart" id="datetimecocdisclosurestart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="cocdisclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="cocdisclosureend" id="datetimecocdisclosureend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Conditional Review")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Conditional Review</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="conditionalreviewstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="conditionalreviewstart" id="datetimeconditionalreviewstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="conditionalreviewend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="conditionalreviewend" id="datetimeconditionalreviewend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Closing Disclosure")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Closing Disclosure</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="closingdisclosurestart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="closingdisclosurestart" id="datetimeclosingdisclosurestart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="closingdisclosureend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="closingdisclosureend" id="datetimeclosingdisclosureend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "In Escrow Review")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">In Escrow Review</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="inescrowreviewstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="inescrowreviewstart" id="datetimeinescrowreviewstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="inescrowreviewend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="inescrowreviewend" id="datetimeinescrowreviewend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "Pre-approval Review")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">Pre-approval Review</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="preapprovalreviewstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="preapprovalreviewstart" id="datetimepreapprovalreviewstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="preapprovalreviewend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="preapprovalreviewend" id="datetimepreapprovalreviewend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    @php
                                                       $start = ""; 
                                                       $end = ""; 
                                                    @endphp
                                                    @foreach ($tasks as $task)
                                                        @if ($task->task_name == "HTH Setup")
                                                            @php
                                                                $start = $task->start;
                                                                $end = $task->end;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    <label class="col-lg-2 col-md-8 col-sm-2 col-form-label">HTH Setup</label>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-success btn-round" id="hthsetupstart" style="padding: 10px 40px;" type="button">START</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="hthsetupstart" id="datetimehthsetupstart" value="{{ $start }}" class="form-control">
                                                    </div>
                                                    <div class="col-lg-2 col-md-8 col-sm-10">
                                                        <button class="btn btn-md btn-danger btn-round" id="hthsetupend" style="padding: 10px 40px;" type="button">END</button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-10">
                                                        <input type="datetime-local" name="hthsetupend" id="datetimehthsetupend" value="{{ $end }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clone-rightside-btn-1">
                                            @if(!empty($orderouts))
                                                @foreach ($orderouts as $orderout)
                                                <div class="row toclone">
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                        <div class="input-group">
                                                            <select name="orderout[]" class="form-control">
                                                                @for($x = 0; $x < count($orderslist); $x++)
                                                                    <option value="{{$orderslist[$x]}}" @if($orderslist[$x] == $orderout->orderouts_name) selected @endif>{{$orderslist[$x]}}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">1st</span>
                                                            <input type="datetime-local" value="{{$orderout->first}}" name="first[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">2nd</span>
                                                            <input type="datetime-local" value="{{$orderout->second}}" name="second[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="basic-addon1">3rd</span>
                                                            <input type="datetime-local" value="{{$orderout->third}}" name="third[]" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-12 col-sm-12">
                                                        <div class="input-group">
                                                            <select name="status[]" class="form-control">
                                                                <option value="Completed" @if($orderout->status == 'Completed') selected @endif>Completed - {{date('F j, Y, g:i a')}}</option>
                                                                <option value="Ordered" @if($orderout->status == 'Ordered') selected @endif>Ordered</option>
                                                                <option value="Pending" @if($orderout->status == 'Pending') selected @endif>Pending</option>
                                                                <option value="Waiting on Processor" @if($orderout->status == 'Waiting on Processor') selected @endif>Waiting on Processor</option>
                                                                <option value="Waiting on Borrower" @if($orderout->status == 'Waiting on Borrower') selected @endif>Waiting on Borrower</option>
                                                                <option value="Cancelled" @if($orderout->status == 'Cancelled') selected @endif>Cancelled</option>
                                                                <option value="Withdrawn" @if($orderout->status == 'Withdrawn') selected @endif> Withdrawn</option>
                                                                <option value="Closing Stage" @if($orderout->status == 'Closing Stage') selected @endif>Closing Stage</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 col-sm-12 col-md-12">
                                                        <div class="input-group">
                                                            <div class="input-group">
                                                                <input type="text" value="{{$orderout->remarks}}" name="remarks[]" class="form-control" placeholder="Remarks">
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-1 col-md-12 col-sm-12 clone">
                                                        <button type="button" class="btn btn-primary float-end" style="height: 2.3rem;">
                                                            <i class="icofont icofont-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                            @if(count($orderouts) <= 0)
                                            <div class="row toclone">
                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="input-group">
                                                        <select name="orderout[]" class="form-control">
                                                            <option value="" disabled selected>Order outs</option>
                                                            @for($x = 0; $x < count($orderslist); $x++)
                                                            <option value="
                                                                @php
                                                                    if($orderslist[$x] == 'Completed'){
                                                                        echo $orderslist[$x].' - '.date('F j, Y, g:i a');
                                                                    }
                                                                    else{
                                                                        echo $orderslist[$x];
                                                                    }
                                                                @endphp
                                                                ">@php
                                                                if($orderslist[$x] == 'Completed'){
                                                                    echo $orderslist[$x].' - '.date('F j, Y, g:i a');
                                                                }
                                                                else{
                                                                    echo $orderslist[$x];
                                                                }
                                                            @endphp</option>
                                                            @endfor
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
                                                            <option value="Completed">Completed - {{date('F j, Y, g:i a');}}</option>
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
                                            @endif 
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-5"></div>
                                            <div class="col-sm-7">
                                                <button class="btn btn-md btn-success btn-round" style="padding: 10px 40px;" type="button" id="editloanbtn">Submit</button>
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
