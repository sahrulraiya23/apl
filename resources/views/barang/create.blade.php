<!-- resources/views/barang/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<base href="/public">
@include('barang.head')

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        @include('barang.navbar')

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('barang.sidebar')

            <div class="container mt-5">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Tambah Barang</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang:</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control"
                                    placeholder="Masukkan nama barang" required>
                                <div class="invalid-feedback">Nama barang wajib diisi.</div>
                            </div>

                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori:</label>
                                <select name="kategori_id" class="form-control" id="kategori_id" class="form-select"
                                    required>
                                    <option value="" disabled selected>Pilih kategori</option>
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Kategori wajib dipilih.</div>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok:</label>
                                <input type="number" name="stok" id="stok" class="form-control"
                                    placeholder="Masukkan jumlah stok" required>
                                <div class="invalid-feedback">Stok wajib diisi.</div>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga:</label>
                                <input type="number" name="harga" id="harga" class="form-control"
                                    placeholder="Masukkan harga barang" step="0.01" required>
                                <div class="invalid-feedback">Harga wajib diisi.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-2">Simpan</button>
                                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bootstrap validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>
