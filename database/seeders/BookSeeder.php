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
        $books = [
            [
                'kode_buku' => 'B001',
                'judul' => 'Belajar Laravel 11',
                'penulis' => 'Taylor Otwell',
                'penerbit' => 'Laravel Press',
                'tahun_terbit' => 2024,
                'kategori' => 'Pemrograman',
                'stok' => 10,
            ],
            [
                'kode_buku' => 'B002',
                'judul' => 'Pemrograman Web Modern',
                'penulis' => 'John Doe',
                'penerbit' => 'Tech Books',
                'tahun_terbit' => 2023,
                'kategori' => 'Teknologi',
                'stok' => 5,
            ],
            [
                'kode_buku' => 'B003',
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'tahun_terbit' => 2019,
                'kategori' => 'Psikologi',
                'stok' => 8,
            ],
            [
                'kode_buku' => 'B004',
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia',
                'tahun_terbit' => 2018,
                'kategori' => 'Self Improvement',
                'stok' => 12,
            ],
            [
                'kode_buku' => 'B005',
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'kategori' => 'Novel',
                'stok' => 7,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
