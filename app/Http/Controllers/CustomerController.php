<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\CustomerRegistered;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.all_customer', compact('customers'));
    }

    public function create()
    {
        return view('customers.add_customer');
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'dob' => 'required|date',
            // 'password' => 'required|string|min:4',
        ]);
         // Create the customer
    $customer = Customer::create($request->all());


        // // Create the customer
        // $customer = Customer::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'gender' => $request->gender,
        //     'address' => $request->address,
        //     'state' => $request->state,
        //     'country' => $request->country,
        //     'dob' => $request->dob,
        //     'password' => Hash::make($request->password),
        // ]);

        // Send the notification when the customer is registered
        if ($customer->user) { // Ensure there is a user associated with the customer
            $customer->user->notify(new CustomerRegistered($customer));
        } else {
            \Log::error('No user found for the customer: ' . $customer->id);
        }

        return redirect()->route('customers.index')->with('success', 'Customer added successfully!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit_customer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'dob' => 'required|date',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }
}
