<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use Illuminate\Http\Request;
use App\Models\FingerprintGuru;
use App\Models\FingerprintModul;
use App\Models\FingerprintStatus;
use App\Models\FingerprintTmp;
use Illuminate\Support\Facades\Validator;

class FingerprintModulController extends Controller
{

    public function updateStatus(Request $request)
    {
        $apiKey = $request->input('apiKey');
        if ($apiKey === 'guru') {
            $fingerprintStatus = FingerprintModul::where('apiKey', 'guru')->first();
            $fingerprintStatus->update(['status' => 'daftar']);
        }

        if ($fingerprintStatus) {
            return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }
    }
    public function saveID(Request $request)
    {
        $apiKey = $request->input('apiKey');

        if ($apiKey == "guru") {
            $id_finger = $request->input('id');
            $fingerprintTmp = FingerprintTmp::where('apiKey', $apiKey)->first();

            if ($fingerprintTmp) {
                $fingerprintTmp->update(['id_finger' => $id_finger]);
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'id_finger' =>  $id_finger], 200);
            } else {
                $saveData = FingerprintTmp::create(['apiKey' => $apiKey, 'id_finger' => $id_finger]);
                return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan', 'id_finger' =>  $id_finger], 200);
            }
        }
    }
    public function status(Request $request)
    {
        $apiKey = $request->input('apiKey');
        $finger = FingerprintModul::where('apiKey', $apiKey)->first();
        return response()->json($finger->status);

        // $data = null; // Inisialisasi $data dengan null

        // if ($finger) {
        //     $data = $finger->status; // Mengambil nilai status dari $finger
        //     return response()->json($data);
        // } else {
        //     return response()->json(['message' => 'Data tidak ditemukan'], 404);
        // };

        // $status = $fingerprintStatus->status;
        // dd($fingerprintStatus);

        // if ($fingerprintStatus) {
        //     return response()->json($apiKey);
        // } else {
        //     return response()->json(['message' => 'Data tidak ditemukan'], 404);
        // }
    }

    public function index()
    {

        $data = FingerprintModul::all();
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

        FingerprintModul::create($request->all());
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(FingerprintModul $fingerprintModul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FingerprintModul $fingerprintModul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FingerprintModul $fingerprintModul)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FingerprintModul $fingerprintModul, $id)
    {
        try {
            $del_siswa = FingerprintModul::findOrFail($id);
            $del_siswa->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}