<div class="row">
    <div class="col-lg-12 d-flex grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between">
                    <h4 class="card-title mb-3">Project Status</h4>
                </div>
                <div class="table-responsive">
                    <!-- Tombol untuk menambah barang, mengunduh XML, dan impor XML -->
                    <div class="mb-3 d-flex justify-content-start">
                        <a href="{{ route('barang.create') }}" class="btn btn-success mr-2">Tambah Barang</a>
                        <a href="{{ route('barang.exportXml') }}" class="btn btn-dark mr-2">Unduh XML</a>
                    </div>

                    <!-- Form pencarian -->
                    <form action="{{ route('barang.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari barang atau kategori..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Barang -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barang as $b)
                                <tr>
                                    <td class="font-weight-bold">{{ $b->nama_barang }}</td>
                                    <td>{{ $b->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $b->stok }}</td>
                                    <td>{{ number_format($b->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $b->id) }}"
                                            class="btn btn-sm btn-secondary">Edit</a>
                                        <form action="{{ route('barang.destroy', $b->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data barang ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between mt-3">
                        <!-- Tombol Previous -->
                        @if ($barang->onFirstPage())
                            <span class="btn btn-secondary btn-sm disabled">Previous</span>
                        @else
                            <a href="{{ $barang->previousPageUrl() }}" class="btn btn-secondary btn-sm">Previous</a>
                        @endif

                        <!-- Tombol Next -->
                        @if ($barang->hasMorePages())
                            <a href="{{ $barang->nextPageUrl() }}" class="btn btn-secondary btn-sm">Next</a>
                        @else
                            <span class="btn btn-secondary btn-sm disabled">Next</span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk menangani tampilnya form input file -->
