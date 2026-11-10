<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $kataKunci = $request->query('q');
        $kategoriId = $request->query('kategori');

        $daftarBuku = Book::with(['category', 'publisher'])
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($query) use ($kataKunci) {
                    $query->where('title', 'like', '%' . $kataKunci . '%')
                        ->orWhere('author_name', 'like', '%' . $kataKunci . '%');
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('category_id', $kategoriId);
            })
            ->latest('id')
            ->paginate(3)
            ->withQueryString();

        return view('buku.index', [
            'daftarBuku' => $daftarBuku,
            'daftarKategori' => Category::orderBy('name')->get(),
            'kataKunci' => $kataKunci,
            'kategoriId' => $kategoriId,
        ]);
    }

    public function show($id)
    {
        $buku = Book::with(['category', 'publisher'])->find($id);

        $bukuSerupa = $buku
            ? $buku->category->books()->whereKeyNot($buku->id)->latest('id')->limit(3)->get()
            : collect();

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id,
            'bukuSerupa' => $bukuSerupa,
        ]);
    }

    public function create()
    {
        return view('buku.create', [
            'daftarKategori' => Category::all(),
            'daftarPenerbit' => Publisher::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        Book::create($data);

        return redirect('/buku')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('buku.edit', [
            'buku' => Book::findOrFail($id),
            'daftarKategori' => Category::all(),
            'daftarPenerbit' => Publisher::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $buku = Book::findOrFail($id);

        $data = $request->validate($this->aturan(), $this->pesan());

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect('/buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        $buku->delete();

        return redirect('/buku')->with('success', 'Buku berhasil dihapus.');
    }

    private function aturan(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
            'price' => 'required|integer|min:0|max:99999999',
            'published_year' => 'nullable|integer|min:1900|max:2100',
            'stock' => 'required|integer|min:0|max:100000',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    private function pesan(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author_name.required' => 'Nama penulis wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'publisher_id.required' => 'Penerbit wajib dipilih.',
            'publisher_id.exists' => 'Penerbit tidak ditemukan.',
            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa bilangan bulat tanpa titik atau koma (contoh: 85000).',
            'price.min' => 'Harga tidak boleh negatif.',
            'price.max' => 'Harga terlalu besar (maksimal 99.999.999).',
            'published_year.integer' => 'Tahun terbit harus berupa angka bulat.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit maksimal 2100.',
            'stock.required' => 'Stok wajib diisi (isi 0 bila habis).',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'stock.max' => 'Stok terlalu besar (maksimal 100.000).',
            'cover.image' => 'Sampul harus berupa gambar.',
            'cover.mimes' => 'Sampul harus berformat JPG atau PNG.',
            'cover.max' => 'Ukuran sampul maksimal 2 MB.',
        ];
    }
}