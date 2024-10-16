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
    @include('partial.session')
    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="fw-bold mb-2"> Tanggal Pembuatan </div>
                <div>{{ \Carbon\Carbon::parse($fullPO->tgl_pembuatan)->format('d-m-Y') }}</div>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <div class="row  ">
                <div class="fw-bold mb-2 d-flex justify-content-end"> Supplier </div>
                <div class=" d-flex justify-content-end">{{ $fullPO->supplier->name }}</div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <div class="row">
                <div class="fw-bold mb-2"> Tanggal Pengiriman </div>
                <div>{{ \Carbon\Carbon::parse($fullPO->tgl_pengiriman)->format('d-m-Y') }}</div>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <div class="row  ">
                <div class="fw-bold mb-2 d-flex justify-content-end"> Status </div>

                @if ($fullPO->status == 'Telah Divalidasi Kepala Purchasing')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-primary">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Menunggu Validasi Kepala Purchasing')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-warning">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Revisi')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-danger">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Revisi 1')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-primary">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Revisi 2')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-primary">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Revisi 3')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-primary">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Terkirim ke Supplier')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-info">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @elseif ($fullPO->status == 'Sedang dikirim ke RMA')
                    <div class=" d-flex justify-content-end"> <button class="btn btn-outline-success">
                            {{ $fullPO->status }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row mt-4 d-flex justify-content-center fw-bold">
        Detail Order
    </div>
    <div class="row mt-3">
        <table class="table table-striped  table-bordered ">
            <thead>
                <th class="text-center">No</th>
                <th class="text-center">Material Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Price</th>
                <th class="text-center">Total Price</th>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($itemPO as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $item->material->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->material->price }}</td>
                        <td>{{ $item->total_price }}</td>
                    </tr>
                    @php
                        $no = $no + 1;
                    @endphp
                @endforeach

            </tbody>
        </table>
    </div>
    <!-- Modal Notes Reject Training -->
    <div class="modal fade border-0" id="notes" tabindex="-1" aria-labelledby="detailTrainingLabel" aria-hidden="true">
        <div class="modal-dialog modal-md border-0">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5 heading" id="detailTrainingLabel">Notes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body-Detail">
                    <form action="/add/notes-reject/{{ $noPO }}" method="post">
                        @csrf
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                                name="notes">{{ $fullPO->notes }}</textarea>
                            <label for="floatingTextarea2">Comments</label>
                        </div>
                        <div class="form-floating mt-2">
                            <button class="btn btn-success" type="submit">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->role == 'Head Purchasing')
        <div class="row d-flex justify-content-center mt-5">
            {{-- <div class="col-3"> --}}
            <button class="btn btn-outline-success w-25 m-2 " type="button" onclick="acc()">Acc</button>
            {{-- </div> --}}
            {{-- <div class="col-3"> --}}
            <button class="btn btn-outline-danger w-25 m-2" type="button" onclick="reject()">Reject</button>
            {{-- </div> --}}
        </div>
    @endif
    @if (Auth::user()->role == 'Staff Purchasing')
        <div class="row d-flex justify-content-center mt-5">
            @if ($fullPO->status == 'Telah Divalidasi Kepala Purchasing')
                <button class="btn btn-outline-info w-25 m-2 " type="button" onclick="pass()">Kirim</button>
            @elseif ($fullPO->status == 'Revisi')
                <button class="btn btn-outline-warning w-25 m-2 " type="button" onclick="edit()">Edit</button>
                <button class="btn btn-outline-primary w-25 m-2 " type="button" onclick="showNotes()">Notes</button>
            @else
                <button class="btn btn-outline-warning w-25 m-2 " type="button" onclick="edit()">Edit</button>
            @endif
            <button class="btn btn-outline-danger w-25 m-2" type="button" onclick="hapus()">Delete</button>
        </div>
    @endif
    {{-- @if (Auth::user()->role == 'Supplier')
        <div class="row d-flex justify-content-center mt-5">
            @if ($fullPO->status == 'Telah Divalidasi Kepala Purchasing')
                <button class="btn btn-outline-info w-25 m-2 " type="button" onclick="pass()">Kirim</button>
            @elseif ($fullPO->status == 'Revisi')
                <button class="btn btn-outline-warning w-25 m-2 " type="button" onclick="edit()">Edit</button>
                <button class="btn btn-outline-primary w-25 m-2 " type="button" onclick="showNotes()">Notes</button>
            @else
                <button class="btn btn-outline-warning w-25 m-2 " type="button" onclick="edit()">Edit</button>
            @endif
            <button class="btn btn-outline-danger w-25 m-2" type="button" onclick="hapus()">Delete</button>
        </div>
    @endif --}}

    <!-- Modal Add Training -->
    <div class="modal fade border-0" id="newTraining" tabindex="-1" aria-labelledby="newTrainingLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg border-0">
            <div class="modal-content">
                <form action="/edit/po/{{ $noPO }}" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">Edit Purchase Order</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            {{-- <div class="col-6">
                                    <div class="mb-3 form">
                                        <label for="exampleFormControlInput1" class="form-label heading">Nomor PO</label>
                                        <input required="" class="input" type="number" name="no_po" id="no_po"
                                            readonly required />
                                    </div>
                                </div> --}}
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Tanggal
                                        Pembuatan</label>
                                    <input required="" class="input" type="date" name="tanggal_pembuatan"
                                        id="tanggal_pembuatan" required value="{{ $fullPO->tgl_pembuatan }}" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Supplier</label>
                                    <select id="section" class="js-example-basic-single form-control input"
                                        style="width: 100%" name="supplier">
                                        <option value="{{ $fullPO->supplier_id }}" style="background-color:aquamarine">
                                            {{ $fullPO->supplier->name }}</option>
                                        @foreach ($supp as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Tanggal
                                        Pengiriman</label>
                                    <input required="" class="input" type="date" name="tanggal_pengiriman"
                                        id="tanggal_pengiriman" required value="{{ $fullPO->tgl_pengiriman }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 border-top" id="itemPO">
                            <div class="row">
                                <div class="col-12 mt-2 mb-3">
                                    <div class="row">
                                        <div class="col-auto d-flex align-items-center mt-1">
                                            <label class="form-label heading">Item PO</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Row (First row by default) -->
                            @php
                                $no2 = 1;
                            @endphp
                            @foreach ($itemPO as $i)
                                <div class="row contentRow" id="contentRow1">
                                    <div class="col-5">
                                        <div class="mb-3 form">
                                            <label class="form-label">Material</label>
                                            <select id="itemValue{{ $no2 }}"
                                                class="js-example-basic-single form-control input" style="width: 100%"
                                                name="itemValue[]" onchange="getPrice({{ $no2 }})">
                                                <option value="{{ $i->material_id }}"
                                                    style="background-color:aquamarine">
                                                    {{ $i->material->name }}</option>
                                                @foreach ($mat as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mb-3 form">
                                            <label class="form-label">Quantity</label>
                                            <input required class="input" type="number" name="qty[]"
                                                id="qty{{ $no2 }}" oninput="getPrice({{ $no2 }})"
                                                value="{{ $i->qty }}" />
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mb-3 form">
                                            <label class="form-label">Total Price</label>
                                            <input required class="input" type="number" name="total_price[]"
                                                id="price{{ $no2 }}" value="{{ $i->total_price }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-1 mt-5">
                                        <button id="btn-delete" class="btn btn-danger" type="button"
                                            style="border-radius: 20px;">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                @php
                                    $no2 = $no2 + 1;
                                @endphp
                            @endforeach

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
    <script>
        let id = '{{ $fullPO->no_po }}';
        let idUser = {{ Auth::user()->id }};
        const parts = id.split('/');
        const shortPo = `${parts[2]}-${parts[4]}`; // Example: "X-001"

        function acc() {

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/acc-po" + "/" + shortPo,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',

                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // handle any errors that occur
                        }
                    });
                }
            });
        }

        function reject() {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#notes').modal('show');
                }
            });
        }

        function edit() {
            $('#newTraining').modal('show');
        }

        function showNotes() {
            $('#notes').modal('show');
        }

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
                    fetch('/delete/po/' + id, {
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

        function getPrice(rowNumber) {

            const itemId = document.getElementById(`itemValue${rowNumber}`).value; // Get material ID
            const qty = document.getElementById(`qty${rowNumber}`).value; // Get quantity
            console.log(rowNumber);
            console.log(itemId);
            console.log(qty);
            if (!itemId) return; // Exit if no material is selected

            // Fetch price from API
            fetch(`/api/get-price/${itemId}`) // Use absolute URL with leading slash
                .then(response => response.json())
                .then(data => {
                    const unitPrice = data.price || 0;
                    const totalPrice = unitPrice * qty;
                    document.getElementById(`price${rowNumber}`).value = totalPrice;
                })
                .catch(error => console.error('Error fetching price:', error));
        }

        function pass() {

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/send-po-supp" + "/" + shortPo + "/" + idUser,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',

                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error); // handle any errors that occur
                        }
                    });
                }
            });
        }
    </script>
@endsection
