@extends('layouts.app')
@section('title', 'Konfirmasi Pembayaran')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/pengiriman">Pengiriman</a></li>
    <li class="breadcrumb-item"><a href="/pengiriman/detail/{{ $pengiriman->id }}">Detail Transaksi Pengiriman</a></li>
    <li class="breadcrumb-item active">Konfirmasi Pembayaran</li>
@endsection

@section('content')

    <!-- Main row -->
    <!-- Left col -->

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Informasi Pembayaran <a href="/pengiriman/detail/{{ $pengiriman->id }}" class="btn btn-sm btn-danger"
                        style="float: right"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>No. Invoice</td>
                                <td>{{ $pengiriman->noinvoice }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>{{ Carbon\carbon::parse($pengiriman->tanggal)->translatedFormat('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>{{ $pengiriman->nama_pengirim }}</td>
                            </tr>
                            <tr>
                                <td>Total Biaya</td>
                                <td><b>@currency($pengiriman->total_biaya_keseluruhan)</b></td>
                            </tr>
                            <tr>
                                <td>Status Pengiriman</td>
                                <td>
                                    @if ($pengiriman->status_pengiriman == 'Selesai')
                                        <button class="btn btn-xs btn-success">Selesai</button>
                                    @elseif($pengiriman->status_pengiriman == 'OTW')
                                        <button class="btn btn-xs btn-info">OTW</button>
                                    @elseif($pengiriman->status_pengiriman == 'Pembayaran Ditolak')
                                        <button class="btn btn-xs btn-danger">Pembayaran Ditolak</button>
                                    @elseif($pengiriman->status_pengiriman == 'Pembayaran Diverifikasi')
                                        <button class="btn btn-xs btn-secondary">Pembayaran Diverifikasi</button>
                                    @elseif($pengiriman->status_pengiriman == 'Menunggu Pembayaran')
                                        <button class="btn btn-xs btn-warning">Menunggu Pembayaran</button>
                                    @else
                                        <button class="btn btn-xs btn-danger">Diproses</button>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Informasi Transfer</b></td>
                                <td>
                                    <ol>
                                        <li>Lakukan pembayaran saat status pengiriman sudah menunggu pembayaran</li>
                                        <li>Pembayaran dapat melalui Rek. BCA <b>8275028165 a/n Andry</b> </li>
                                    </ol>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Konfirmasi Pembayaran
                </div>
                <div class="card-body">
                    <form action="/pengiriman/konfirmasi_pembayaran/{{ $pengiriman->id }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="bukti_pembayaran">
                                Unggah Bukti Pembayaran
                                @if ($pengiriman->bukti_pembayaran != null)
                                    ({{ $pengiriman->bukti_pembayaran }})
                                @endif
                            </label>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran"
                                class="mt-2 @error('bukti_pembayaran') is-invalid @enderror">
                            @error('bukti_pembayaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" type="submit"><i
                                    class="fa fa-upload"></i>Unggah</button>
                    </form>
                    @if ($pengiriman->user_id == auth()->user()->id ||
                        (auth()->user()->level == 'koordinator' && $pengiriman->bukti_pembayaran != null))
                        <form role="alert" action="/pengiriman/batal_konfirmasi/{{ $pengiriman->id }}" method="POST"
                            style=" display: inline-block;">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-danger delete"
                                onclick="selectItem('{{ $pengiriman->noinvoice }}')" style=" display: inline-block;"><i
                                    class="fas fa-window-close"></i>
                                Batal Unggah</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- /.row (main row) -->






@endsection

@push('script')
    <script>
        let selectedItem = ''

        const selectItem = (item) => {
            selectedItem = item
        }

        $(document).ready(function() {

            //event : alert 
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: `Apakah yakin ingin membatalkan konfirmasi pembayaran No. Invoice "${selectedItem}"?`,
                    text: "",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    reverseButtons: true,
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                });

            });
        });
    </script>
    <x-toast />
@endpush
