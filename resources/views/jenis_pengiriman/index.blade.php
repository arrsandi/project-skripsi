@extends('layouts.app')
@section('title', 'Jenis Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Jenis Pengiriman</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->level == 'koordinator')
                        <a href="/jenis/input" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                            Tambah</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <th width="5%">No</th>
                            <th style="text-align: center">Nama Layanan</th>
                            <th style="text-align: center">Foto</th>
                            <th style="text-align: center">Deskripsi</th>
                            @if (auth()->user()->level == 'koordinator')
                                <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($jenis as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{ $item->nama_layanan }}</td>
                                    <td style="text-align: center"><img
                                            src="{{ asset('storage/jenis_pengiriman/' . $item->foto) }}" alt=""
                                            class="rounded" style="width: 150px">
                                    </td>
                                    <td style="text-align: justify">{{ $item->deskripsi }}</td>
                                    @if (auth()->user()->level == 'koordinator')
                                        <td style="text-align: center">
                                            <a href="/jenis/edit/{{ $item->id }}" class="btn btn-sm btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            <form role="alert" action="/jenis/delete/{{ $item->id }}" method="POST"
                                                style=" display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete"
                                                    onclick="selectItem('{{ $item->nama_layanan }}')"><i
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
                    title: `Apakah yakin ingin menghapus data jenis pengiriman "${selectedItem}"?`,
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
