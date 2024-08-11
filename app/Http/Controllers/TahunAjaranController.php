<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = TahunAjaran::all();
        return view('tahun-ajaran.index', compact('data'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajaran' => 'required|string',
            'semester' => 'required|string',
        ], [
            'required' => ':attribute harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $save = TahunAjaran::create([
            'tahun_ajaran' => $request->get('tahun_ajaran'),
            'semester' => $request->get('semester'),
        ]);


        if ($save) {
            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        } else {
            return response()->json(['message' => 'Data Tahun Ajaran Gagal Disimpan'], 500);
        }
    }

    public function updateActiveStatus($id)
    {

        TahunAjaran::query()->update(['is_active' => 0]);

        $record = TahunAjaran::find($id);
        if ($record) {
            $record->is_active = true;
            $record->save();
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully'], 200);
    }

    public function show(TahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAjaran $tahunAjaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran, $id)
    {
        try {
            $delete = $tahunAjaran::findOrFail($id);
            $delete->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
