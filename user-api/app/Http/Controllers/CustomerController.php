<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'regex:/^([^0-9]*)$/',
                'max:100',
                'min:5',
            ],
            'lastname' => [
                'regex:/^([^0-9]*)$/',
                'max:100',
            ],
            'email' => [
                'email:rfc,dns',
                'max:150',
            ],
            'address' => [
                'max:180',
            ],
            'phone' => [
                'numeric',
                'size:10',
            ],
        ]);
        $customer = Customer::create($request->all());
        UserCreated::dispatch($customer);
        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->update($request->all());
        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Customer::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Customer::where('name', 'like', '%'.$name."%")->get();
    }
}
