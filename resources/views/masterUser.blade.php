@extends('main')
@section('content')
    <style>
        table {
            font-size: 13px;
        }

        td {
            text-align: center;
            white-space: nowrap;
            cursor: pointer;
        }
    </style>

    <div class="container-fluid" id="isiModal">
        @include('partial.session')
        <div class="row mt-2 ">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dataTraining" class="table table-bordered table-striped hover" style="background: transparent;">
                        <thead>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $user)
                                <tr onclick="modalDetail({{ $user->id }})">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Modal Add Training -->
    <div class="modal fade border-0" id="newTraining" tabindex="-1" aria-labelledby="newTrainingLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm border-0">
            <div class="modal-content">
                <form action="/add/user" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">Tambah User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="">Nama</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="">Email</label>
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control"id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="">Password</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="">Role</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-select form-select-sm" aria-label="Small select example" id="role"
                                    name="role" required>
                                    <option>-</option>
                                    <option value="Staff Purchasing">Staff Purchasing</option>
                                    <option value="Head Purchasing">Head Purchasing</option>
                                    <option value="Supplier">Supplier</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detail Training -->
    <div class="modal fade border-0" id="detailTraining" tabindex="-1" aria-labelledby="detailTrainingLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm border-0">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5 heading" id="detailTrainingLabel">Detail User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body-Detail">
                </div>
            </div>
        </div>
    </div>
    <script>
        // Guidance Table
        var table = $('#dataTraining').DataTable({
            "dom": '<"d-flex justify-content-between"<"pull-left"l><"pull-left"f><"pull-right"B>>tip',
            buttons: [{
                text: '+',
                className: 'btn btn-success mt-4', // Customize button style
                action: function(e, dt, node, config) {
                    // Define what happens when the button is clicked
                    $('#newTraining').modal('show');
                }
            }],
        });

        // Modal Detail Training
        function modalDetail(id) {
            modalUrl = `/modal/detail-user/${id}`;
            $('#detailTraining').modal('show');
            $('#body-Detail').load(modalUrl);
        }
    </script>
@endsection
