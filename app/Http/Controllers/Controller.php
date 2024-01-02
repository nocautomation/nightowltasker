<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use App\Models\Loans;
use App\Models\OrderOuts;
use App\Models\Tasks;
use App\Models\OrderOuts_NameList;
use App\Models\Tasks_NameList;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function adduser(Request $data){

        if(!empty($data['avatar'])){
            $file = $data->file('avatar');
            $file->move(base_path('\images'), $file->getClientOriginalName());
        }

        $data->validate([
            'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'branch' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
            'userrole' => 'required',
        ],
        [
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'branch.required' => 'Branch is required',
            'email.required' => 'Email Address is required',
            'email.email' => 'Please input a valid email address',
            'email.unique' => 'Email address: '.$data['email'].' already exist in the database. Please choose a different email',
            'password.required' => 'Password is required',
            'password_confirmation.required' => 'Confirm password is required',
            'userrole.required' => 'User Role is required'
        ]);

        User::AddUser($data);

        return redirect('/newuser')->with('message','User Successfully Added!');
    }

    public function addbranch(Request $data){

        $data->validate([
            'branchName' => 'required|unique:branch,branch_name|max:255',
            'addressName' => 'required',
            'contact_number' => 'required|numeric',
            'overdue_interval' => 'required|numeric',
        ],[
            'branchName.required' => 'Branch Name is required',
            'addressName.required' => 'Editress is required',
            'contact_number.required' => 'Contact Number is required',
            'branchName.unique' => 'Branch '.$data['branchName'].' already exist in the database.',
            'contact_number.numeric' => 'Contact Number should be numeric',
            'overdue_interval.required' => 'Overdue Interval is required',
            'overdue_interval.numeric' => 'Overdue Interval should be number',
        ]);

        Branch::AddBranch($data);

        return redirect('/newbranch')->with('message','Branch Successfully Added!');
    }

    public function branchedit($id){

        $data = Branch::where('id',$id)->first();

        return view('admin.branchedit', compact('data'));

    }

    public function editbranch(Request $data){

        $data->validate([
            'branchName' => 'required',
            'addressName' => 'required',
            'contact_number' => 'required|numeric',
        ],[
            'branchName.required' => 'Branch Name is required',
            'addressName.required' => 'Editress is required',
            'contact_number.required' => 'Contact Number is required',
            'contact_number.numeric' => 'Contact Number should be numeric'
        ]);

        Branch::EditBranch($data);

        return redirect('/branchlist')->with('message','Branch Successfully Edited!');
    }

    public function newuser(){

        if(session('user_type') != 0){
            return redirect('/dashboard');
        }
        else{
            $collection = Branch::all();
            return view('admin.newuser', compact('collection'));
        }
    }

    public function Edituser(Request $data){

      
            $data->validate([
                'first_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email',
                'branch' => 'required',
                'userrole' => 'required'
            ],
            [
                'first_name.required' => 'First Name is required',
                'last_name.required' => 'Last Name is required',
                'first_name.alpha' => 'First Name should be alphabets only',
                'last_name.alpha' => 'Last Name should be alphabets only',
                'email.required' => 'Email address is required',
                'email.email' => 'Please input a valid email Editress',
                'userrole.required' => 'User Role is required'
            ]);

            User::EditUser($data);

            return redirect('/userlist')->with('message','User Successfully Edited!');
        }
        
    public function branchlist(){

        $collection = Branch::all();
        return view('admin.branchlist', compact('collection'));

    }

    public function userlist(){

        $collection = DB::table('user')
                    ->join('branch', 'user.branch', '=', 'branch.id')
                    ->select('user.*', 'branch.branch_name')
                    ->where('user.user_type', '!=' , 0)
                    ->get();

        return view('admin.userlist', compact('collection'));
        
    }

    public function newloan(){

        $branches = Branch::all();

        $coordinators = DB::table('user')
                        ->select('*')
                        ->where('user_type', '=', 1)
                        ->get();
        
        $requestors = DB::table('user')
                        ->select('*')
                        ->where('user_type', '=', 2)
                        ->get();
        
        $tasks = Tasks::all();
        $orderouts = OrderOuts::all();
        $orderoutlist = OrderOuts_NameList::all();
        $orderslist = [];

        foreach($orderoutlist as $list){
            array_push($orderslist,$list->orderoutName);
        }

        sort($orderslist);


        return view('admin.newloan', compact('branches','coordinators','requestors','tasks','orderouts','orderslist'));


    }


    public function RequestorAndCoordinator(Request $data){

        $result = DB::table('user')
                    ->select('*')
                    ->where('branch', '=', $data->branch)
                    ->where('user_type', '=', 1)
                    ->get();

        return response()->json($result);
    }

    public function addloan (Request $data){    

        $data->validate([
            'loannumber' => 'required|unique:loans,loan_number',
            'branch' => 'required',
            'borrower' => 'required',
            'requestor' => 'required',
            'coordinator' => 'required',
        ],
        [
            'loannumber.required' => 'Loan Number is required',
            'loannumber.unique' => 'Loan Number already exists',
            'branch.required' => 'Branch is required',
            'borrower.required' => 'Borrower name is required',
            'requestor.required' => 'Requestor is required',
            'coordinator.required' => 'Coordinator is required'
        ]);

        if(!empty($data['orderout'])){
            
            $data->validate([
                'status' => 'required'
            ]);
        }

        $loan_id = Loans::AddLoan($data);

        $tasks = ['scrub','filesetup','disclosure','appraisal','fastrackdisclosure','fastracksubmission','cocdisclosure','conditionalreview','closingdisclosure','inescrowreview','preapprovalreview','hthsetup'];
        $tasksNames = ['Scrub', 'File Setup' , 'Disclosure', 'Appraisal', 'FasTrack Disclosure', 'FasTrack Submission','COC/CIC Disclosure','Conditional Review','Closing Disclosure','In Escrow Review','Pre-approval Review','HTH Setup'];

        for($x = 0; $x < count($tasks); $x++){

            if(!empty($data[$tasks[$x].'start'])){

                $newtask = ([
                    'loanid' => $loan_id,
                    'task_name' => $tasksNames[$x],
                    'start' => $data[$tasks[$x].'start'],
                    'end' => $data[$tasks[$x].'end']
                ]);

                Tasks::newtask($newtask);
            }
        }

        if(!empty($data['orderout'])){
            
            for($x = 0; $x < count($data['orderout']); $x++){

                if(!empty($data['first'][$x]) || !empty($data['second'][$x]) || !empty($data['first'][$x])){
    
                    $newOrderOut = ([
                        'loan' => $loan_id,
                        'orderouts_name' => $data['orderout'][$x],
                        'first' => $data['first'][$x],
                        'second' => $data['second'][$x],
                        'third' => $data['third'][$x],
                        'status' => $data['status'][$x],
                        'remarks' => $data['remarks'][$x]
                    ]);
        
                    OrderOuts::neworderout($newOrderOut);
                }
            }
        }
        

        return redirect('/newloan')->with('message','Loan Successfully Added!');
    }

    public function loanlist(){

        if(session('user_type') == 0){
            $loans = DB::table('loans')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('branch.*', 'loans.*')
                    ->get();
        }
        else{
            $loans = DB::table('loans')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('branch.*', 'loans.*')
                    ->where('loans.branch',session('branch'))
                    ->get();
        }

        

        $coordinators = array();

        #Some loans have multiple coordinators, block of code below explodes the loan coordinator and gets the user information of that coordinator. It is stored in an array.
        foreach($loans as $loan){

            $temp = array();
            $loan_coordinators = explode(',', $loan->loan_coordinator);

            for($x = 0; $x < count($loan_coordinators); $x++){
                $temp_coord = DB::table('user')
                                    ->select('*')
                                    ->where('id', '=', $loan_coordinators[$x])
                                    ->first();
                array_push($temp, $temp_coord->first_name." ".$temp_coord->last_name);
            }

            $coord = implode(', ',$temp);

            array_push($coordinators, $coord);

        }
        
        return view('admin.loanlist', compact('loans','coordinators'));
    }

    public function loaninformation($id){

        $loan = DB::table('loans')
                    ->select('*')
                    ->where('id', '=', $id)
                    ->first();

        $branches = Branch::all();
        $requestors = DB::table('user')
                        ->select('*')
                        ->where('branch', '=', $loan->branch)
                        ->where('user_type', '=', 2)
                        ->get();

        $loancoordinators = DB::table('user')
                        ->select('*')
                        ->where('branch', '=', $loan->branch)
                        ->where('user_type', '=', 1)
                        ->get();

        $tasks = Tasks::where('loan',$id)->get();
        $orderouts = OrderOuts::where('loan',$id)->get();
        $orderoutlist = OrderOuts_NameList::all();

        $orderslist = [];

        foreach($orderoutlist as $list){
            array_push($orderslist,$list->orderoutName);
        }

        sort($orderslist);
        
        return view('admin.loaninfo', compact('loan','loancoordinators','requestors','branches','tasks','orderouts','orderslist'));
    }

    public function loaninfo($id){

        $loan = DB::table('loans')
                    ->select('*')
                    ->where('loan_number', '=', $id)
                    ->first();

        $branches = Branch::all();
        $requestors = DB::table('user')
                        ->select('*')
                        ->where('branch', '=', $loan->branch)
                        ->where('user_type', '=', 2)
                        ->get();

        $loancoordinators = DB::table('user')
                        ->select('*')
                        ->where('branch', '=', $loan->branch)
                        ->where('user_type', '=', 1)
                        ->get();

        $tasks = Tasks::where('loan',$id)->get();
        $orderouts = OrderOuts::where('loan',$loan->id)->get();
        $orderoutlist = OrderOuts_NameList::all();

        $orderslist = [];

        foreach($orderoutlist as $list){
            array_push($orderslist,$list->orderoutName);
        }

        sort($orderslist);
        
        return view('admin.loaninfo', compact('loan','loancoordinators','requestors','branches','tasks','orderouts','orderslist'));
    }

    public function loanedit(Request $data){

        $data->validate([
            'loannumber' => 'required',
            'branch' => 'required',
            'borrower' => 'required',
            'requestor' => 'required',
            'coordinator' => 'required',
        ],
        [
            'loannumber.required' => 'Loan Number is required',
            'branch.required' => 'Branch is required',
            'borrower.required' => 'Borrower name is required',
            'requestor.required' => 'Requestor is required',
            'coordinator.required' => 'Coordinator is required'
        ]);

        if(!empty($data['orderout'])){
            
            $data->validate([
                'status' => 'required'
            ]);
        }

        Loans::EditLoan($data);

        $loan_id = $data['loanid'];

        $tasks = ['scrub','filesetup','disclosure','appraisal','fastrackdisclosure','fastracksubmission','cocdisclosure','conditionalreview','closingdisclosure','inescrowreview','preapprovalreview','hthsetup'];
        $tasksNames = ['Scrub', 'File Setup' , 'Disclosure', 'Appraisal', 'FasTrack Disclosure', 'FasTrack Submission','COC/CIC Disclosure','Conditional Review','Closing Disclosure','In Escrow Review','Pre-approval Review','HTH Setup'];

        for($x = 0; $x < count($tasks); $x++){

            if(!empty($data[$tasks[$x].'start'])){

                $newtask = ([
                    'loanid' => $loan_id,
                    'task_name' => $tasksNames[$x],
                    'start' => $data[$tasks[$x].'start'],
                    'end' => $data[$tasks[$x].'end']
                ]);

                Tasks::updateorcreatetask($newtask);
            }
        }

        if(!empty($data['orderout'])){
            for($x = 0; $x < count($data['orderout']); $x++){

                if(!empty($data['first'][$x]) || !empty($data['second'][$x]) || !empty($data['first'][$x])){
    
                    $newOrderOut = ([
                        'loan' => $loan_id,
                        'orderouts_name' => $data['orderout'][$x],
                        'first' => $data['first'][$x],
                        'second' => $data['second'][$x],
                        'third' => $data['third'][$x],
                        'status' => $data['status'][$x],
                        'remarks' => $data['remarks'][$x]
                    ]);
        
                    OrderOuts::updateorcreateorderout($newOrderOut);
                }
            
            }
        }
        
        return redirect('/loaninformation/'.$data['loanid'])->with('message','Loan Successfully Edited!');

    }

    public function deleteuser(Request $data){

        User::DeleteUser($data);
        return response()->json($data);
        
    }

    public function deletebranch(Request $data){

        Branch::DeleteBranch($data);
        return response()->json($data);
        
    }

    public function logout(Request $data){

        auth()->logout();

        $data->session()->invalidate();
        $data->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Successful');
    }

    public function login(Request $data){

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
            $data->session()->regenerate();
            
            $user = User::where('email',$data['email'])->first();

            $data->session()->put('user_type', $user->user_type);
            $data->session()->put('branch', $user->branch);

            return redirect('/dashboard')->with('message', 'Welcome!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');


    }

    public function useredit($id){

        $data = User::where('id',$id)->first();
        $branches = Branch::all();

        return view('admin.useredit', compact('data','branches'));

    }

    public function dashboard(){

        $users = DB::table('user')->count();
        $branches = DB::table('branch')->count();

        if(session('user_type') == 0){
            $loans = DB::table('loans')->count();

            $overduetasks = DB::table('tasks')
                            ->join('loans', 'tasks.loan', '=', 'loans.id')
                            ->join('branch', 'loans.branch', '=', 'branch.id')
                            ->select('tasks.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                            ->whereRaw("DATEDIFF(NOW(), start) >= `overdue_interval`")
                            ->whereNull('tasks.end')
                            ->count();


            $overdueorderouts = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->whereRaw(
                        "CASE
                            WHEN third IS NOT NULL THEN DATEDIFF(NOW(), third) >= `overdue_interval`
                            WHEN second IS NOT NULL THEN DATEDIFF(NOW(), second) >= `overdue_interval`
                            ELSE DATEDIFF(NOW(), first) >= `overdue_interval`
                        END
                        "
                    )
                    ->where([
                        ['status', '!=', 'Completed'],
                        ['status', '!=', 'Cancelled'],
                        ['status', '!=', 'Withdrawn'],
                        ['status', '!=', 'Closing Stage']
                    ])
                    ->count();
        }
        else{
            $loans = DB::table('loans')->where('branch',session('branch'))->count();
            $overduetasks = DB::table('tasks')
                            ->join('loans', 'tasks.loan', '=', 'loans.id')
                            ->join('branch', 'loans.branch', '=', 'branch.id')
                            ->select('tasks.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                            ->where('loans.branch',session('branch'))
                            ->whereRaw("DATEDIFF(NOW(), start) >= `overdue_interval`")
                            ->whereNull('tasks.end')
                            ->count();


            $overdueorderouts = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->whereRaw(
                        "CASE
                            WHEN third IS NOT NULL THEN DATEDIFF(NOW(), third) >= `overdue_interval`
                            WHEN second IS NOT NULL THEN DATEDIFF(NOW(), second) >= `overdue_interval`
                            ELSE DATEDIFF(NOW(), first) >= `overdue_interval`
                        END
                        "
                    )
                    ->where([
                        ['loans.branch', '=', session('branch')],
                        ['status', '!=', 'Completed'],
                        ['status', '!=', 'Cancelled'],
                        ['status', '!=', 'Withdrawn'],
                        ['status', '!=', 'Closing Stage']
                    ])
                    ->count();
        }
        

        $data = ([
            'users' => $users,
            'loans' => $loans,
            'branches' => $branches,
            'overduetasks' => $overduetasks,
            'overdueorderouts' => $overdueorderouts
        ]);

        return view('admin.dashboard', compact('data'));
    }

    public function overduetasks(){

        if(session('user_type') == 0){
            $data = DB::table('tasks')
                    ->join('loans', 'tasks.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('tasks.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->whereRaw("DATEDIFF(NOW(), start) >= `overdue_interval`")
                    ->whereNull('tasks.end')
                    ->get();
        }
        else{
            $data = DB::table('tasks')
                    ->join('loans', 'tasks.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('tasks.*', 'branch.branch_name','branch.overdue_interval', 'loans.*')
                    ->where('loans.branch', session('branch'))
                    ->whereRaw("DATEDIFF(NOW(), start) >= `overdue_interval`")
                    ->whereNull('tasks.end')
                    ->get();
        }
        
        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";

        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }

        return view('admin.overduetasks', compact('data','coordinatorslist','users'));
    }


    public function overdueorderouts(){

        $data = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.orderouts_name','orderouts.first', 'orderouts.second', 'orderouts.third','branch.branch_name','branch.overdue_interval', 'loans.loan_number','loans.requestor','loans.loan_coordinator','loans.borrower','loans.id')
                    ->whereRaw(
                        "CASE
                            WHEN third IS NOT NULL THEN DATEDIFF(NOW(), third) >= `overdue_interval`
                            WHEN second IS NOT NULL THEN DATEDIFF(NOW(), second) >= `overdue_interval`
                            ELSE DATEDIFF(NOW(), first) >= `overdue_interval`
                        END
                        "
                    )
                    ->where([
                        ['status', '!=', 'Completed'],
                        ['status', '!=', 'Cancelled'],
                        ['status', '!=', 'Withdrawn'],
                        ['status', '!=', 'Closing Stage']
                    ])
                    ->get();

        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";
            
        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }
        
        
        return view('admin.overdueorderouts', compact('data','coordinatorslist','users'));

    }

    public function reports(){

        $branches = Branch::all();
        $firstLoan = Loans::first();
        $branch = Branch::where('id','=',$firstLoan->branch)->first();
        $branchname = $branch->branch_name;
        $firstbranch = $firstLoan->branch;
        $currentmonth = date("m");

        $monthlytasks = $this->monthlytaskreport();
        $monthlyorderouts = $this->monthlyorderoutsreport();

        return view('admin.reports',compact('branches','monthlytasks','currentmonth','firstbranch','branchname','monthlyorderouts'));
    }

    public function monthlytaskreport(){

        $scrub = $filesetup = $disclosure = $appraisal = $fastrackdisclosure = $fastracksubmission = 0;
        $firstLoan = Loans::first();
        $finalresult = [];

        $tasks = DB::table('tasks')
                ->join('loans','loans.id', '=', 'tasks.loan')
                ->join('branch','branch.id', '=', 'loans.branch')
                ->select('tasks.*','loans.*','branch.*')
                ->where('loans.branch', '=', $firstLoan->branch)
                ->whereMonth('end', '=' , date("m"))
                ->whereYear('end', '=' , date("Y"))
                ->get();
                
        foreach($tasks as $results){
            switch($results->task_name){
                case('Scrub'):
                    $scrub = $scrub + 1;
                break;

                case('Appraisal'):
                    $appraisal = $appraisal + 1;
                break;

                case('File Setup'):
                    $filesetup = $filesetup + 1;
                break;

                case('Disclosure'):
                    $disclosure = $disclosure + 1;
                break;

                case('FasTrack Disclosure'):
                    $fastrackdisclosure = $fastrackdisclosure + 1;
                break;

                case('FasTrack Submission'):
                    $fastracksubmission = $fastracksubmission + 1;
                break;
            }
        }

        array_push($finalresult,$scrub);
        array_push($finalresult,$disclosure);
        array_push($finalresult,$filesetup);
        array_push($finalresult,$appraisal);
        array_push($finalresult,$fastrackdisclosure);
        array_push($finalresult,$fastracksubmission);

        return $finalresult;
    }

    public function branchandtasksmonthly(Request $data){

        $scrub = $filesetup = $disclosure = $appraisal = $fastrackdisclosure = $fastracksubmission = 0;

        $tasks = DB::table('tasks')
                ->join('loans','loans.id', '=', 'tasks.loan')
                ->join('branch','branch.id', '=', 'loans.branch')
                ->select('tasks.*','loans.*','branch.*')
                ->where('loans.branch', '=', $data->branch)
                ->whereMonth('end', '=' , $data->month)
                ->whereYear('end', '=' , date("Y"))
                ->get();

        $branch = Branch::where('id','=',$data->branch)->first();
        $branchname = $branch->branch_name;
        
        $dateObj = \DateTime::createFromFormat('!m', $data->month);
        $monthName = $dateObj->format('F');

        $finalresult = [];
        
        foreach($tasks as $results){
            switch($results->task_name){
                case('Scrub'):
                    $scrub = $scrub + 1;
                break;

                case('Appraisal'):
                    $appraisal = $appraisal + 1;
                break;

                case('File Setup'):
                    $filesetup = $filesetup + 1;
                break;

                case('Disclosure'):
                    $disclosure = $disclosure + 1;
                break;

                case('FasTrack Disclosure'):
                    $fastrackdisclosure = $fastrackdisclosure + 1;
                break;

                case('FasTrack Submission'):
                    $fastracksubmission = $fastracksubmission + 1;
                break;
            }
        }


        array_push($finalresult,$scrub);
        array_push($finalresult,$disclosure);
        array_push($finalresult,$filesetup);
        array_push($finalresult,$appraisal);
        array_push($finalresult,$fastrackdisclosure);
        array_push($finalresult,$fastracksubmission);

        $text = 'Tasks completed for the month of '.$monthName.' for '.$branchname.' branch';
        
        return response()->json([
            'data' => $finalresult,
            'datatext' => $text
        ]);
    }

    public function monthlyorderoutsreport(){
        $eoi = $collectionpayoff = $creditsupplement = $floodinsurance = $masterinsurance = $mortgagepayoff = $paymentvom = $titledocs = $taxtranscript = $vvoe = $pestinspection = $wvoeb1 = $wvoeb2 = $wvoeb3 = $wvoecb1 = $wvoecb2 = $wvoecb3 = 0;
        $firstLoan = Loans::first();
        $finalresult = [];

        $data = DB::table('orderouts')
                ->join('loans', 'orderouts.loan', '=', 'loans.id')
                ->join('branch', 'loans.branch', '=', 'branch.id')
                ->select('orderouts.*', 'branch.*', 'loans.*')
                ->where('loans.branch','=',$firstLoan->branch)
                ->where('status', '=', 'Completed')
                ->whereRaw(
                    "CASE
                        WHEN third IS NOT NULL THEN MONTH(third) = MONTH(now()) AND YEAR(third) = YEAR(now())
                        WHEN second IS NOT NULL THEN MONTH(second) = MONTH(now()) AND YEAR(second) = YEAR(now())
                        ELSE MONTH(first) = MONTH(now()) AND YEAR(first) = YEAR(now())
                    END
                    "
                )
                ->get();


        foreach($data as $results){
            switch($results->orderouts_name){
                case('EOI'):
                    $eoi++;
                break;

                case('Master Insurance'):
                    $masterinsurance++;
                break;

                case('Flood Insurance'):
                    $floodinsurance++;
                break;

                case('Mortgage Payoff'):
                    $mortgagepayoff++;
                break;

                case('Collection Payoff'):
                    $collectionpayoff++;
                break;

                case('Credit Supplement'):
                    $creditsupplement++;
                break;

                case('VVOE'):
                    $vvoe++;
                break;

                case('WVOE Borrower 1'):
                    $wvoeb1++;
                break;

                case('WVOE Borrower 2'):
                    $wvoeb2 = $wvoeb2 + 1;
                break;

                case('WVOE Borrower 3'):
                    $wvoeb3++;
                break;

                case('WVOE Co-borrower 1'):
                    $wvoecb1++;
                break;

                case('WVOE Co-borrower 2'):
                    $wvoecb2++;
                break;

                case('WVOE Co-borrower 3'):
                    $wvoecb3++;
                break;

                case('Tax Transcript'):
                    $taxtranscript++;
                break;

                case('Pest Inspection'):
                    $pestinspection++;
                break;

                case('24 Payment-VOM'):
                    $paymentvom++;
                break;

                case('Title Docs'):
                    $itledocs++;
                break;
            }
        }

        array_push($finalresult,$eoi);
        array_push($finalresult,$collectionpayoff);
        array_push($finalresult,$creditsupplement);
        array_push($finalresult,$floodinsurance);
        array_push($finalresult,$masterinsurance);
        array_push($finalresult,$mortgagepayoff);
        array_push($finalresult,$paymentvom);
        array_push($finalresult,$titledocs);
        array_push($finalresult,$taxtranscript);
        array_push($finalresult,$vvoe);
        array_push($finalresult,$wvoeb1);
        array_push($finalresult,$wvoeb2);
        array_push($finalresult,$wvoeb3);
        array_push($finalresult,$wvoecb1);
        array_push($finalresult,$wvoecb2);
        array_push($finalresult,$wvoecb3);
        array_push($finalresult,$pestinspection);

        return $finalresult;
    }

    public function branchandorderoutsmonthly(Request $data){

        $eoi = $collectionpayoff = $creditsupplement = $floodinsurance = $masterinsurance = $mortgagepayoff = $paymentvom = $titledocs = $taxtranscript = $vvoe = $pestinspection = $wvoeb1 = $wvoeb2 = $wvoeb3 = $wvoecb1 = $wvoecb2 = $wvoecb3 = 0;

        $orderout = DB::table('orderouts')
                ->join('loans', 'orderouts.loan', '=', 'loans.id')
                ->join('branch', 'loans.branch', '=', 'branch.id')
                ->select('orderouts.*', 'branch.*', 'loans.*')
                ->where('loans.branch','=', $data->branch)
                ->where('status', '=', 'Completed')
                ->whereRaw(
                    "CASE
                        WHEN third IS NOT NULL THEN MONTH(third) = ? AND YEAR(third) = YEAR(now())
                        WHEN second IS NOT NULL THEN MONTH(second) = ? AND YEAR(second) = YEAR(now())
                        ELSE MONTH(first) = ? AND YEAR(first) = YEAR(now())
                    END
                    ", [$data->month,$data->month,$data->month]
                )
                ->get();

        $branch = Branch::where('id','=',$data->branch)->first();
        $branchname = $branch->branch_name;
        
        $dateObj = \DateTime::createFromFormat('!m', $data->month);
        $monthName = $dateObj->format('F');

        $finalresult = [];

        foreach($orderout as $results){
            switch($results->orderouts_name){
                case('EOI'):
                    $eoi++;
                break;

                case('Master Insurance'):
                    $masterinsurance++;
                break;

                case('Flood Insurance'):
                    $floodinsurance++;
                break;

                case('Mortgage Payoff'):
                    $mortgagepayoff++;
                break;

                case('Collection Payoff'):
                    $collectionpayoff++;
                break;

                case('Credit Supplement'):
                    $creditsupplement++;
                break;

                case('VVOE'):
                    $vvoe++;
                break;

                case('WVOE Borrower 1'):
                    $wvoeb1++;
                break;

                case('WVOE Borrower 2'):
                    $wvoeb2 = $wvoeb2 + 1;
                break;

                case('WVOE Borrower 3'):
                    $wvoeb3++;
                break;

                case('WVOE Co-borrower 1'):
                    $wvoecb1++;
                break;

                case('WVOE Co-borrower 2'):
                    $wvoecb2++;
                break;

                case('WVOE Co-borrower 3'):
                    $wvoecb3++;
                break;

                case('Tax Transcript'):
                    $taxtranscript++;
                break;

                case('Pest Inspection'):
                    $pestinspection++;
                break;

                case('24 Payment-VOM'):
                    $paymentvom++;
                break;

                case('Title Docs'):
                    $itledocs++;
                break;
            }
        }

        array_push($finalresult,$eoi);
        array_push($finalresult,$collectionpayoff);
        array_push($finalresult,$creditsupplement);
        array_push($finalresult,$floodinsurance);
        array_push($finalresult,$masterinsurance);
        array_push($finalresult,$mortgagepayoff);
        array_push($finalresult,$paymentvom);
        array_push($finalresult,$titledocs);
        array_push($finalresult,$taxtranscript);
        array_push($finalresult,$vvoe);
        array_push($finalresult,$wvoeb1);
        array_push($finalresult,$wvoeb2);
        array_push($finalresult,$wvoeb3);
        array_push($finalresult,$wvoecb1);
        array_push($finalresult,$wvoecb2);
        array_push($finalresult,$wvoecb3);
        array_push($finalresult,$pestinspection);

        $text = 'Order outs completed for the month of '.$monthName.' for '.$branchname.' branch';
        
        return response()->json([
            'data' => $finalresult,
            'datatext' => $text
        ]);
    }

    public function tasks(){

        if(session('user_type') == 0){
            $data = DB::table('tasks')
                    ->join('loans', 'tasks.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('tasks.*', 'branch.branch_name','loans.loan_number','loans.borrower','loans.requestor','loans.loan_coordinator')
                    ->get();
        }
        else{
            $data = DB::table('tasks')
                    ->join('loans', 'tasks.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('tasks.*', 'branch.branch_name','loans.loan_number','loans.borrower','loans.requestor','loans.loan_coordinator')
                    ->where('loans.branch',session('branch'))
                    ->get();
        }

        
        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";

        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }

        return view('admin.tasks', compact('data','coordinatorslist','users'));

    }

    public function taskcomplete(Request $data){

        $now = date("Y-m-d\\TH:i:s");
        Tasks::completeTask($data,$now);
        return response()->json($data);
    }

    public function orderouts(){

        if(session('user_type') == 0){
            $data = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.loan_number','loans.borrower','loans.requestor','loans.loan_coordinator')
                    ->get();
        }
        else{
            $data = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.loan_number','loans.borrower','loans.requestor','loans.loan_coordinator')
                    ->where('loans.branch',session('branch'))
                    ->get();
        }


        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";
            
        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }
        
        return view('admin.orderouts', compact('data','coordinatorslist','users'));
    }

    public function orderoutchangestatus(Request $data){

        OrderOuts::updateStatus($data);
        return response()->json($data);
    }

    public function orderoutnamelist(){

        $data = OrderOuts_Namelist::all();

        return view('admin.orderoutslist', compact('data'));

    }

    public function addneworderoutlist(Request $item){

        OrderOuts_NameList::insertOrderOutType($item);

        $data = OrderOuts_Namelist::all();

        return view('admin.orderoutslist', compact('data'));
    }

    public function getorderoutname(Request $data){

        $orderOutType = OrderOuts_NameList::where('namelistId','=',$data['id'])->first();

        return response()->json($orderOutType);
    }

    public function editorderoutlist(Request $item){

        OrderOuts_NameList::editOrderOutType($item);

        $data = OrderOuts_Namelist::all();

        return view('admin.orderoutslist', compact('data'));

    }
    
    public function deleteorderouttype(Request $data){

        OrderOuts_Namelist::DeleteOrderOutType($data);
        return response()->json($data);
    }

    public function tasknamelist(){

        $data = Tasks_NameList::all();

        return view('admin.taskslist', compact('data'));

    }

    public function addnewtasklist(Request $item){

        Tasks_NameList::insertTaskType($item);

        $data = Tasks_NameList::all();

        return redirect('/tasknamelist')->with('message','Task Type Successfully Added!');

    }

    public function gettaskname(Request $data){

        $taskType = Tasks_NameList::where('tasklistId','=',$data['id'])->first();

        return response()->json($taskType);
    }

    public function edittasklist(Request $item){

        Tasks_NameList::editTaskType($item);

        $data = Tasks_NameList::all();

        return view('admin.taskslist', compact('data'));

    }

    public function deletetasktype(Request $data){

        Tasks_NameList::DeleteTaskType($data);
        return response()->json($data);
    }

    public function test(Request $data){
        
        dd("hello");
        
    }

    public function filteredorderouts(Request $data){

        if(session('user_type') == 0){
            $data = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.loan_number','loans.borrower','loans.requestor','loans.loan_coordinator')
                    ->where('orderouts.status', '=', $data['status'])
                    ->get();
        }
        else{
            $data = DB::table('orderouts')
                    ->join('loans', 'orderouts.loan', '=', 'loans.id')
                    ->join('branch', 'loans.branch', '=', 'branch.id')
                    ->select('orderouts.*', 'branch.branch_name','branch.overdue_interval', 'loans.loan_number','loans.borrower','loans.requestor','loans.loan_coordinator')
                    ->where('loans.branch',session('branch'))
                    ->where('orderouts.status', '=', $data['status'])
                    ->get();
        }


        $users = User::all();

        $loancoordinators = [];
        $coordinatorslist = [];
        $coordinatorname = "";
            
        foreach($data as $coordinators){
            array_push($loancoordinators,$coordinators->loan_coordinator);
        }

        for($x = 0; $x < count($loancoordinators); $x++){

            $loan_coordinators = explode(',', $loancoordinators[$x]);

            for($i = 0; $i < count($loan_coordinators); $i++){
                foreach($users as $user){
                    if($user->id == $loan_coordinators[$i]){
                        if($i == 0){
                            $coordinatorname = $user->first_name." ".$user->last_name;
                            // array_push($coordinatorslist,$user->first_name." ".$user->last_name);
                        }
                        else{
                            $coordinatorname = $coordinatorname.", ".$user->first_name." ".$user->last_name;
                        }
                    }
                }
                
            }
            array_push($coordinatorslist,$coordinatorname);
        }
        
        return view('admin.filteredstatus', compact('data','coordinatorslist','users'));
    }

    public function test1(){

        $branches = Branch::all();

        $coordinators = DB::table('user')
                        ->select('*')
                        ->where('user_type', '=', 1)
                        ->get();
        
        $requestors = DB::table('user')
                        ->select('*')
                        ->where('user_type', '=', 2)
                        ->get();
        
        $tasks = Tasks::all();
        $orderouts = OrderOuts::all();

        return view('admin.newloancopy', compact('branches','coordinators','requestors','tasks','orderouts'));
    }

    public function deleteloan(Request $data){

        Loans::deleteLoan($data);
    }

    public function addloantest(Request $data){
        dd($data);
    }

   
    
}
