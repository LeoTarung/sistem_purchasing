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
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $d)
                                <tr class="" onclick="modalDetail({{ $d->id }})">
                                    <td>{{ $no }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->alamat }}</td>
                                </tr>
                                @php
                                    $no = $no + 1;
                                @endphp
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
                <form action="/add/supplier" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">Tambah Supplier</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="fw-bold">Nama</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="fw-bold">Email</label>
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-auto d-flex align-items-center">
                                <label for="staticEmail2" class="fw-bold">Alamat</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
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
                    <h1 class="modal-title fs-5 heading" id="detailTrainingLabel">Detail Training OJT</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="body-supplier" class="modal-body">

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
            modalUrl = `/modal/detail-supplier/${id}`;
            $('#detailTraining').modal('show');
            $('#body-supplier').load(modalUrl);
        }
    </script>
@endsection
