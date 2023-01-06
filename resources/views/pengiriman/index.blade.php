@extends('layouts.app')
@section('title', 'Transaksi Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Pengiriman</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            @if (auth()->user()->level == 'pelanggan')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <a href="/pengiriman/input" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                                Tambah</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <th width="5%">No</th>
                                <th style="text-align: center">Tanggal</th>
                                <th style="text-align: center">No. Invoice</th>
                                <th style="text-align: center">Total Biaya Keseluruhan</th>
                                <th style="text-align: center">Status Pengiriman</th>
                                <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($pengiriman_pelanggan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: center">
                                            {{ Carbon\carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}</td>
                                        <td style="text-align: center">{{ $item->noinvoice }}</td>
                                        <td style="text-align: center">
                                            @if ($item->status_pengiriman == 'Diproses')
                                                <button class="btn btn-xs btn-danger">Diproses</button>
                                            @else
                                                @currency($item->total_biaya_keseluruhan)
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if ($item->status_pengiriman == 'Selesai')
                                                <button class="btn btn-xs btn-success">Selesai</button>
                                            @elseif($item->status_pengiriman == 'OTW')
                                                <button class="btn btn-xs btn-info">OTW</button>
                                            @elseif($item->status_pengiriman == 'Pembayaran Ditolak')
                                                <button class="btn btn-xs btn-danger">Pembayaran Ditolak</button>
                                            @elseif($item->status_pengiriman == 'Pembayaran Diverifikasi')
                                                <button class="btn btn-xs btn-secondary">Pembayaran Diverifikasi</button>
                                            @elseif($item->status_pengiriman == 'Menunggu Pembayaran')
                                                <button class="btn btn-xs btn-warning">Menunggu Pembayaran</button>
                                            @else
                                                <button class="btn btn-xs btn-danger">Diproses</button>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <a href="/pengiriman/detail/{{ $item->id }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="/pengiriman/edit/{{ $item->id }}" class="btn btn-sm btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            @if ($item->status_pengiriman == 'Diproses')
                                                <form role="alert1" action="/pengiriman/delete/{{ $item->id }}"
                                                    method="POST" style=" display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete"
                                                        onclick="selectItem('{{ $item->noinvoice }}')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                @if (auth()->user()->level != 'owner')
                                    <a href="/pengiriman/input" class="btn btn-sm btn-primary"><i
                                            class="fas fa-plus-circle"></i>
                                        Tambah</a>
                                @endif
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#laporan-pemasukan">
                                    <i class="fa fa-file"></i> Cetak Laporan Pemasukan
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body" id="read">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <th width="5%">No</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">No. Invoice</th>
                                <th style="text-align: center">Nama Pengirim</th>
                                <th style="text-align: center">Total Biaya</th>
                                <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($pengiriman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: center">
                                            @if ($item->status_pengiriman == 'Selesai')
                                                <button class="btn btn-xs btn-success">Selesai</button>
                                            @elseif($item->status_pengiriman == 'OTW')
                                                <button class="btn btn-xs btn-info">OTW</button>
                                            @elseif($item->status_pengiriman == 'Pembayaran Ditolak')
                                                <button class="btn btn-xs btn-danger">Pembayaran Ditolak</button>
                                            @elseif($item->status_pengiriman == 'Pembayaran Diverifikasi')
                                                <button class="btn btn-xs btn-secondary">Pembayaran
                                                    Diverifikasi</button>
                                            @elseif($item->status_pengiriman == 'Menunggu Pembayaran')
                                                <button class="btn btn-xs btn-warning">Menunggu Pembayaran</button>
                                            @else
                                                <button class="btn btn-xs btn-danger">Diproses</button>
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{ $item->noinvoice }}</td>
                                        <td style="text-align: center">{{ $item->nama_pengirim }}</td>
                                        <td style="text-align: right">@currency($item->total_biaya_keseluruhan)</td>
                                        <td style="text-align: center">
                                            <a href="/pengiriman/detail/{{ $item->id }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                            @if (auth()->user()->level == 'staff' || auth()->user()->level == 'koordinator')
                                                <a href="/pengiriman/edit/{{ $item->id }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            @endif
                                            <form role="alert" action="/pengiriman/delete/{{ $item->id }}"
                                                method="POST" style=" display: inline-block;">
                                                @if (auth()->user()->level == 'koordinator')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete"
                                                        onclick="selectItem('{{ $item->noinvoice }}')"><i
                                                            class="fas fa-trash"></i></button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <!-- /.row (main row) -->

    <!-- Modal -->
    <div class="modal fade" id="laporan-pemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Pemasukan Per-periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/pengiriman/cetak_pemasukan" target="_blank" enctype="multipart/form-data" method="GET">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal"
                                class="form-control  @error('tanggal_awal') is-invalid @enderror">
                            @error('tanggal_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                class="form-control  @error('tanggal_akhir') is-invalid @enderror">
                            @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection

@push('script')
    <script>
        let selectedItem = ''

        const selectItem = (item) => {
            selectedItem = item
        }

        $(document).ready(function() {

            $('#myTable').DataTable();
            //event : delete 
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: `Apakah yakin ingin menghapus data pengiriman "${selectedItem}"?`,
                    text: "Data yang dihapus tidak bisa dikembalikan lagi!",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Tidak",
                    reverseButtons: true,
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                });

            });

            $("form[role='alert1']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: `Apakah yakin ingin membatalkan pengiriman "${selectedItem}"?`,
                    text: "Data yang dihapus tidak bisa dikembalikan lagi!",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Tidak",
                    reverseButtons: true,
                    confirmButtonText: "Ya",
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
