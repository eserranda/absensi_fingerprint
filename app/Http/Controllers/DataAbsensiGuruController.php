<?php

namespace App\Http\Controllers;

use App\Models\DataAbsensiGuru;
use Illuminate\Http\Request;

class DataAbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data_absensi_guru.data');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataAbsensiGuru $dataAbsensiGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAbsensiGuru $dataAbsensiGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAbsensiGuru $dataAbsensiGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAbsensiGuru $dataAbsensiGuru)
    {
        //
    }
}
