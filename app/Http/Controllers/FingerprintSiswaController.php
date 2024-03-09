<?php

namespace App\Http\Controllers;

use App\Models\Fingerprint;
use Illuminate\Http\Request;
use App\Models\FingerprintModul;
use App\Models\FingerprintSiswa;
use App\Models\FingerprintTmp;
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
                    // <button class="btn btn-sm btn-danger btn-icon" aria-label="Button" onclick="hapus(' . $row->id . ',' . $row->id_modul_fingerprint . ', ' . $row->id_fingerprint . ')">
                    // <svg xmlns="http:www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    // <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    // <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    // </svg>
                    // </button> 
                    $actionBtn = '
                    <a href="fingerprint_siswa/detail/' . $row->id . '" class="btn btn-sm btn-info btn-icon" aria-label="Button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    </a>
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
        $kelas =  $request->input('id_modul_fingerprint');
        $finger = FingerprintModul::where('modul_fingerprint', $kelas)->first();

        if ($finger) {
            $id_modul_fingerprint = $finger->id;
        }
        $validator = Validator::make($request->all(), [
            'id_siswa' => 'required|unique:fingerprint_siswas',
            'id_modul_fingerprint' => 'required',
            'id_fingerprint' => 'required|unique:fingerprint_siswas',
        ], [
            'id_siswa.required' => 'ID siswa tidak boleh kosong',
            'id_siswa.unique' => 'ID siswa sudah ada',
            'id_modul_fingerprint.required' => 'Modul Fingerprint tidak boleh kosong',
            'id_fingerprint.required' => 'Modul Fingerprint tidak boleh kosong',
            'id_fingerprint.unique' => 'Modul Fingerprint sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kelas =  $request->input('id_modul_fingerprint');
        $finger = FingerprintModul::where('modul_fingerprint', $kelas)->first();
        $id_modul_fingerprint = null;

        if ($finger) {
            $id_modul_fingerprint = $finger->id;
        }

        FingerprintSiswa::create([
            'id_siswa' => $request->id_siswa,
            'id_modul_fingerprint' => $id_modul_fingerprint,
            'id_fingerprint' => $request->id_fingerprint
        ]);

        $updateModulFingerprint = FingerprintModul::where('modul_fingerprint', $kelas)->update(['status' => 'scan']);
        $updateFingerprintTmp = FingerprintTmp::where('apikey',  $finger->apiKey)->update(['id_finger' => null]);
        if (!$updateModulFingerprint || !$updateFingerprintTmp) {
            return response()->json(['message' => 'Status gagal diupdate'], 500);
        }
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function show(FingerprintSiswa $fingerprintSiswa, $id)
    {
        $data = FingerprintSiswa::find($id);
        return view('fingerprint_siswa.detail', compact('data'));
    }

    public function edit(FingerprintSiswa $fingerprintSiswa)
    {
        //
    }

    public function update(Request $request, FingerprintSiswa $fingerprintSiswa)
    {
        //
    }

    public function deleted_id(Request $request)
    {
        $modul_fingerprint = $request->input('modul_fingerprint');
        $id_finger = $request->input('id_finger');

        $updateMode = FingerprintModul::where('modul_fingerprint', $modul_fingerprint)->update([
            'status'  => "hapus",
            'deleted_id' => $id_finger
        ]);

        if ($updateMode) {
            return response()->json(["deleted_id" => $id_finger]);
        }

        // return response()->json(["deleted_id" => $deleted_id]);
    }

    public function status_deleted($modul, $id_finger)
    {
        $getStatusDeleted = FingerprintModul::where('modul_fingerprint', $modul)
            ->where('deleted_id', $id_finger)
            ->first();

        if ($getStatusDeleted == null) {
            return response()->json(["deleted_id" =>  0], 200);
        }
        if ($getStatusDeleted->deleted_status == 1) {
            // kembalikan ke mode scan
            $reset = FingerprintModul::where('modul_fingerprint', $modul)->update([
                'deleted_status' => 0,
                'deleted_id' => null,
                'status' => "scan",
            ]);

            // hapus id finger dari tabel fingerprint siswa
            $delete = FingerprintSiswa::where('id_modul_fingerprint', $getStatusDeleted->id)
                ->where('id_fingerprint', $id_finger)
                ->update([
                    'id_fingerprint' => null
                ]);

            if ($reset && $delete) {
                return response()->json(["deleted_id" => $getStatusDeleted->deleted_status], 200);
            }
            // return response()->json(["deleted_id" => $getStatusDeleted->deleted_status], 200);
        } else if ($getStatusDeleted->deleted_status == 0) {
            return response()->json(["deleted_id" =>  0], 200);
        }
    }

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