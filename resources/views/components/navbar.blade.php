<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/buku') }}">BookStore</a>

        <div class="navbar-nav ms-auto">
            <a class="nav-link" href="{{ url('/buku') }}">Buku</a>
            <a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a>
            <a class="nav-link" href="{{ url('/penerbit') }}">Penerbit</a>
        </div>
    </div>
</nav>