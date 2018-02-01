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
        return view('deals.form', [
            'route' => route('deals.store'),
            'method' => 'POST',
            'method_field' => 'POST',
            'form' => [
                'class' => 'panel-success'
            ],
            'text' => [
                'header' => 'Darījuma dati'
            ],
            'buttons' => [
                'submit' => 'Pievienot',
                'close' => 'Atpakaļ'
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  create object
        $item = new \App\Models\Deal;
        //  fill object
        $item->OUTLAY = $request->OUTLAY;
        $item->NAME = $request->NAME;
        $item->AMOUNT = str_replace('-', '', $request->AMOUNT);
        $item->PERFORMER = $request->PERFORMER;
        $item->OBJECTS_ID = $request->OBJECTS_ID;
        $item->SECTIONS_ID = $request->SECTIONS_ID;
        $item->ELEMENTS_ID = $request->ELEMENTS_ID;
        $item->TYPES_ID = $request->TYPES_ID;
        $item->SYSTEMS_ID = $request->SYSTEMS_ID;
        //  save object into db
        $item->save();

        return redirect()->route('deals.index')->with(['statusText' => 'Darījums izveidots.', 'statusClass' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('deals.form', [
            'route' => route('deals.update', $id),
            'method' => 'POST',
            'method_field' => 'PATCH',
            'form' => [
                'class' => 'panel-primary'
            ],
            'text' => [
                'header' => 'Darījuma dati'
            ],
            'buttons' => [
                'submit' => 'Saglabāt',
                'close' => 'Atcelt'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $deal = \App\Models\Deal::find($id);
        //  update objects
        $deal->OUTLAY = $request->OUTLAY;
        $deal->NAME = $request->NAME;
        $deal->AMOUNT = str_replace('-', '', $request->AMOUNT);
        $deal->PERFORMER = $request->PERFORMER;
        $deal->OBJECTS_ID = $request->OBJECTS_ID;
        $deal->SECTIONS_ID = $request->SECTIONS_ID;
        $deal->ELEMENTS_ID = $request->ELEMENTS_ID;
        $deal->TYPES_ID = $request->TYPES_ID;
        $deal->SYSTEMS_ID = $request->SYSTEMS_ID;
        //  update object
        $deal->save();

        return redirect()->route('deals.index')->with(['statusText' => 'Darījums veiksmīgi izlabots.', 'statusClass' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $deal = \App\Models\Deal::find($id);
        $deal->delete();

        //
        return redirect()->route('deals.index')->with(['statusText' => 'Darījums izdzēsts.', 'statusClass' => 'alert-success']);
    }
}
