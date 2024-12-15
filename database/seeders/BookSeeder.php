<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            "title" => "Jarkom - Filosofi",
            "author" => "GTA",
            "year" => 2024,
            "publisher" => "UNSUR Mengantuk",
            "city" => "Cianjur",
            "cover" => "https://i.pinimg.com/736x/4c/7f/74/4c7f7435d3266eb30a0ce880ad51c114.jpg",
            "bookshelf_id" => 1
        ]);
        
        Book::create([
            "title" => "Pemrograman Web Lanjut",
            "author" => "Indra",
            "year" => 2023,
            "publisher" => "Golang Press",
            "city" => "Jakarta",
            "cover" => "https://via.placeholder.com/200x300?text=Pemrograman+Web+Lanjut",
            "bookshelf_id" => 2
        ]);
        
        Book::create([
            "title" => "Cloud Computing Basics",
            "author" => "Sarah",
            "year" => 2021,
            "publisher" => "Tech Publisher",
            "city" => "Bandung",
            "cover" => "https://via.placeholder.com/200x300?text=Cloud+Computing+Basics",
            "bookshelf_id" => 3
        ]);
        
        Book::create([
            "title" => "Dasar-Dasar Sistem Operasi",
            "author" => "Agus",
            "year" => 2022,
            "publisher" => "Techno Books",
            "city" => "Surabaya",
            "cover" => "https://via.placeholder.com/200x300?text=Dasar+Sistem+Operasi",
            "bookshelf_id" => 4
        ]);
    }
}
