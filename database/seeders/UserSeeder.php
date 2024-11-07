<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     */
    public function run(): void
    {
       $user = User::create([
            'name' => 'Pustakawan A',
            'email' => 'Pustakawan@gmail.com',
            'password'=> Hash::make('pustakawan')
        ]);
        $user->assignRole('pustakawan');
        $user->givePermissionTo('kelola_buku');

        $User = User::create([
            'name' => 'Mahasiswa B',
            'email' => 'mahasiswa@gmail.com',
            'password'=> Hash::make('mahasiswa')
        ]);
        $user->assignRole('member');
        $user->givePermissionTo('lihat_buku');
    }
}