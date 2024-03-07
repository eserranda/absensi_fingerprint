<?php

namespace App\Http\Controllers;

use App\Models\DataGuru;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function dataUserGuru(Request $request)
    {
        if ($request->ajax()) {
            $roleName = $request->input('role');
            if ($roleName != '') {
                $usersWithRole = User::whereHas('roles', function ($query) use ($roleName) {
                    $query->where('name', $roleName);
                })->get();
            } else {
                $usersWithRole = User::with('roles')->get();
            }

            return DataTables::of($usersWithRole)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('name', function ($row) {
                    if ($row->id_guru) {
                        return $row->guru->nama;
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
                    <button class="btn btn-sm btn-primary btn-icon" aria-label="Button" onclick="edit(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    </button>
                    <button class="btn btn-sm btn-info btn-icon" aria-label="Button" onclick="info(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('akun.guru.data');
    }
    function dataUserSiswa(Request $request)
    {
        if ($request->ajax()) {
            $roleName = "siswa";
            if ($roleName != '') {
                $usersWithRole = User::whereHas('roles', function ($query) use ($roleName) {
                    $query->where('name', $roleName);
                })->get();
            } else {
                $usersWithRole = User::with('roles')->get();
            }

            return DataTables::of($usersWithRole)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('name', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->nama;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('kelas', function ($row) {
                    if ($row->id_siswa) {
                        return $row->siswa->kelas;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <button class="btn btn-sm btn-primary btn-icon" aria-label="Button" onclick="edit(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    </button>

                    <button class="btn btn-sm btn-danger btn-icon" aria-label="Button" onclick="hapus(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                    </button>
                    <button class="btn btn-sm btn-info btn-icon" aria-label="Button" onclick="info(' . $row->id . ')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('akun.guru.data');
    }

    function roles()
    {
        $roles = Role::where('name', '!=', 'siswa')->get();
        if (!empty($roles)) {
            return response()->json(['status' => true, 'data' => $roles], 200);
        } else {
            return response()->json(['status' => false, 'data' => $roles], 401);
        }
    }

    function akun_siswa()
    {
        $data = User::all();
        return view('akun.siswa.data', compact('data'));
    }

    function akun_guru()
    {
        $data = User::all();
        return view('akun.guru.data', compact('data'));
    }

    function addUser()
    {
        return view('akun.add');
    }

    public function storeUserGuru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_guru' => 'required|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ], [
            'id_guru.required' => 'Kolom NIP harus diisi.',
            'id_guru.unique' => 'NIP sudah terdaftar.',
            'username.required' => 'Kolom username harus diisi.',
            'username.string' => 'Kolom username harus berupa teks.',
            'username.max' => 'Kolom username tidak boleh lebih dari :max karakter.',
            'username.unique' => 'NUPTK sudah digunakan.',

            'email.required' => 'Kolom email harus diisi.',
            'email.string' => 'Kolom email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Kolom email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Kolom password harus diisi.',
            'password.string' => 'Kolom password harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $user = User::create([
            'id_guru' => request('id_guru'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        if ($user) {
            $idGuru = $request->input('id_guru');
            $rolesID = $request->get('role_id');

            $guru = User::where('id_guru', $idGuru)->first();
            if ($guru) {
                foreach ($rolesID as $roleID) {
                    $guru->roles()->attach($roleID);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Guru tidak ditemukan',], 404);
            }

            return response()->json([
                'status' => true,  'message' => 'Pendaftaran Berhasil',   'data' => $user,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran Gagal',
            ], 500);
        }
    }
    public function storeUserSiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_siswa' => 'required|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ], [
            'id_siswa.required' => 'Kolom NISN harus diisi.',
            'id_siswa.unique' => 'NISN sudah terdaftar.',
            'username.required' => 'Kolom username harus diisi.',
            'username.string' => 'Kolom username harus berupa teks.',
            'username.max' => 'Kolom username tidak boleh lebih dari :max karakter.',
            'username.unique' => 'NUPTK sudah digunakan.',

            'email.required' => 'Kolom email harus diisi.',
            'email.string' => 'Kolom email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Kolom email tidak boleh lebih dari :max karakter.',
            'email.unique' => 'Email sudah digunakan.',

            'password.required' => 'Kolom password harus diisi.',
            'password.string' => 'Kolom password harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $user = User::create([
            'id_siswa' => request('id_siswa'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        if ($user) {
            $idSiswa = $request->input('id_siswa');
            $rolesID = 2; // id role Siswa 
            $siswa = User::where('id_siswa', $idSiswa)->first();
            if ($siswa) {
                $siswa->roles()->attach($rolesID);
            } else {
                return response()->json(['success' => false, 'message' => 'Data Siswa tidak ditemukan',], 404);
            }

            return response()->json([
                'status' => true,  'message' => 'Pendaftaran Berhasil',   'data' => $user,
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran Gagal',
            ], 500);
        }
    }

    public function updateAkunSiswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_id_siswa' => 'required ',
            'edit_username' => 'required|string|max:255',
            'edit_email' => 'required|string|email|max:255',
            'edit_password' => 'required|string',
        ], [
            'edit_id_siswa.required' => 'Kolom NISN harus diisi.',
            'edit_id_siswa.unique' => 'NISN sudah terdaftar.',
            'edit_username.required' => 'Kolom username harus diisi.',
            'edit_username.string' => 'Kolom username harus berupa teks.',
            'edit_username.max' => 'Kolom username tidak boleh lebih dari :max karakter.',
            'edit_username.unique' => 'NUPTK sudah digunakan.',

            'edit_email.required' => 'Kolom email harus diisi.',
            'edit_email.string' => 'Kolom email harus berupa teks.',
            'edit_email.email' => 'Format email tidak valid.',
            'edit_email.max' => 'Kolom email tidak boleh lebih dari :max karakter.',
            'edit_email.unique' => 'Email sudah digunakan.',

            'edit_password.required' => 'Kolom password harus diisi.',
            'edit_password.string' => 'Kolom password harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        User::where('id', $request->input('edit_id'))->update([
            'id_siswa' => $request->input('edit_id_siswa'),
            'username' => $request->input('edit_username'),
            'email' => $request->input('edit_email'),
            'password' => bcrypt($request->input('edit_password')),
        ]);

        return response()->json(['message' => 'Data siswa berhasil diperbarui'], 200);
    }


    public function show(string $id)
    {
        $idUser = User::where('id', $id)->first();
        if ($idUser) {
            return response()->json(['status' => true, 'data' => $idUser]);
        } else {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
    }


    public function destroy($id)
    {
        try {
            $delete = User::findOrFail($id);
            $delete->delete();

            return response()->json(['status' => true, 'message' => 'Data berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menghapus data'], 500);
        }
    }
}
