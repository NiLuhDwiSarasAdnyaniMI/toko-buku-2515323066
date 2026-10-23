<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
{
    public function index()
    {
        $daftarPenerbit = Publisher::orderBy('name')->get();

        return view('penerbit.index', compact('daftarPenerbit'));
    }

    public function create()
    {
        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:publishers,name',
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.unique' => 'Nama penerbit sudah terdaftar.',
            'city.required' => 'Kota wajib diisi.',
        ]);

        Publisher::create($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('publishers', 'name')->ignore($penerbit->id),
            ],
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.unique' => 'Nama penerbit sudah terdaftar.',
            'city.required' => 'Kota wajib diisi.',
        ]);

        $penerbit->update($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        $penerbit->delete();

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil dihapus.');
    }
}