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
        {{-- <div class="row d-flex justify-content-center mt-2">
    <div class="col-6 text-center">
        <h2>Data Karyawan</h2>
    </div>
</div> --}}
        @include('partial.session')
        <div class="row mt-2 ">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dataTraining" class="table table-bordered table-striped hover" style="background: transparent;">
                        <thead>
                            <th class="text-center">Nomor PO</th>
                            <th class="text-center">Tanggal Pembuatan</th>
                            <th class="text-center">Tanggal Pengiriman</th>
                            <th class="text-center">
                                Status
                            </th>
                            <th class="text-center">
                                Supplier
                            </th>
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
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">New Purchase Order</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Nomor PO</label>
                                    <input required="" class="input" type="number" name="name" id="name"
                                        placeholder="Nama" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Tanggal
                                        Pembuatan</label>
                                    <input required="" class="input" type="date" name="name" id="name"
                                        placeholder="Nama" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Supplier</label>
                                    <select id="section" class="js-example-basic-single form-control input"
                                        style="width: 100%" name="guidance">
                                        <option value="">-</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Tanggal
                                        Pengiriman</label>
                                    <input required="" class="input" type="date" name="name" id="name"
                                        placeholder="Nama" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 border-top" id="itemPO">
                            <div class="col-12 mt-2 mb-3">
                                <div class="row">
                                    <div class="col-auto d-flex align-items-center mt-1">
                                        <label for="exampleFormControlInput1" class="form-label heading">Item PO</label>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-success " style="border-radius: 20px;"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-danger" style="border-radius: 20px;"><i
                                                class="fa fa-minus"></i></button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-9">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label ">Material</label>
                                    <select id="section" class="js-example-basic-single form-control input"
                                        style="width: 100%" name="itemValue[]">
                                        <option value="">-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label ">Quantity</label>
                                    <input required="" class="input" type="number" name="qty[]" id="qty1"
                                        placeholder="Nama" required />
                                </div>
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
                    window.location.href = '/detail/po';
                }
            }],
        });

        // // Modal Detail Training
        // function modalDetail(id) {
        //     modalUrl = `/detail-modal/training-ojt/${id}`;
        //     $('#detailTraining').modal('show');
        //     $('.modal-body').load(modalUrl);
        // }
    </script>
@endsection
