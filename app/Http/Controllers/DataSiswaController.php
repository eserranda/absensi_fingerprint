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
            // $data = DataSiswa::all();
            $kelasFilter = $request->input('kelas');
            $query = DataSiswa::query();
            // Jika kelasFilter tidak kosong, tambahkan kondisi WHERE untuk filter berdasarkan kelas
            if ($kelasFilter) {
                $query->where('kelas', $kelasFilter);
            }

            $data = $query->latest('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="#" class="edit btn btn-success btn-sm" onclick="editSiswa(' . $row->id . ')">Edit</a> 
                    <a href="#" class="delete btn btn-danger btn-sm" onclick="deleteSiswa(' . $row->id . ')">Delete</a>
                    <a href="#" class="detail btn btn-primary btn-sm" onclick="detailSiswa(' . $row->id . ')">Detail</a>';
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

    /**
     * Show the form for creating a new resource.
     */
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
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'kelas' => 'required|string',
            'alamat' => 'required|string',
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

        $validator = Validator::make($request->all(), [
            'edit_nama' => 'required|string',
            'edit_nisn' => 'required|numeric',
            'edit_tempat_lahir' => 'required|string',
            'edit_tanggal_lahir' => 'required|date',
            'edit_jenis_kelamin' => 'required| string',
            'edit_agama' => 'required|string',
            'edit_kelas' => 'required|string',
            'edit_alamat' => 'required|string',
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
            'alamat' => $alamat
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
