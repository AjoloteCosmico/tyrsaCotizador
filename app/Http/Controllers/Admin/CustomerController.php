<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerClassification;
use App\Models\CustomerType;
use App\Models\Sector;
use App\Models\User;
use App\Models\vcustomers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $Customers = vcustomers::all();

        return view('admin.customers.index', compact(
            'Customers',
        ));
    }

    public function create()
    {
        $CustomerTypes = CustomerType::all();
        $CustomerClassifications = CustomerClassification::all();
        $Sectors = Sector::all();
        $Users = User::where('id', '>=', 3)->get();

        return view('admin.customers.create', compact(
            'CustomerTypes',
            'CustomerClassifications',
            'Sectors',
            'Users',
        ));
    }

    public function store(Request $request)
    {
        //return $request;

        $rules = [
            'customer_classification' => 'required|integer|not_in:0',
            'customer_type' => 'required|integer|not_in:0',
            'customer' => 'required',
            'campus' => 'required',
            // 'rfc' => 'required',
            'state' => 'required',
            'city' => 'required',
            'suburb' => 'required',
            'address' => 'required',
            'outdoor' => 'required',
            // 'indoor' => 'required',
            // 'zip_code' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'sector' => 'required|integer|not_in:0',
            'user' => 'required|integer|not_in:0',
        ];

        $messages = [
            'customer_classification.required' => 'Elija la Clasificación del Cliente',
            'customer_classification.integer' => 'Elija una Clasificación válida',
            'customer_type.required' => 'Elija el tipo de Cliente',
            'customer_type.integer' => 'Elija un Tipo de Cliente válido',
            'customer.required' => 'Escriba el Nombre del Cliente',
            'campus.required' => 'Capture la Sede del Cliente',
            // 'rfc.required' => 'Capture el RFC del Cliente',
            'state.required' => 'Capture el Estado donde se ubica el Cliente',
            'city.required' => 'Capture la Ciudad donde se ubica el Cliente',
            'suburb.required' => 'Capture la Colonia donde se ubica el Cliente',
            'address.required' => 'Capture la dirección donde se ubica el Cliente',
            'outdoor.required' => 'Capture el Número Exterior donde se ubica el Cliente',
            // 'indoor.required' => 'Capture el Número Interior donde se ubica el Cliente',
            // 'zip_code.required' => 'Capture el Código Postal donde se ubica el Cliente',
            'email.required' => 'Capture la dirección electrónica del Cliente',
            'email.email' => 'Capture una dirección de Email válida',
            'telephone.required' => 'Capture el Número telefónico del CLiente',
            'sector.required' => 'Elija el Sector al que pertence el Cliente',
            'sector.integer' => 'Elija un Sector válido',
            'user.required' => 'Asigne un vendedor al Cliente',
            'user.integer' => 'Asigne un vendedor válido',
        ];

        $request->validate($rules, $messages);

        //  

        $Customers = new Customer();
        $Customers->customer_classification_id = $request->customer_classification;
        $Customers->customer_type_id = $request->customer_type;
        $Customers->customer = $request->customer;
        $Customers->campus = $request->campus;
        $Customers->rfc = $request->rfc;
        $Customers->state = $request->state;
        $Customers->city = $request->city;
        $Customers->suburb = $request->suburb;
        $Customers->address = $request->address;
        $Customers->outdoor = $request->outdoor;
        $Customers->indoor = $request->indoor;
        $Customers->zip_code = $request->zip_code;
        $Customers->email = $request->email;
        $Customers->telephone = $request->telephone;
        $Customers->sector_id = $request->sector;
        $Customers->user_id = $request->user;
        $Customers->save();

        //return $Customers;

        return redirect()->route('customers.index')->with('create_reg', 'ok');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
