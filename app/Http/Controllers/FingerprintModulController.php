<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Matpel;
use App\Models\DataGuru;
use App\Models\DataSiswa;
use App\Models\JamAbsensi;
use App\Models\Fingerprint;
use Illuminate\Http\Request;
use App\Models\AbsensiMatpel;
use App\Models\FingerprintTmp;
use App\Models\DataAbsensiGuru;
use App\Models\FingerprintGuru;
use App\Models\JadwalPelajaran;
use App\Models\DataAbsensiSiswa;
use App\Models\FingerprintModul;
use App\Models\FingerprintSiswa;
use App\Models\FingerprintStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FingerprintModulController extends Controller
{

    public function statusFingerprint(Request $request)
    {
        $apiKey = $request->input('apiKey');
        $finger = FingerprintModul::where('apiKey', $apiKey)->first();
        $mode = $finger->status;

        // Atur zona waktu yang diinginkan
        $timezone = 'Asia/Makassar';
        $now = Carbon::now($timezone);
        $finger->updated_at = $now;

        $finger->update();

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
            } else if ($cekMode->status === "matpel") {
                return response()->json(["mode" => $cekMode->status, "matpel" => $cekMode->matpel]);
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
            $cekMode = FingerprintModul::where('apiKey', $apiKey)->first();

            if ($cekMode->status === "hapus") {
                return response()->json(["mode" => $cekMode->status, "deleted_id" => $cekMode->deleted_id]);
            } else if ($cekMode->status === "matpel") {
                return response()->json(["mode" => $cekMode->status, "matpel" => $cekMode->matpel]);
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
        } else if ($apiKey == 'finger3') {
            $cekMode = FingerprintModul::where('apiKey', $apiKey)->first();

            if ($cekMode->status === "hapus") {
                return response()->json(["mode" => $cekMode->status, "deleted_id" => $cekMode->deleted_id]);
            } else if ($cekMode->status === "matpel") {
                return response()->json(["mode" => $cekMode->status, "matpel" => $cekMode->matpel]);
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
        }
    }

    public function getDataToday($id_matpel, $id_guru)
    {
        $dataToday = AbsensiMatpel::with(['guru', 'siswa', 'matpel'])
            ->where('id_matpel', $id_matpel)
            ->where('id_guru', $id_guru)
            ->whereDate('created_at', Carbon::today())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $countDataToday = AbsensiMatpel::where('id_matpel', $id_matpel)
            ->where('id_guru', $id_guru)
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($dataToday->isEmpty()) {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }

        return response()->json(['message' => 'success', 'data' => $dataToday, 'count' => $countDataToday], 200);
    }

    // mode absen Masuk dan Pulang
    public function modeAbsen(Request $request)
    {
        $modul   = $request->input('modul');
        $mode_absen = $request->input('mode_absen');

        // $updateModul = FingerprintModul::where('apiKey', $modul)->update([
        //     'status' => 'scan',
        //     'mode_absen' => $mode_absen,
        // ]);

        $updateModul = FingerprintModul::where('apiKey', $modul)->update([
            'status' => 'scan',
            'mode_absen' => $mode_absen,
            'updated_at' => DB::raw('updated_at') // Menggunakan nilai 'updated_at' yang ada, tidak melakukan perubahan
        ]);

        if (!$updateModul) {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }

        return response()->json(['message' => 'Data berhasil diperbarui', 'status' => $updateModul], 200);
    }

    public function updateStatusToMatpel(Request $request)
    {
        $modul   = $request->input('kelas');
        $matpel = $request->input('matpel');

        $updateModul = FingerprintModul::where('modul_fingerprint', $modul)->update([
            'status' => 'matpel',
            'matpel' => $matpel,
        ]);

        if (!$updateModul) {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }

        return response()->json(['message' => 'Data berhasil diperbarui', 'status' => $updateModul], 200);
    }

    // reser all modul kembali ke mode Scan Mode Absen "Masuk"
    public function resetAllModul(FingerprintModul $fingerprintModul)
    {
        $resetModul = FingerprintModul::query()->update([
            'status' => 'scan',
            'mode_absen' => 0,
            'matpel' => null,
            'deleted_id' => 0,
            'deleted_status' => 0,
            'response' => null,
            'updated_at' => DB::raw('updated_at') // Menggunakan nilai 'updated_at' yang ada, tidak melakukan perubahan
        ]);

        if (!$resetModul) {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }

        return response()->json(['message' => 'Modul Berhasi di reset'], 200);
    }

    public function resetModul(Request $request)
    {
        $modul   = $request->input('kelas');

        $resetModul = FingerprintModul::where('modul_fingerprint', $modul)->update([
            'status' => 'scan',
            'matpel' => null,
            'updated_at' => DB::raw('updated_at') // Menggunakan nilai 'updated_at' yang ada, tidak melakukan perubahan
        ]);

        if (!$resetModul) {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }

        return response()->json(['message' => 'Data berhasil diperbarui', 'status' => $resetModul], 200);
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
            $fingerprintStatus->update([
                'status' => 'daftar',
                'updated_at' => DB::raw('updated_at') // Menggunakan nilai 'updated_at' yang ada, tidak melakukan perubahan
            ]);
        }

        if ($fingerprintStatus) {
            return response()->json(['message' => 'Data berhasil diperbarui'], 200);
        } else {
            return response()->json(['message' => 'Data gagal diperbarui'], 500);
        }
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

        if ($getApiKey === null) {
            return response()->json(['status' => false, 'message' => 'Data modul tidak ditemukan'], 404);
        }

        $apiKeyValue = $getApiKey->apiKey;
        $getMode =  $getApiKey->status;

        if ($apiKeyValue === 'guru' && $getMode === 'scan') {
            $getIdGuru = FingerprintGuru::where('id_fingerprint', $idFinger)->first();

            if ($getIdGuru === null) {
                return response()->json(['status' => false, 'message' => 'Data guru tidak ditemukan'], 404);
            }

            $getDataGuru = DataGuru::where('id',  $getIdGuru->id_guru)->first();

            $timezone = 'Asia/Makassar';
            $now = Carbon::now();
            $now->setTimezone($timezone);

            $hari = $now->locale('id')->dayName;

            $tanggalAbsen = $now->toDateString();
            $jamMasuk = $now->format('H:i:s');

            $getHari = JamAbsensi::where('hari', $hari)->first();

            if ($getHari === null) {
                return response()->json(['status' => false, 'message' => 'Belum ada hari terdafatar'], 404);
            }

            if ($jamMasuk > $getHari->jam_masuk) {
                $keterangan = 'Terlambat';
            } else {
                $keterangan = '-';
            }


            $cek_Mode_absen = DataAbsensiGuru::where('id_guru', $getDataGuru->id)->where('tanggal_absen', $tanggalAbsen)->first();
            if ($cek_Mode_absen === null) {
                $saveData = DataAbsensiGuru::create(
                    [
                        'id_guru' => $getDataGuru->id,
                        'id_fingerprint' => $idFinger,
                        'tanggal_absen' => $tanggalAbsen,
                        'jam_masuk' => $jamMasuk,
                        'keterangan' => $keterangan,
                        'mode_absen' => 0
                    ]
                );
            }

            $saveData = DataAbsensiGuru::firstOrCreate(
                [
                    'id_guru' => $getDataGuru->id,
                    'id_fingerprint' => $idFinger,
                    'tanggal_absen' => $tanggalAbsen
                ],
                [
                    'jam_masuk' => $jamMasuk,
                    'keterangan' => $keterangan
                ]
            );

            if ($saveData) {
                return response()->json(['status' => true, 'message' => 'Data berhasil disimpan'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Data gagal disimpan'], 500);
            }
        } else if ($apiKeyValue != 'guru' && $getMode === 'matpel') {
            $modul = FingerprintModul::where('apiKey', $apiKeyValue)->first();

            $getIdSiswa = FingerprintSiswa::where('id_fingerprint', $idFinger)
                ->where('id_modul_fingerprint', $modul->id)
                ->first();

            if ($getIdSiswa === null) {
                return response()->json(['status' => false, 'message' => 'Data siswa tidak ditemukan'], 404);
            }

            $idMatepel = Matpel::where('nama_matpel', $modul->matpel)->first();

            $getIdGuru = JadwalPelajaran::where('id_matpel', $idMatepel->id)->first();

            $now = Carbon::now();
            $tanggal  = $now->toDateString();
            $hari = $now->dayName;
            $id_siswa = $getIdSiswa->id_siswa;
            $kelas =  $getIdSiswa->siswa->kelas;
            $id_guru = $getIdGuru->id_guru;
            $id_matpel = $idMatepel->id;
            $keterangan = "Hadir";

            //  tambah data jika datanya belum ada
            $absensi = AbsensiMatpel::firstOrCreate(
                [
                    'id_siswa' => $id_siswa,
                    'kelas' => $kelas,
                    'tanggal' => $tanggal,
                    'id_matpel' => $id_matpel
                ],
                [
                    'hari' => $hari,
                    'id_guru' => $id_guru,
                    'keterangan' => $keterangan
                ]
            );

            if ($absensi->wasRecentlyCreated) {
                return response()->json(['status' => true, 'message' => 'Data absen matpel berhasil disimpan'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Data absen matpel sudah ada'], 200);
            }
        } else {
            $getDataModul = FingerprintModul::where('apiKey', $apiKeyValue)->first()->id;

            $getIdSiswa = FingerprintSiswa::where('id_fingerprint', $idFinger)
                ->where('id_modul_fingerprint', $getDataModul)
                ->first();

            if ($getIdSiswa === null) {
                return response()->json(['status' => false, 'message' => 'Data siswa tidak ditemukan'], 404);
            }

            $idSiswaValue  = $getIdSiswa->id_siswa;

            $getDataSiswa = DataSiswa::where('id', $idSiswaValue)->first();

            $timezone = 'Asia/Makassar';
            $now = Carbon::now();
            $now->setTimezone($timezone);

            $hari = $now->locale('id')->dayName;

            $tanggalAbsen = $now->toDateString();
            $jamMasuk = $now->format('H:i:s');

            $getHari = JamAbsensi::where('hari', $hari)->first();

            if ($jamMasuk > $getHari->jam_masuk) {
                $keterangan = 'Terlambat';
            } else {
                $keterangan = '-';
            }

            $saveData = DataAbsensiSiswa::create([
                'id_siswa' => $getDataSiswa->id,
                'kelas' => $getDataSiswa->kelas,
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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'modul_fingerprint' => 'required|string|unique:fingerprint_moduls,modul_fingerprint',
            'apiKey' => 'required|string|unique:fingerprint_moduls,apiKey',
        ], [
            'modul_fingerprint.required' => 'Modul Fingerprint harus diisi',
            'modul_fingerprint.unique' => 'Modul Fingerprint sudah ada',
            'apiKey.required' => 'API Key harus diisi',
            'apiKey.unique' => 'API Key sudah ada',
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

    public function update(Request $request, FingerprintModul $fingerprintModul)
    {
        //
    }

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
