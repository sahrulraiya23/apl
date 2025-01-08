<!-- resources/views/kategori/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<base href="/public">
@include('kategori.head')

<body>
    <div class="container-scroller">
        <!-- Navbar -->
        @include('kategori.navbar')

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('kategori.sidebar')

            <div class="container mt-5">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Tambah Kategori</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori:</label>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                    placeholder="Masukkan nama kategori" required>
                                <div class="invalid-feedback">Nama kategori wajib diisi.</div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-2">Simpan</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
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
