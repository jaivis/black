<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class SectionController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \App\Models\Section::all();
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
        $item = new \App\Models\Section;
        //  fill object
        $item->OBJECTS_ID = $request->id;
        $item->NR = $request->nr;
        $item->NAME = $request->name;
        //  save object into db
        $saved = $item->save();

        if($saved){
            $response = (object)[
                'ID' => $item->id,
                'NR' => $item->NR,
                'NAME' => $item->NAME
            ];
        }else{
            $response = $saved;
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource by element.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parent($id)
    {
        //
        return \App\Models\Section::where(['OBJECTS_ID' => $id])->get();
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
        return \App\Models\Section::findOrFail($id);
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
