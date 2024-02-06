<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FingerprintController extends Controller
{
    public function index()
    {

        $data = Fingerprint::all();
        return view('fingerprint.data', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'modul_fingerprint' => 'required|string',
            'apiKey' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Fingerprint::create($request->all());
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fingerprint $fingerprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fingerprint $fingerprint, $id)
    {
        try {
            $del_siswa = Fingerprint::findOrFail($id);
            $del_siswa->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
