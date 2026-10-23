<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
   private array $daftarBuku = [
    1 => [
        'judul' => 'Danur',
        'penulis' => 'Risa Saraswati',
        'harga' => 85000,
    ],
    2 => [
        'judul' => 'KKN di Desa Penari',
        'penulis' => 'SimpleMan',
        'harga' => 95000,
    ],
    3 => [
        'judul' => 'Mieruko-chan Vol. 1',
        'penulis' => 'Tomoki Izumi',
        'harga' => 45000,
    ],

    ];

    public function index()
    {
        return view('buku.index', ['daftarBuku' => $this->daftarBuku]);
    }
 
    public function show($id)
    {
        $buku = $this->daftarBuku[$id] ?? null;
        return view('buku.show', ['buku' => $buku, 'id' => $id]);
    }
}