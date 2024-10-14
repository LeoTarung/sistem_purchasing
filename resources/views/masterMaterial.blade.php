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
                            <th class="text-center">Kode Material</th>
                            <th class="text-center">Nama Material</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr onclick="modalDetail({{ $d->id }})">
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Training -->
    <div class="modal fade border-0" id="newTraining" tabindex="-1" aria-labelledby="newTrainingLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm border-0">
            <div class="modal-content">
                <form action="/add/material" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">Tambah Material</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="fw-bold">Kode Produk</label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control" id="kode_produk" name="kode_produk" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="fw-bold">Nama Material</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="name" name="name" required>
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Modal Detail Training -->
    <div class="modal fade border-0" id="detailTraining" tabindex="-1" aria-labelledby="detailTrainingLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm border-0">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5 heading" id="detailTrainingLabel">Detail Material</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
            modalUrl = `/modal/detail-material/${id}`;
            $('#detailTraining').modal('show');
            $('.modal-body').load(modalUrl);
        }
    </script>
@endsection
