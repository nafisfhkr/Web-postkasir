<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // CustomerController.php
    public function index(Request $request)
    {
        // Get the search term from the query string
        $search = $request->get('search');
    
        // Fetch customers based on the search query
        if ($search) {
            $customers = Customer::where('nama', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('no_hp', 'like', '%' . $search . '%')
                ->get();
        } else {
            // If no search term, get all customers
            $customers = Customer::all();
        }
    
        // Return the view with customers data
        return view('customers.index', compact('customers'));
    }

public function update(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'customerId' => 'required|exists:customers,CustomerID',
        'nama' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'no_hp' => 'nullable|string|max:255',
    ]);

    // Find the customer
    $customer = Customer::find($request->customerId);

    // Update the customer with the new data
    $customer->nama = $request->nama;
    $customer->email = $request->email;
    $customer->no_hp = $request->no_hp;
    $customer->save();

    // Redirect back or send success response
    return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
}

}
