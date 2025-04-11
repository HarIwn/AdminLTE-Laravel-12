<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new \App\Models\User;
        $user -> nama_user = 'Admin';
        $user -> username = 'admin';
        $user -> password = bcrypt('admin');
        $user -> save();
    }
}
