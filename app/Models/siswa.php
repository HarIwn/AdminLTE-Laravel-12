<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    public $primaryKey = 'nis';
    protected $table = 't_siswa';
    protected $fillable = [
        'nis', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telp', 'id_kelas', 'foto'
    ];

    public function getJenisKelaminDisplayAttribute()
    {
        if(@$this -> attributes['jenis_kelamin'] == 'L') return 'Laki-Laki';
        if(@$this -> attributes['jenis_kelamin'] == 'P') return 'Perempuan';
        return '-';
    }

    public function kelas()
    {
        return $this -> hasOne('\App\Models\Kelas', 'id_kelas', 'id_kelas');
    }
}
