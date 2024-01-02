<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('authentication.index');
})->name('login');
Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');
Route::get('/newbranch', function () {
    return view('admin.newbranch');
})->middleware('auth');


Route::get('/newuser', [Controller::class, 'newuser'])->middleware('auth');
Route::get('/reports', [Controller::class, 'reports'])->middleware('auth');
Route::get('/newloan', [Controller::class, 'newloan'])->middleware('auth');
Route::get('/typeofrequest', [Controller::class, 'typeofrequest'])->middleware('auth');
Route::get('/loaninformation/{id}', [Controller::class, 'loaninformation'])->middleware('auth');
Route::get('/loaninfo/{id}', [Controller::class, 'loaninfo'])->middleware('auth');
Route::get('/branchedit/{id}', [Controller::class, 'branchedit'])->middleware('auth');
Route::get('/useredit/{id}', [Controller::class, 'useredit'])->middleware('auth');
Route::get('/overduetasks', [Controller::class, 'overduetasks'])->middleware('auth');
Route::get('/overdueorderouts', [Controller::class, 'overdueorderouts'])->middleware('auth');
Route::get('/userlist', [Controller::class, 'userlist'])->middleware('auth');
Route::get('/branchlist', [Controller::class, 'branchlist'])->middleware('auth');
Route::get('/loanlist', [Controller::class, 'loanlist'])->middleware('auth');
Route::get('/tasks', [Controller::class, 'tasks'])->middleware('auth');
Route::get('/orderouts', [Controller::class, 'orderouts'])->middleware('auth');
Route::get('/orderoutnamelist', [Controller::class, 'orderoutnamelist'])->middleware('auth');
Route::get('/tasknamelist', [Controller::class, 'tasknamelist'])->middleware('auth');
Route::post('addbranch', [Controller::class,'addbranch'])->middleware('auth');
Route::post('editbranch', [Controller::class,'editbranch'])->middleware('auth');
Route::post('edituser', [Controller::class,'edituser'])->middleware('auth');
Route::post('addrequest', [Controller::class,'addrequest'])->middleware('auth');
Route::post('addbranch', [Controller::class,'addbranch'])->middleware('auth');
Route::post('adduser', [Controller::class,'adduser'])->middleware('auth');
Route::post('requestorandcoordinator', [Controller::class,'RequestorAndCoordinator'])->middleware('auth');
Route::post('loanedit', [Controller::class,'loanedit'])->name('loanedit')->middleware('auth');
Route::post('addloan', [Controller::class,'addloan'])->middleware('auth');
Route::post('deleteuser', [Controller::class,'deleteuser'])->middleware('auth');
Route::post('deletebranch', [Controller::class,'deletebranch'])->middleware('auth');
Route::post('deleteorderouttype', [Controller::class,'deleteorderouttype'])->middleware('auth');
Route::post('/deletetasktype', [Controller::class,'deletetasktype'])->middleware('auth');
Route::post('/taskcomplete', [Controller::class,'taskcomplete'])->middleware('auth');
Route::post('/orderoutchangestatus', [Controller::class,'orderoutchangestatus'])->middleware('auth');
Route::post('/login', [Controller::class,'login']);
Route::post('/logout', [Controller::class,'logout']);
Route::post('/newtask', [Controller::class,'newtask'])->middleware('auth');;
Route::post('/neworderout', [Controller::class,'neworderout']);
Route::post('/addneworderoutlist', [Controller::class,'addneworderoutlist']);
Route::post('/branchandtasksmonthly', [Controller::class,'branchandtasksmonthly']);
Route::post('/branchandorderoutsmonthly', [Controller::class,'branchandorderoutsmonthly']);
Route::post('/getorderoutname', [Controller::class,'getorderoutname']);
Route::post('/gettaskname', [Controller::class,'gettaskname']);
Route::post('/editorderoutlist', [Controller::class,'editorderoutlist']);
Route::post('/edittasklist', [Controller::class,'edittasklist']);
Route::post('/addnewtasklist', [Controller::class,'addnewtasklist']);
Route::post('/deleteloan', [Controller::class,'deleteloan']);
Route::post('/filteredorderouts', [Controller::class,'filteredorderouts']);


Route::get('/test', [Controller::class,'test']);
Route::get('/test1', [Controller::class,'test1']);
Route::post('/addloantest', [Controller::class,'addloantest']);


