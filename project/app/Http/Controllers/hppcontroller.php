<?php

namespace App\Http\Controllers;

use App\Models\entry;
use Illuminate\Http\Request;

class hppcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(entry $entry)
    {
        return view('check-hpp', [
            'data' => $entry->whereNull('hpp')->orderBy('id_entry', 'DESC')->get(),
            'title' => 'Cek HPP'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(entry $entry)
    {
        //
    }
}
