<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;

class KelasController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $data['result'] = Kelas::all();

        // Pass the data to the view
        return view('kelas.index', $data); 
    }

    public function create()
    {
        return view('kelas/form');
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_kelas' => 'required|max:100',
            'jurusan' => 'required|max:100'
        ];
        $this->validate($request, $rules);

        $input = $request -> all();
        $status = Kelas::create($input);


        if ($status) return redirect('/') -> with('success', 'Data berhasil ditambahkan');
        else return redirect('/') -> with('error', 'Data gagal ditambahkan');
    }

    public function edit($id) 
    {
        $data['result'] = Kelas::where('id_kelas', $id) -> first();
        return view('kelas/form') -> with($data);
    }

    public function update( Request $request, $id)
    {
        $rules = [
            'nama_kelas' => 'required|max:100',
            'jurusan' => 'required|max:100'
        ];
        $this -> validate($request, $rules);

        $input = $request->all();
        $result = Kelas::where('id_kelas', $id) -> first();
        $status = $result -> update($input);

        if ($status) return redirect('/') -> with('success', 'Data berhasil diubah!');
        else return redirect('/') -> with('error', 'Data gagal diubah!');
    }

    public function destroy(Request $request, $id)
    {
        $result = Kelas::where('id_kelas', $id)-> first();
        $status =  $result->delete();

        if ($status) return redirect('/')->with('success', 'Data telah berhasil dihapus!');
        else return redirect('/')->with('error', 'Data gagal dihapus!');
    }
}