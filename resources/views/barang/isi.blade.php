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

                    <!-- Form untuk mengimpor file XML (tersembunyi secara default) -->
                    <form action="{{ route('barang.importXml') }}" method="POST" enctype="multipart/form-data"
                        id="import-form" style="display: none;">
                        @csrf
                        <div class="form-group">
                            <label for="file">Pilih File XML untuk Diimpor</label>
                            <input type="file" name="file" class="form-control" accept=".xml" required>
                        </div>
                        <button type="submit" class="btn btn-success">Impor XML</button>
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
                            @foreach ($barang as $b)
                                <tr>
                                    <td class="font-weight-bold">{{ $b->nama_barang }}</td>
                                    <td>{{ $b->kategori->nama_kategori }}</td>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk menangani tampilnya form input file -->
