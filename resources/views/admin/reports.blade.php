@include('admin.header')
@include('admin.navbar')

<div class="pcoded-content">
	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-header">
					<div class="row align-items-end">
						<div class="col-lg-8">
							<div class="page-header-title">
								<div class="d-inline">
									<h4>Reports</h4>
									<span>Daily or monthly reports per branch/loan coordinators</span>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							{{-- <button class="btn btn-success btn-square float-right">Extract to Excel</button>
								<button class="btn btn-danger btn-square float-right" style="margin-right:1%">Extract to PDF</button> --}}
						</div>
					</div>
				</div>
    
				<div class="page-body">
					<div class="row">
						<div class="col-md-12 col-lg-10">
							<div class="card">
								<div class="card-header">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-8">
                                            <h5 id="monthlytaskstext">Tasks completed for the month of {{date("F")}} for {{$branchname}} branch</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select name="select" class="form-control" id="tasksmonths">
                                                <option value="01" @if($currentmonth == "01") selected @endif>January</option>
                                                <option value="02" @if($currentmonth == "02") selected @endif>February</option>
                                                <option value="03" @if($currentmonth == "03") selected @endif>March</option>
                                                <option value="04" @if($currentmonth == "04") selected @endif>April</option>
                                                <option value="05" @if($currentmonth == "05") selected @endif>May</option>
                                                <option value="06" @if($currentmonth == "06") selected @endif>June</option>
                                                <option value="07" @if($currentmonth == "07") selected @endif>July</option>
                                                <option value="08" @if($currentmonth == "08") selected @endif>August</option>
                                                <option value="09" @if($currentmonth == "09") selected @endif>September</option>
                                                <option value="10" @if($currentmonth == "10") selected @endif>October</option>
                                                <option value="11" @if($currentmonth == "11") selected @endif>November</option>
                                                <option value="12" @if($currentmonth == "12") selected @endif>December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select name="select" class="form-control" id="tasksbranchreport">
                                                @foreach ($branches as $branch)
                                                <option value="{{$branch->id}}" @if($firstbranch == $branch->id) selected @endif>{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
								</div>
								<div>
									<canvas id="monthlyTaskChart"></canvas>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-10">
							<div class="card">
								<div class="card-header">
									<div class="row">
                                        <div class="col-md-4 col-lg-8">
                                            <h5 id="monthlyorderoutstext">Order outs completed for the month of {{date("F")}} for {{$branchname}} branch</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select name="select" class="form-control" id="orderoutsmonths">
                                                <option value="01" @if($currentmonth == "01") selected @endif>January</option>
                                                <option value="02" @if($currentmonth == "02") selected @endif>February</option>
                                                <option value="03" @if($currentmonth == "03") selected @endif>March</option>
                                                <option value="04" @if($currentmonth == "04") selected @endif>April</option>
                                                <option value="05" @if($currentmonth == "05") selected @endif>May</option>
                                                <option value="06" @if($currentmonth == "06") selected @endif>June</option>
                                                <option value="07" @if($currentmonth == "07") selected @endif>July</option>
                                                <option value="08" @if($currentmonth == "08") selected @endif>August</option>
                                                <option value="09" @if($currentmonth == "09") selected @endif>September</option>
                                                <option value="10" @if($currentmonth == "10") selected @endif>October</option>
                                                <option value="11" @if($currentmonth == "11") selected @endif>November</option>
                                                <option value="12" @if($currentmonth == "12") selected @endif>December</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-lg-2">
                                            <select name="select" class="form-control" id="orderoutsbranchreport">
                                                @foreach ($branches as $branch)
                                                <option value="{{$branch->id}}" @if($firstbranch == $branch->id) selected @endif>{{$branch->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
								</div>
								<div>
									<canvas id="monthlyOrderOutsChart"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>


@include('admin.footer')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const ctx = document.getElementById('monthlyTaskChart');
    
    const monthlyTaskChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Scrub', 'Disclosure', 'File Setup', 'Appraisal', 'FasTrack Disclosure', 'FasTrack Submission'],
                                    datasets: [{
                                        label: 'Number of tasks processed',
                                        data: @json($monthlytasks),
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    indexAxis: 'y',
                                    scales: {
                                    x: {
                                        beginAtZero: true
                                    }
                                    }
                                }
                             })

    $('#tasksmonths').change(function(e){
        e.preventDefault();

        var month = $('#tasksmonths').find(":selected").val();
        var branch = $('#tasksbranchreport').find(":selected").val();

        $.ajax({
            url: '/branchandtasksmonthly',
            type: 'POST',
            data: {
                branch: branch,
                month: month
            },
            dataType: 'JSON',
            success: function(response){
                monthlyTaskChart.data.datasets[0].data = response['data'];
                monthlyTaskChart.update();
                $('#monthlytaskstext').text(response['datatext']);
            }
        });
    })

    $('#tasksbranchreport').change(function(e){
        e.preventDefault();

        var month = $('#tasksmonths').find(":selected").val();
        var branch = $('#tasksbranchreport').find(":selected").val();

        $.ajax({
            url: '/branchandtasksmonthly',
            type: 'POST',
            data: {
                branch: branch,
                month: month
            },
            dataType: 'JSON',
            success: function(response){
                monthlyTaskChart.data.datasets[0].data = response;
                monthlyTaskChart.update();
            }
        });
    })

    const ctx1 = document.getElementById('monthlyOrderOutsChart');
    
    const monthlyOrderOutsChart = new Chart(ctx1, {
                                        type: 'bar',
                                        data: {
                                            labels: ['EOI', 'Collection Payoff', 'Credit Supplement', 'Flood Insurance', 'Master Insurance', 'Mortgage Payoff', 'Payment VOM', 'Title Docs', 'Tax Transcript', 'VVOE', 'WVOE Borrower 1','WVOE Borrower 2','WVOE Borrower 3','WVOE Co-borrower 1','WVOE Co-borrower 2','WVOE Co-borrower 3', 'Pest Inspection'],
                                            datasets: [{
                                                label: 'Number of order outs processed ',
                                                data: @json($monthlyorderouts),
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            indexAxis: 'y',
                                            scales: {
                                            x: {
                                                beginAtZero: true
                                            }
                                            }
                                        }
                                    });

    $('#orderoutsmonths').change(function(e){
        e.preventDefault();

        var month = $('#orderoutsmonths').find(":selected").val();
        var branch = $('#orderoutsbranchreport').find(":selected").val();

        $.ajax({
            url: '/branchandorderoutsmonthly',
            type: 'POST',
            data: {
                branch: branch,
                month: month
            },
            dataType: 'JSON',
            success: function(response){
                monthlyOrderOutsChart.data.datasets[0].data = response['data'];
                monthlyOrderOutsChart.update();
                $('#monthlyorderoutstext').text(response['datatext']);
            }
        });
    })

    $('#orderoutsbranchreport').change(function(e){
        e.preventDefault();

        var month = $('#orderoutsmonths').find(":selected").val();
        var branch = $('#orderoutsbranchreport').find(":selected").val();
        
        $.ajax({
            url: '/branchandorderoutsmonthly',
            type: 'POST',
            data: {
                branch: branch,
                month: month
            },
            dataType: 'JSON',
            success: function(response){
                monthlyOrderOutsChart.data.datasets[0].data = response['data'];
                monthlyOrderOutsChart.update();
                $('#monthlyorderoutstext').text(response['datatext']);
            }
        });
    })

    
    
</script>