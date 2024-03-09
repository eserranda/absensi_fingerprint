<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\Fingerprint;
use Illuminate\Http\Request;
use App\Models\FingerprintTmp;
use App\Models\DataAbsensiGuru;
use App\Models\DataSiswa;
use App\Models\FingerprintGuru;
use App\Models\FingerprintModul;
use App\Models\FingerprintSiswa;
use App\Models\FingerprintStatus;
use App\Models\JamAbsensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class FingerprintModulController extends Controller
{

    public function statusFingerprint(Request $request)
    {
        $apiKey = $request->input('apiKey');
        $finger = FingerprintModul::where('apiKey', $apiKey)->first();
        $mode = $finger->status;

        if ($apiKey == 'guru') {
            $lastRecord = FingerprintGuru::latest()->first();
            if (!$lastRecord) {
                $lastID = 0;
            } else {
                $lastID = $lastRecord->id_fingerprint;
            }

            return response()->json(["mode" => $mode, "last_id" => $lastID]);
        } else if ($apiKey == 'finger1') {
            $cekMode = FingerprintModul::where('apiKey', $apiKey)->first();

            if ($cekMode->status === "hapus") {
                return response()->json(["mode" => $cekMode->status, "deleted_id" => $cekMode->deleted_id]);
            } else {

                $idModul = FingerprintModul::where('apiKey', $apiKey)->first()->id;
                $lastRecord = FingerprintSiswa::where('id_modul_fingerprint', $idModul)->latest()->first();
                if (!$lastRecord) {
                    $lastID = 0;
                } else {
                    $lastID = $lastRecord->id_fingerprint;
                }
                return response()->json(["mode" => $mode, "last_id" => $lastID]);
            }
        } else if ($apiKey == 'finger2') {
            $idModul = FingerprintModul::where('apiKey', $apiKey)->first()->id;
            $lastRecord = FingerprintSiswa::where('id_modul_fingerprint', $idModul)->latest()->first();
            if (!$lastRecord) {
                $lastID = 0;
            } else {
                $lastID = $lastRecord->id_fingerprint;
            }

            return response()->json(["mode" => $mode, "last_id" => $lastID]);
        } else if ($apiKey == 'finger3') {
            $idModul = FingerprintModul::where('apiKey', $apiKey)->first()->id;
            $lastRecord = FingerprintSiswa::where('id_modul_fingerprint', $idModul)->latest()->first();
            if (!$lastRecord) {
                $lastID = 0;
            } else {
                $lastID = $lastRecord->id_fingerprint;
            }

            return response()->json(["mode" => $mode, "last_id" => $lastID]);
        }
    }

    public function getFingerID($apiKey)
    {
        $fingerprintStatus = FingerprintTmp::where('apiKey', $apiKey)->first();
        if ($fingerprintStatus) {
            $data = $fingerprintStatus->id_finger;
            return response()->json($data);
        } else {
            // Tangani jika tidak ada data yang ditemukan
            return response()->json(['error' => 'Data not found'], 404);
        }
    }
    public function getFingerIDSiswa($apiKey)
    {
        $fingerprintModul = FingerprintModul::where('modul_fingerprint', $apiKey)->first()->apiKey;
        $fingerprintStatus = FingerprintTmp::where('apiKey', $fingerprintModul)->first()->id_finger;
        if ($fingerprintStatus != null) {
            $resetModul = FingerprintModul::where('modul_fingerprint', $apiKey)->update(['status' => 'scan']);
            if ($resetModul) {
                return response()->json($fingerprintStatus);
            }
        } else {
            // Tangani jika tidak ada data yang ditemukan
            return response()->json(['error' => 'Data not found'], 404);
        }
    }

    public function updateStatusFingerGuru(Request $request)
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

    public function deletedStatus(Request $request)
    {
        $apiKey = $request->input('apiKey');
        $value = $request->input('value');
        $updateDeletedStatus = FingerprintModul::where('apiKey', $apiKey)->update(['deleted_status' =>  $value]);
        if ($updateDeletedStatus) {
            return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }
        // dd($updateDeletedStatus);
        // if ($apiKey === 'guru') {
        //     $fingerprintStatus->update(['status' => 'daftar']);
        // }

        // if ($fingerprintStatus) {
        //     return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        // } else {
        //     return response()->json(['message' => 'Data gagal diperbarui'], 500);
        // }
    }

    public function updateStatusFingerSiswa(Request $request)
    {
        $apiKey = $request->input('kelas');
        $fingerprintModul = FingerprintModul::where('modul_fingerprint', $apiKey)->first()->apiKey;

        if ($fingerprintModul === 'finger1') {
            $fingerprintStatus = FingerprintModul::where('apiKey', $fingerprintModul)->first();
            $fingerprintStatus->update(['status' => 'daftar']);
        } else if ($fingerprintModul === 'finger2') {
            $fingerprintStatus = FingerprintModul::where('apiKey', $fingerprintModul)->first();
            $fingerprintStatus->update(['status' => 'daftar']);
        } else if ($fingerprintModul === 'finger3') {
            $fingerprintStatus = FingerprintModul::where('apiKey', $fingerprintModul)->first();
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
            $fingerprintTmp = FingerprintTmp::updateOrCreate(
                ['apiKey' => $apiKey], // Kriteria pencarian
                ['id_finger' => $id_finger] // Data yang ingin diperbarui atau dibuat jika tidak ditemukan
            );

            if ($fingerprintTmp) {
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'id_finger' =>  $id_finger], 200);
            }
        } else if ($apiKey == "finger1") {
            $id_finger = $request->input('id');

            $fingerprintTmp = FingerprintTmp::updateOrCreate(
                ['apiKey' => $apiKey], // Kriteria pencarian
                ['id_finger' => $id_finger] // Data yang ingin diperbarui atau dibuat jika tidak ditemukan
            );

            if ($fingerprintTmp) {
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'id_finger' =>  $id_finger], 200);
            }
        } else if ($apiKey == "finger2") {
            $id_finger = $request->input('id');

            $fingerprintTmp = FingerprintTmp::updateOrCreate(
                ['apiKey' => $apiKey], // Kriteria pencarian
                ['id_finger' => $id_finger] // Data yang ingin diperbarui atau dibuat jika tidak ditemukan
            );

            if ($fingerprintTmp) {
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'id_finger' =>  $id_finger], 200);
            }
        } else if ($apiKey == "finger3") {
            $id_finger = $request->input('id');

            $fingerprintTmp = FingerprintTmp::updateOrCreate(
                ['apiKey' => $apiKey], // Kriteria pencarian
                ['id_finger' => $id_finger] // Data yang ingin diperbarui atau dibuat jika tidak ditemukan
            );

            if ($fingerprintTmp) {
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui', 'id_finger' =>  $id_finger], 200);
            }
        }
    }

    public function absen(Request $request)
    {
        $apiKey = $request->input('apiKey');
        $idFinger = $request->input('id_finger');

        $getApiKey = FingerprintModul::where('apiKey', $apiKey)->first();
        $apiKey =  $getApiKey->apiKey;

        if ($apiKey === 'guru') {
            $getIdGuru = FingerprintGuru::where('id_fingerprint', $idFinger)->first();
            $getDataGuru = DataGuru::where('id', $getIdGuru->id_guru)->first();

            $timezone = 'Asia/Makassar';
            $now = Carbon::now();
            $now->setTimezone($timezone);

            $hari = Carbon::now()->locale('id')->dayName;

            $tanggalAbsen = $now->toDateString();
            $jamMasuk = $now->format('H:i');

            $getHari = JamAbsensi::where('hari', $hari)->first();

            if ($jamMasuk > $getHari->jam_masuk) {
                $keterangan = 'Terlambat';
            } else {
                $keterangan = '-';
            }

            $saveData = DataAbsensiGuru::create([
                'id_guru' => $getDataGuru->id,
                'id_fingerprint' => $idFinger,
                'tanggal_absen' => $tanggalAbsen,
                'jam_masuk' => $jamMasuk,
                'keterangan' => $keterangan,
            ]);

            if ($saveData) {
                return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Data gagal disimpan'], 500);
            }
        } else if ($apiKey === 'finger1') { // finger X IPS I
            $getIdSiswa = FingerprintSiswa::where('id_fingerprint', $idFinger)->first();
            $getDataGuru = DataSiswa::where('id', $getIdSiswa->id_siswa)->first();

            $timezone = 'Asia/Makassar';
            $now = Carbon::now();
            $now->setTimezone($timezone);

            $hari = Carbon::now()->locale('id')->dayName;

            $tanggalAbsen = $now->toDateString();
            $jamMasuk = $now->format('H:i');

            $getHari = JamAbsensi::where('hari', $hari)->first();

            if ($jamMasuk > $getHari->jam_masuk) {
                $keterangan = 'Terlambat';
            } else {
                $keterangan = '-';
            }

            $saveData = DataAbsensiGuru::create([
                'id_guru' => $getDataGuru->id,
                'id_fingerprint' => $idFinger,
                'tanggal_absen' => $tanggalAbsen,
                'jam_masuk' => $jamMasuk,
                'keterangan' => $keterangan,
            ]);

            if ($saveData) {
                return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Data gagal disimpan'], 500);
            }
        }
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
