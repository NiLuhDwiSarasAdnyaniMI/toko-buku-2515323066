<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Kategori Novel
        Book::create([
            'category_id' => 1,
            'title' => 'Senja di Ujung Kota',
            'author_name' => 'Dina Lestari',
            'price' => 70000
        ]);

        Book::create([
            'category_id' => 1,
            'title' => 'Langit Setelah Hujan',
            'author_name' => 'Raka Putra',
            'price' => 68000
        ]);

        // Kategori Pemrograman
        Book::create([
            'category_id' => 2,
            'title' => 'Belajar Java Dasar',
            'author_name' => 'Budi Santoso',
            'price' => 85000
        ]);

        Book::create([
            'category_id' => 2,
            'title' => 'Pemrograman Laravel',
            'author_name' => 'Andi Pratama',
            'price' => 95000
        ]);

        // Kategori Jaringan Komputer
        Book::create([
            'category_id' => 3,
            'title' => 'Dasar Jaringan Komputer',
            'author_name' => 'Agus Saputra',
            'price' => 90000
        ]);

        Book::create([
            'category_id' => 3,
            'title' => 'Administrasi Jaringan',
            'author_name' => 'Dewi Anggraini',
            'price' => 98000
        ]);
    }
}
