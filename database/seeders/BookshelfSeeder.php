<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookshelfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("bookshelves")->insert([
            [
            'code' => 'RAk0A',
            'name' => 'Manga',
            ],
        [
            'code' => 'RAk1A',
            'name' => 'Novel',
        ],
        [
            'code' => 'TAG2B',
            'name' => 'Kitab Kuning',
        ],
    ]);
    }
}
