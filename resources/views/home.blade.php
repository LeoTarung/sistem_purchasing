@extends('main')
@section('content')
    @if (Auth::user()->role == 'Supplier')
        <div class="row">
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        Jumlah PO
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        PO Menunggu Validasi
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        PO Terkirim
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        Jumlah PO
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        PO Menunggu Validasi
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        PO Terkirim
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card ">
                    <div class="card-header fw-bold text-center">
                        PO Dalam Pengiriman
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
