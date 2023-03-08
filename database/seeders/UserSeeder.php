<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                    'name'      => 'admin',
                    'username'  => 'admin', 
                    'password'  =>  bcrypt('admin'),
                    'level'     => 'admin',
                    'telp'       => 'admin'
                 
            ],
            [ 
                    'name'      => 'petugas',
                    'username'  => 'petugas', 
                    'password'  =>  bcrypt('petugas'),
                    'level'     => 'petugas',
                    'telp'       => 'petugas'
                 
            ],
            [
                    'name'      => 'masyarakat',
                    'username'  => 'masyarakat', 
                    'password'  =>  bcrypt('masyarakat'),
                    'level'     => 'masyarakat',
                    'telp'       => 'masyarakat'
                 
            ]
            ];
                foreach ($user as $key => $value){
                    User::create($value);
                }
        
    }
}