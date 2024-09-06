<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Controllers\ResourceController;




Route::view('/', 'home')->middleware('isLogin');





Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/ckecklogin', [LoginController::class, 'login'])->name('checklog');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);


});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::middleware('isLogin')->group(function () {           //group middleware

// Route::get('/customer',[CustomerController::class,'view']);
// Route::post('/customer',[CustomerController::class,'store']);
// Route::get('/customer/create',[CustomerController::class,'index'])->name('customer.create');
// Route::get('/customer/delete/{id}',[CustomerController::class,'delete'])->name('customer.delete');
// });


Route::middleware(['auth', 'isAdmin'])->group(function () {        // without define middleware name only auth
    Route::get('/customer', [CustomerController::class, 'view'])->name('customers.index');

    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store']);

    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customersUpdate/{id}', [CustomerController::class, 'update'])->name('customers.update');

    Route::get('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::get('/customer/trash', [CustomerController::class, 'trash']);
    Route::get('/customer/restore/{id}', [CustomerController::class, 'restore'])->name('customer.restore');
    Route::get('/customer/forcedelete/{id}', [CustomerController::class, 'forcedelete'])->name('customer.forcedelete');

    Route::get('customers/export', [CustomerController::class, 'exportCustomers'])->name('customers.export');

    Route::resource('/products-ajax-crud.resource', ResourceController::class)->shallow(); //use parent route
    Route::resource('/resourceStudents', ResourceController::class); //use parent route

});







// session


Route::get('set-session', function (Request $request) {         //set session data
    $request->session()->put('user_name', 'Lxis Tech');
    $request->session()->put('user_id', '123');
    // $request->session()->flash('status', 'success');              // only set one time if reload its destroy
    // $request->session()->reflash();
    // $request->session()->keep(['username', 'email']);
    return redirect('get-all-session');
});

Route::get('get-all-session', function () {         //get all session data
    $session = session()->all();
    p($session);
});

Route::get('destroy-session', function (Request $request) {     // destroy session data
    session()->forget('user_name');
    session()->forget('user_id');
    return redirect('get-all-session');
});



Route::get('/showusers', [UserController::class, 'showUsers'])->name('show.user');  //DB::query
Route::get('/single/{id}', [UserController::class, 'single'])->name('view.user');
Route::get('/add', [UserController::class, 'adduser'])->name('add.user');
Route::get('/update', [UserController::class, 'updateuser'])->name('update.user');
Route::get('/delete/{id}', [UserController::class, 'deleteuser'])->name('delete.user');
Route::get('/deleteall', [UserController::class, 'deleteAll '])->name('deleteAll.user');


Route::get('/students', [StudentController::class, 'showStudent']);
Route::get('/union', [StudentController::class, 'uniondata']);
Route::get('/when', [StudentController::class, 'whendata']);
Route::get('/chunk', [StudentController::class, 'chunkdata']);
Route::get('/rawStudent', [StudentController::class, 'rawshowStudent']);


Route::resource('products-ajax-crud', ProductAjaxController::class); //resource route
// Route::resource('products-ajax-crud', ProductAjaxController::class)->only('create','update','edit','show');//only this route use
// Route::resource('products-ajax-crud', ProductAjaxController::class)->except('edit','update');       // not use this route
// Route::resource('products-ajax-crud', ProductAjaxController::class)->names([
//                 'create' => 'products-ajax-crud.build',
//                 'show' => 'products-ajax-crud.view',
//             ]); //change route name



Route::resource('posts', PostController::class);


Route::resource('/person',PersonController::class);     //Eloquant Orm relationship one to one  and one to many  //person//contact
Route::get('/Contact',[ContactController::class,'show'])->name('');


Route::resource('/employee',EmployeeController::class); //many to many relation //employee//role//employee_role
Route::resource('/role',RoleController::class);
