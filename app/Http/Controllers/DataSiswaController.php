<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelasFilter = $request->input('kelas');
            $query = DataSiswa::query();
            if ($kelasFilter) {
                $query->where('kelas', $kelasFilter);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal_lahir', function ($row) {
                    return \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = ' 
                    <button class="btn btn-sm btn-primary btn-icon" aria-label="Button" onclick="editSiswa(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    </button>
                    <button class="btn btn-sm btn-danger btn-icon" aria-label="Button" onclick="deleteSiswa(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    </button>
                    <button class="btn btn-sm btn-info btn-icon" aria-label="Button" onclick="detailSiswa(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    </button>
                    ';
                    return $actionBtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('data_siswa.data');
    }

    public function tes()
    {
        $data = DataSiswa::all();
        return response()->json(['data' =>  $data, 'status' => true, 'message' => 'Data Siswa'], 200);
    }

    public function getNISNSiswa($id)
    {
        $data = DataSiswa::where('id', $id)->first();
        if ($data) {
            $nisn = $data->nisn;
            return response()->json(['status' => true, 'data' => $nisn], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'NISN siswa tidak ditemukan'], 500);
        }
    }

    public function getKelasSiswa($id)
    {
        $data = DataSiswa::where('id', $id)->first()->kelas;
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Kelas siswa tidak ditemukan'], 500);
        }
    }

    public function create()
    {
        //
    }

    public function getDataSiswa(Request $request)
    {
        $data = [];

        if ($request->filled('q')) {
            $data = DataSiswa::select("nama", "id", "kelas")
                ->where('nama', 'LIKE', '%' . $request->get('q') . '%')
                ->get();
        }

        return response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nisn' => 'required|numeric|unique:data_siswas,nisn',
            // 'tempat_lahir' => 'required|string',
            'tempat_lahir' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'tanggal_lahir' => 'required|date|after_or_equal:2000-01-01',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'kelas' => 'required|string',
            'alamat' => 'required|string',
            'keterangan' => 'required|string',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
            'nisn.unique' => 'NISN sudah terdaftar',
            'nisn.string' => 'NISN harus berupa string',
            'nisn.numeric' => 'NISN harus berupa angka',
            'nisn.required' => 'NISN harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tempat_lahir.string' => 'Tempat lahir harus berupa string',
            'tempat_lahir.regex' => 'Tempat lahir harus berupa huruf',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'tanggal_lahir.after_or_equal' => 'Tahun kelahiran harus di atas 2000',
            'tanggal_lahir.string' => 'Tanggal lahir harus berupa string',
            'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'kelas.string' => 'Kelas harus berupa string',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.string' => 'Alamat harus berupa string',
            'keterangan.required' => 'Keterangan harus diisi',
            'agama.required' => 'Agama harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DataSiswa::create($request->all());
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSiswa $dataSiswa)
    {
        //
    }

    public function getID($id)
    {
        $data = DataSiswa::find($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = DataSiswa::find($id);
        return response()->json(['data' => $data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSiswa $dataSiswa)
    {
        $id = $request->input('edit_id');
        $nama = $request->input('edit_nama');
        $nisn = $request->input('edit_nisn');
        $tempat_lahir = $request->input('edit_tempat_lahir');
        $tanggal_lahir = $request->input('edit_tanggal_lahir');
        $jenis_kelamin = $request->input('edit_jenis_kelamin');
        $agama = $request->input('edit_agama');
        $kelas = $request->input('edit_kelas');
        $alamat = $request->input('edit_alamat');
        $keterangan = $request->input('edit_keterangan');

        $validator = Validator::make($request->all(), [
            'edit_nama' => 'required|string',
            'edit_nisn' => 'required|numeric',
            'edit_tempat_lahir' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'edit_tanggal_lahir' => 'required|date|after_or_equal:2000-01-01',
            'edit_jenis_kelamin' => 'required| string',
            'edit_agama' => 'required|string',
            'edit_kelas' => 'required|string',
            'edit_alamat' => 'required|string',
            'edit_keterangan' => 'required|string',
        ], [
            'edit_nama.required' => 'Nama harus diisi',
            'edit_nama.string' => 'Nama harus berupa string',
            'edit_nisn.unique' => 'NISN sudah terdaftar',
            'edit_nisn.string' => 'NISN harus berupa string',
            'edit_nisn.numeric' => 'NISN harus berupa angka',
            'edit_nisn.required' => 'NISN harus diisi',
            'edit_tempat_lahir.required' => 'Tempat lahir harus diisi',
            'edit_tempat_lahir.string' => 'Tempat lahir harus berupa string',
            'edit_tempat_lahir.regex' => 'Tempat lahir harus berupa huruf',
            'edit_tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'edit_tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal',
            'edit_tanggal_lahir.after_or_equal' => 'Tahun kelahiran harus di atas 2000',
            'edit_tanggal_lahir.string' => 'Tanggal lahir harus berupa string',
            'edit_jenis_kelamin.required' => 'Jenis kelamin harus diisi',
            'edit_kelas.required' => 'Kelas harus diisi',
            'edit_kelas.string' => 'Kelas harus berupa string',
            'edit_alamat.required' => 'Alamat harus diisi',
            'edit_alamat.string' => 'Alamat harus berupa string',
            'edit_keterangan.required' => 'Keterangan harus diisi',
            'edit_agama.required' => 'Agama harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $dataSiswa->find($id)->update([
            'nisn' => $nisn,
            'nama' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'agama' => $agama,
            'kelas' => $kelas,
            'alamat' => $alamat,
            'keterangan' => $keterangan
        ]);

        return response()->json(['message' => 'Data siswa berhasil diperbarui'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $del_siswa = DataSiswa::findOrFail($id);
            $del_siswa->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
