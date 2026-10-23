@extends('layouts.app')

@section('title', 'Tambah Penerbit')

@section('content')
<h2 class="mb-4">Tambah Penerbit</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('penerbit.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Penerbit</label>
                <input type="text" name="name" id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Masukkan nama penerbit">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" name="city" id="city"
                    class="form-control @error('city') is-invalid @enderror"
                    value="{{ old('city') }}" placeholder="Masukkan kota">
                @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('penerbit.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection