<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rowList = Note::all();
        return response()->json($rowList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $row = new Note();
        $row->name = $request['name'];
        $row->company = $request['company'];
        $row->phone = $request['phone'];
        $row->email = $request['email'];
        $row->photo = $request['photo'];
        $row->birthday = $request['birthday'];
        $row->save();
        return redirect()->action([ApiController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Note::find($id);
        return response()->json($row);
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
        $row = Note::find($id);
        $row->name = $request['name'];
        $row->company = $request['company'];
        $row->phone = $request['phone'];
        $row->email = $request['email'];
        $row->photo = $request['photo'];
        $row->birthday = $request['birthday'];
        $row->save();
        return redirect()->action([ApiController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::destroy($id);
        return redirect()->action([ApiController::class, 'index']);
    }

    public function test(Request $request)
    {
        return $request;
        //return response()->json(['test' => 'Ok']);
    }

}
