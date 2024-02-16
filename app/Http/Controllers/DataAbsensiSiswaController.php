<?php

namespace App\Http\Controllers;

use App\Models\DataAbsensiSiswa;
use App\Models\DataSiswa;
use App\Models\FingerprintSiswa;
use Illuminate\Http\Request;

class DataAbsensiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FingerprintSiswa::all();
        return view('data_absensi_siswa.data', compact('data'));
    }


    public function detail(Request $request)
    {
        $id = $request->input('id');
        $absensi = DataAbsensiSiswa::findOrFail($id);
        return response()->json($absensi);
    }

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
    public function show(DataAbsensiSiswa $dataAbsensiSiswa, $id)
    {
        $data = DataSiswa::find($id);
        return view('data_absensi_siswa.absensi', compact('data'));
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
