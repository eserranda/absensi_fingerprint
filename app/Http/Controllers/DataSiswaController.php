<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

            $data = $query->get();
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
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nisn' => 'required|numeric',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required| string',
            'agama' => 'required|string',
            'kelas' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $dataSiswa->find($id)->update($request->all());

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
