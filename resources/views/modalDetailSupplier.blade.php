<main>
    <form action="/update/supplier/{{ $supp->id }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-auto d-flex align-items-center">
                <label for="staticEmail2" class="fw-bold">Nama</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="name" name="name" value="{{ $supp->name }}">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-auto d-flex align-items-center">
                <label for="staticEmail2" class="fw-bold">Alamat</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $supp->alamat }}">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-auto d-flex align-items-center">
                <label for="staticEmail2" class="fw-bold">Email</label>
            </div>
            <div class="col-auto">
                <input type="email" class="form-control" id="email" name="email" value="{{ $supp->email }}">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <button type="button" class="btn btn-danger w-100" onclick="hapus({{ $supp->id }})">Delete</button>
            </div>
        </div>
    </form>
    <script>
        function hapus(id) {
            Swal.fire({
                title: "Apakah Anda yakin akan menghapus itu?",
                text: "jika sudah terhapus, tidak akan bisa kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch('/delete/supplier/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-Token': csrfToken
                        }
                    }).then(response => {
                        if (response.ok) {
                            location.reload();
                        } else {
                            console.log('Delete request failed.');
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
</main>
