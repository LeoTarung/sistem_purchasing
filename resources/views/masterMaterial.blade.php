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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Training -->
    <div class="modal fade border-0" id="newTraining" tabindex="-1" aria-labelledby="newTrainingLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg border-0">
            <div class="modal-content">
                <form action="/add/training-ojt" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">Tambah Material</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf

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
        <div class="modal-dialog modal-md border-0">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5 heading" id="detailTrainingLabel">Detail Training OJT</h1>
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
            modalUrl = `/detail-modal/training-ojt/${id}`;
            $('#detailTraining').modal('show');
            $('.modal-body').load(modalUrl);
        }
    </script>
@endsection
