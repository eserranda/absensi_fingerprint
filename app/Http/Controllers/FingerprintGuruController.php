<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use Illuminate\Http\Request;
use App\Models\FingerprintTmp;
use App\Models\FingerprintGuru;
use App\Models\FingerprintModul;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FingerprintGuruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FingerprintGuru::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_guru', function ($row) {
                    if ($row->id_guru) {
                        return $row->guru->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('id_modul_fingerprint', function ($row) {
                    if ($row->id_modul_fingerprint) {
                        return $row->modul_fingerprint->modul_fingerprint;
                    } else {
                        return '-';
                    }
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = ' 

                    <button class="btn btn-sm btn-danger btn-icon" aria-label="Button" onclick="hapus(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    </button> 
                   ';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('fingerprint_guru.data');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modul = "Guru dan Pegawai";
        $finger = FingerprintModul::where('modul_fingerprint', $modul)->first();

        return view('fingerprint_guru.add', (['finger' => $finger]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_guru' => 'required|unique:fingerprint_gurus',
            'id_modul_fingerprint' => 'required',
            'id_fingerprint' => 'required|unique:fingerprint_gurus',
        ], [
            'id_guru.unique' => 'ID GURU sudah terdaftar',
            'id_fingerprint.unique' => 'ID FINGERPRINT sudah terdaftar',
            'id_fingerprint.required' => 'ID FINGERPRINT harus diisi',
            'id_modul_fingerprint.required' => 'ID MODUL FINGERPRINT harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fingerprintTMP_Status = FingerprintTmp::where('apiKey', 'guru')->first();
        // $fingerprintTMP_Status->update(['id_finger' => null]);

        $fingerprintGuru = FingerprintModul::where('apiKey', 'guru')->first();
        $fingerprintGuru->update(['status' => 'scan']);

        $saveFingerGuru = FingerprintGuru::create($request->all());
        if ($saveFingerGuru) {
            $fingerprintTMP_Status->update(['id_finger' => null]);
            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FingerprintGuru $fingerprintGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FingerprintGuru $fingerprintGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FingerprintGuru $fingerprintGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FingerprintGuru $fingerprintGuru, $id)
    {
        try {
            $id_finger =  $fingerprintGuru::findOrFail($id);
            $id_finger->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
