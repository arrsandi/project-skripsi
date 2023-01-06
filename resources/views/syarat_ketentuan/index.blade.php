@extends('layouts.app')
@section('title', 'Syarat & Ketentuan Pengiriman')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Syarat & Ketentuan Pengiriman</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->level == 'koordinator')
                        <a href="/syarat_ketentuan/input" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                            Tambah</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <th width="5%">No</th>
                            <th style="text-align: center">Judul</th>
                            <th style="text-align: center">Syarat Ketentuan</th>
                            @if (auth()->user()->level == 'koordinator')
                                <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($syarat_ketentuan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{ $item->judul }}</td>
                                    <td style="text-align: justify">{!! $item->isi !!}</td>
                                    @if (auth()->user()->level == 'koordinator')
                                        <td style="text-align: center">
                                            <a href="/syarat_ketentuan/edit/{{ $item->id }}"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                            <form role="alert" action="/syarat_ketentuan/delete/{{ $item->id }}"
                                                method="POST" style=" display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete"
                                                    onclick="selectItem('{{ $item->judul }}')"><i
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
                    title: `Apakah yakin ingin menghapus data "${selectedItem}"?`,
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
