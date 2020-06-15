<?php

namespace App\Http\Controllers;

use App\CustomerImport;
use Illuminate\Http\Request;

class CustomerImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customerImports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerImport  $customerImport
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerImport $customerImport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerImport  $customerImport
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerImport $customerImport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerImport  $customerImport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerImport $customerImport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerImport  $customerImport
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerImport $customerImport)
    {
        //
    }
}
