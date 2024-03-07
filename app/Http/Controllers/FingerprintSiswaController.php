<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use Illuminate\Http\Request;
use App\Models\FingerprintModul;
use App\Models\FingerprintSiswa;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class FingerprintSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FingerprintSiswa::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('id_siswa', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->nama;
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
        return view('fingerprint_siswa.data');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $finger = FingerprintModul::all();
        return view('fingerprint_siswa.add', compact('finger'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $kelas = "Kelas" . $request->input('id_modul_fingerprint');
        $finger = FingerprintModul::where('modul_fingerprint', $kelas)->first();
        if ($finger) {
            $id_modul_fingerprint = $finger->id;
        }
        $validator = Validator::make($request->all(), [
            'id_siswa' => 'required|unique:fingerprint_siswas',
            'id_modul_fingerprint' => 'required',
            'id_fingerprint' => 'required|unique:fingerprint_siswas',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kelas = "Kelas " . $request->input('id_modul_fingerprint');
        $finger = FingerprintModul::where('modul_fingerprint', $kelas)->first();
        $id_modul_fingerprint = null;

        if ($finger) {
            $id_modul_fingerprint = $finger->id;
        }

        // dd($id_modul_fingerprint);

        FingerprintSiswa::create([
            'id_siswa' => $request->id_siswa,
            'id_modul_fingerprint' => $id_modul_fingerprint,
            'id_fingerprint' => $request->id_fingerprint
        ]);
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(FingerprintSiswa $fingerprintSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FingerprintSiswa $fingerprintSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FingerprintSiswa $fingerprintSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FingerprintSiswa $fingerprintSiswa, $id)
    {
        try {
            $id_finger =  $fingerprintSiswa::findOrFail($id);
            $id_finger->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
