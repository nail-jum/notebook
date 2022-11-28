<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    // Display a listing of the resource.
    // @return \Illuminate\Http\Response
    public function index()
    {
        $rowList = Note::all();
        return view('index', ['rowList' => $rowList]);
    }

    // Show the form for creating a new resource.
    // @return \Illuminate\Http\Response
    public function create()
    {
        return view('add');
    }

    // Store a newly created resource in storage.
    // @param  \Illuminate\Http\Request  $request
    // @return \Illuminate\Http\Response
    public function store(Request $request)
    {
        $row = new Note();
        $row->name = $request->name;
        $row->company = $request->company;
        $row->phone = $request->phone;
        $row->email = $request->email;
        $row->save();
        return redirect()->action([NotesController::class, 'index']);
    }

    // Display the specified resource.
    // @param  int  $id
    // @return \Illuminate\Http\Response
    public function show($id)
    {
        $row = Note::find($id);
        return view('show', ['row' => $row]);
    }

    // Show the form for editing the specified resource.
    // @param  int  $id
    // @return \Illuminate\Http\Response
    public function edit($id)
    {
        $row = Note::find($id);
        return view('edit', ['row' => $row]);
    }

    // Update the specified resource in storage.
    // @param  \Illuminate\Http\Request  $request
    // @param  int  $id
    // @return \Illuminate\Http\Response
    public function update(Request $request)
    {
        $row = Note::find($request->id);
        $row->fill($request->all())->save();
        return redirect('/');
    }

    public function delete($id)
    {
        $row = Note::find($id);
        return view('delete', ['row' => $row]);
    }

    // Remove the specified resource from storage.
    // @param  int  $id
    // @return \Illuminate\Http\Response
    public function destroy($id)
    {
        Note::destroy($id);
        return redirect('/');
    }
}
