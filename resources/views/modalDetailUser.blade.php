<main>
    <form action="/update/user/{{ $data->id }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mb-3">
            <div class="col-auto d-flex align-items-center">
                <label for="staticEmail2" class="">Nama</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-auto d-flex align-items-center">
                <label for="staticEmail2" class="">Email</label>
            </div>
            <div class="col-auto">
                <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-auto d-flex align-items-center">
                <label for="staticEmail2" class="">Password</label>
            </div>
            <div class="col-auto">
                <!-- Leave the password field empty by default -->
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter new password">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6 d-flex align-items-center">
                <label for="staticEmail2" class="">Role</label>
            </div>
            <div class="col-12">
                <select class="form-select form-select-sm" aria-label="Small select example" name="role">
                    <option value="{{ $data->role }}">{{ $data->role }} </option>
                    @if ($data->role == 'Staff Purchasing')
                        <option value="Head Purchasing">Head Purchasing</option>
                        <option value="Supplier">Supplier</option>
                    @elseif ($data->role == 'Head Purchasing')
                        <option value="Staff Purchasing">Staff Purchasing</option>
                        <option value="Supplier">Supplier</option>
                    @else
                        <option value="Staff Purchasing">Staff Purchasing</option>
                        <option value="Head Purchasing">Head Purchasing</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-6 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="col-6 d-flex justify-content-center">
                <button type="button" class="btn btn-danger w-100" onclick="hapus({{ $data->id }})">Delete</button>
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
                    fetch('/delete/user/' + id, {
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
