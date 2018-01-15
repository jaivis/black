<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deals = \App\Models\Deal::visi()->withPath('deals');
        return view('deals.deals', ['deals' => $deals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('deals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  create object
        $item = new \App\Models\Deal;
        //  fill object
        $item->OUTLAY = $request->OUTLAY;
        $item->NAME = $request->NAME;
        $item->AMOUNT = $request->AMOUNT;
        $item->PERFORMER = $request->PERFORMER;
        $item->OBJECTS_ID = $request->OBJECTS_ID;
        $item->SECTIONS_ID = $request->SECTIONS_ID;
        $item->ELEMENTS_ID = $request->ELEMENTS_ID;
        $item->TYPES_ID = $request->TYPES_ID;
        $item->SYSTEMS_ID = $request->SYSTEMS_ID;
        //  save object into db
        $item->save();

        return redirect()->route('deals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        die(__METHOD__);
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
        die(__METHOD__);
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
        die(__METHOD__);
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
        die(__METHOD__);
    }
}
