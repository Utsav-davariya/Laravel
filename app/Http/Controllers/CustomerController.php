<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function create()
    {
        return view("customer");

    }

    public function store(Request $request) //data come from req post from form
    {
        // echo "<pre>";
        // print_r($request->all());
        // dd($request->all());

        $customer = new Customer;   // add new record
        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->state = $request['state'];
        $customer->country = $request['country'];
        $customer->dob = $request['dob'];
        $customer->password = md5($request['password']);
        $customer->save();      //save the data in databse

        return redirect('/customer', );
    }
    public function view()
    {
        $customers = Customer::all();       //get all data from model table

        return view('customer-view', compact('customers'));  // pass data on view page with compact

        // return view('customer-view', [               //pass throght array method
        //     'customers' => $customers,
        // ]);

        // return view('customer-view')
        //     ->with('customers', $customers);

    }
    public function delete($id)
    {
        Customer::find($id)->delete();    //find the recore by the id from table
        // Customer::where('customer_id', $id)->delete();      // deirect through where cluse
        return redirect('customer');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);        //find customer as $id from req
        if (is_null($customer)) {               //if id is not exists redirect
            return redirect('customer');
        }
        return view('customerEdit', compact('customer'));
        // return view ('customerEdit')->with('customer',$customer);
        // return view('customerEdit', ['customer', $customer]);
    }


    public function update($id, Request $request)
    {

        $customer = Customer::find($id);
        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->state = $request['state'];
        $customer->country = $request['country'];
        $customer->dob = $request['dob'];
        $customer->save();

        return redirect()->route('customers.index');
    }


    public function trash()
    {
        $customers = Customer::onlyTrashed()->get(); //get data only which is trashed

        return view('customer-trash',compact('customers'));
    }

    public function restore($id)
    {
        $customers = Customer::withTrashed()->find($id);      // find data on id
        $customers->restore();      // restore data
        return redirect('customer');
    }

    public function forcedelete($id)
    {
        $customers = Customer::withTrashed()->find($id);    //find data on id
        $customers->forceDelete();  //delete forcefully
        return redirect()->back();
    }


    public function exportCustomers()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
