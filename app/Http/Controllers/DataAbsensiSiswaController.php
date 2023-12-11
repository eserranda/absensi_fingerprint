<?php

namespace App\Http\Controllers;

use App\Models\DataAbsensiSiswa;
use Illuminate\Http\Request;

class DataAbsensiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data_absensi_siswa.data');
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
    public function show(DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAbsensiSiswa $dataAbsensiSiswa)
    {
        //
    }
}
