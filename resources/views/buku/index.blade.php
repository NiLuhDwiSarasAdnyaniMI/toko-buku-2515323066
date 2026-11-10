    <form action="{{ route('buku.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="q" class="form-control"
                   placeholder="Cari judul atau penulis" value="{{ $kataKunci }}">
        </div>
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua kategori</option>
                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}" @selected($kategoriId == $kategori->id)>
                        {{ $kategori->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="penerbit" class="form-select">
                <option value="">Semua penerbit</option>
                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}" @selected($penerbitId == $penerbit->id)>
                        {{ $penerbit->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if ($kataKunci || $kategoriId || $penerbitId)
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </div>
    </form>