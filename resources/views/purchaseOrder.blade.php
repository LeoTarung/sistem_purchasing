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
                            @foreach ($dataPO as $item)
                                <tr onclick="detail('{{ $item->no_po }}')">
                                    <td>{{ $item->no_po }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_pembuatan)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tgl_pengiriman)->format('d-m-Y') }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->supplier->name }}</td>
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
        <div class="modal-dialog modal-lg border-0">
            <div class="modal-content">
                <form action="/add/po" method="post" class="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex justify-content-between">
                        <h1 class="modal-title fs-5 heading" id="newTrainingLabel">New Purchase Order</h1>
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
                                        id="tanggal_pembuatan" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3 form">
                                    <label for="exampleFormControlInput1" class="form-label heading">Supplier</label>
                                    <select id="section" class="js-example-basic-single form-control input"
                                        style="width: 100%" name="supplier">
                                        <option value="">-</option>
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
                                        id="tanggal_pengiriman" required />
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
                                        <div class="col-1">
                                            <button id="btn-add" class="btn btn-success" type="button"
                                                style="border-radius: 20px;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-1">
                                            <button id="btn-delete" class="btn btn-danger" type="button"
                                                style="border-radius: 20px;">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Row (First row by default) -->
                            <div class="row contentRow" id="contentRow1">
                                <div class="col-6">
                                    <div class="mb-3 form">
                                        <label class="form-label">Material</label>
                                        <select id="itemValue1" class="js-example-basic-single form-control input"
                                            style="width: 100%" name="itemValue[]" onchange="getPrice(1)">
                                            <option value="">-</option>
                                            @foreach ($mat as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3 form">
                                        <label class="form-label">Quantity</label>
                                        <input required class="input" type="number" name="qty[]" id="qty1"
                                            oninput="getPrice(1)" />
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="mb-3 form">
                                        <label class="form-label">Total Price</label>
                                        <input required class="input" type="number" name="total_price[]"
                                            id="price1" readonly />
                                    </div>
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
        @if (Auth::user()->role == 'Staff Purchasing')
            var table = $('#dataTraining').DataTable({
                "dom": '<"d-flex justify-content-between"<"pull-left"l><"pull-left"f><"pull-right"B>>tip',
                buttons: [{
                    text: '+',
                    className: 'btn btn-success mt-4', // Customize button style
                    action: function(e, dt, node, config) {
                        // Define what happens when the button is clicked
                        // window.location.href = '/detail/po';
                        $('#newTraining').modal('show');
                    }
                }],
            });
        @else
            var table = $('#dataTraining').DataTable({
                "dom": '<"d-flex justify-content-between"<"pull-left"l><"pull-left"f>>tip',
            });
        @endif

        // // Modal Detail Training
        // function modalDetail(id) {
        //     modalUrl = `/detail-modal/training-ojt/${id}`;
        //     $('#detailTraining').modal('show');
        //     $('.modal-body').load(modalUrl);
        // }

        let rowCount = 1; // Initial row count

        // Add new row on clicking the add button
        document.getElementById('btn-add').addEventListener('click', function() {
            rowCount++;
            const newRow = document.querySelector('.contentRow').cloneNode(true); // Clone the first row

            updateRowIds(newRow, rowCount); // Update the IDs and event listeners
            document.getElementById('itemPO').appendChild(newRow); // Add the new row
        });

        // Delete the last row on clicking the delete button
        document.getElementById('btn-delete').addEventListener('click', function() {
            if (rowCount > 1) {
                document.getElementById(`contentRow${rowCount}`).remove();
                rowCount--;
            }
        });

        // Update the IDs and listeners of a cloned row
        function updateRowIds(row, count) {
            row.id = `contentRow${count}`; // Update row ID

            row.querySelectorAll('input').forEach((input) => {
                if (input.name.includes('qty')) {
                    input.id = `qty${count}`;
                    input.value = ''; // Clear previous value
                    input.setAttribute('oninput', `getPrice(${count})`);
                }
                if (input.name.includes('total_price')) {
                    input.id = `price${count}`;
                    input.value = ''; // Clear previous value
                }
            });

            row.querySelectorAll('select').forEach((select) => {
                if (select.name.includes('itemValue')) {
                    select.id = `itemValue${count}`;
                    select.selectedIndex = 0; // Reset to the first option
                    select.setAttribute('onchange', `getPrice(${count})`);
                }
            });
        }

        // AJAX request to fetch the price and calculate total price
        function getPrice(rowNumber) {
            const itemId = document.getElementById(`itemValue${rowNumber}`).value; // Get material ID
            const qty = document.getElementById(`qty${rowNumber}`).value; // Get quantity

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

        function detail(fullPo) {
            // Extract the month and number from the full PO
            const parts = fullPo.split('/');
            const shortPo = `${parts[2]}-${parts[4]}`; // Example: "X-001"

            // Redirect to the detail route
            window.location.href = `/data/detail/po/${shortPo}`;
        }
    </script>
@endsection
