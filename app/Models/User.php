<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 't_login';
    public $primaryKey = 'id_login';
    protected $fillable = [
        'nama_user',
        'username',
        'password'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];
}
