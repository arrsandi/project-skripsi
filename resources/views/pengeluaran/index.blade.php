@extends('layouts.app')
@section('title', 'Pengeluaran')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Pengeluaran</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        @if (auth()->user()->level != 'owner')
                            <a href="/pengeluaran/input" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                                Tambah</a>
                        @endif
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#laporan-pengeluaran">
                            <i class="fa fa-file"></i> Cetak Laporan Pengeluaran
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <th width="5%">No</th>
                            <th style="text-align: center">Tanggal</th>
                            <th style="text-align: center">Keterangan</th>
                            <th style="text-align: center">Nominal</th>
                            @if (auth()->user()->level != 'owner')
                                <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: center">
                                        {{ Carbon\carbon::parse($item->tanggal)->translatedFormat('d-m-Y') }}</td>
                                    <td style="text-align: center">{{ $item->keterangan }}</td>
                                    <td style="text-align: right">@currency($item->jumlah)</td>
                                    @if (auth()->user()->level != 'owner')
                                        <td style="text-align: center">
                                            <a href="/pengeluaran/edit/{{ $item->id }}" class="btn btn-sm btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            @if (auth()->user()->level != 'staff')
                                                <form role="alert" action="/pengeluaran/delete/{{ $item->id }}"
                                                    method="POST" style=" display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete"
                                                        onclick="selectItem('{{ $item->keterangan }}')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row (main row) -->

    <!-- Modal -->
    <div class="modal fade" id="laporan-pengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Pengeluaran Per-periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/cetak_pengeluaran" target="_blank" enctype="multipart/form-data" method="GET">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal"
                                class="form-control @error('tanggal_awal') is-invalid @enderror">
                            @error('tanggal_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                class="form-control @error('tanggal_akhir') is-invalid @enderror">
                            @error('tanggal_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
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

            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: `Apakah yakin ingin menghapus data pengeluaran "${selectedItem}"?`,
                    text: "Data yang dihapus tidak bisa dikembalikan lagi!",
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
