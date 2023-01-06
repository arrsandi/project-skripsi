@extends('layouts.app')
@section('title', 'Biaya Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Biaya Pengiriman</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            @if (auth()->user()->level == 'koordinator' || auth()->user()->level == 'owner')
                <div class="card">
                    <div class="card-header">
                        @if (auth()->user()->level == 'koordinator')
                            <a href="/biaya_pengiriman/input" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                                Tambah</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <th width="5%">No</th>
                                <th style="text-align: center">Nama Unit</th>
                                <th style="text-align: center">Rute Asal</th>
                                <th style="text-align: center">Rute Tujuan</th>
                                <th style="text-align: center">Jenis Pengiriman</th>
                                <th style="text-align: center">Biaya</th>
                                @if (auth()->user()->level == 'koordinator')
                                    <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                                @endif
                            </thead>
                            <tbody>
                                @foreach ($biaya_pengiriman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: center">{{ $item->unit->nama }}</td>
                                        <td style="text-align: center">{{ $item->rute_asal }}</td>
                                        <td style="text-align: center">{{ $item->rute_tujuan }}</td>
                                        <td style="text-align: center">{{ $item->jenis->nama_layanan }}</td>
                                        <td style="text-align: center">@currency($item->biaya_pengiriman)</td>
                                        @if (auth()->user()->level == 'koordinator')
                                            <td style="text-align: center">
                                                <a href="/biaya_pengiriman/edit/{{ $item->id }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                                <form role="alert" action="/biaya_pengiriman/delete/{{ $item->id }}"
                                                    method="POST" style=" display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger delete"
                                                        onclick="selectItem('{{ $item->rute_asal }} - {{ $item->rute_tujuan }}')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="myTable">
                            <thead>
                                <th width="5%">No</th>
                                <th style="text-align: center">Nama Unit</th>
                                <th style="text-align: center">Rute Asal</th>
                                <th style="text-align: center">Rute Tujuan</th>
                                <th style="text-align: center">Jenis Pengiriman</th>
                                <th style="text-align: center">Biaya</th>
                            </thead>
                            <tbody>
                                @foreach ($biaya_pengiriman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align: center">{{ $item->unit->nama }}</td>
                                        <td style="text-align: center">{{ $item->rute_asal }}</td>
                                        <td style="text-align: center">{{ $item->rute_tujuan }}</td>
                                        <td style="text-align: center">{{ $item->jenis->nama_layanan }}</td>
                                        <td style="text-align: center">@currency($item->biaya_pengiriman)</td>
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
                    title: `Apakah yakin ingin menghapus data biaya pengiriman "${selectedItem}"?`,
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
