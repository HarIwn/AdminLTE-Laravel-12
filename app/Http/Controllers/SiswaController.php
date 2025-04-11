<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\siswa;

class SiswaController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $data['result'] = siswa::all();
        return view('siswa/index')->with($data);
    }
    public function create()
    {
        return view('siswa/form');
    }

    public function store(Request $request)
    {
        $rules = [
            'nis' => 'required|unique:t_siswa',
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_kelas' => 'required|exists:t_kelas,id_kelas',
            'foto' => 'required|mimes:png,jpg,jpeg|max:512' 
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nis'] . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('uploads'), $filename);
            $input['foto'] = $filename;
        }

        $status = siswa::create($input);

        if ($status) {
            return redirect('/')->with('success', 'Data siswa berhasil ditambahkan!');
        } else {
            return redirect('/')->with('error', 'Data siswa gagal ditambahkan!');
        }
    }


    public function edit($id)
    {
        $data['result'] = siswa::where('nis', $id)->first();
        return view('siswa/form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $siswa = siswa::findOrFail($id); // Use the actual ID, not NIS, for finding the record

        $rules = [
            'nis' => 'required|unique:t_siswa,nis,' . $id, // Allow the current record's NIS
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_kelas' => 'required|exists:t_kelas,id_kelas',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:512' // Make foto optional on update
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nis'] . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move(public_path('uploads'), $filename);
            $input['foto'] = $filename;
        }

        $status = $siswa->update($input);

        if ($status) {
            return redirect('siswa')->with('success', 'Data siswa berhasil diubah!');
        } else {
            return redirect('siswa')->with('error', 'Data siswa gagal diubah!');
        }
    }


    public function destroy(Request $request, $id)
    {
        $result = siswa::where('nis', $id)->first();
        if (!$result) {
            return redirect('siswa')->with('error', 'Data siswa tidak ditemukan!');
        }

        $status = $result->delete();

        if ($status)
            return redirect('siswa')->with('success', 'Data siswa berhasil dihapus!');
        else
            return redirect('siswa')->with('error', 'Data siswa gagal dihapus!');
    }
}
