@extends('layouts.app')
@section('title', 'Manajemen Pengguna')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Manajemen Pengguna</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <a href="/pengguna/input" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                        Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <th width="5%">No</th>
                            <th style="text-align: center">Nama User</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Level</th>
                            <th style="text-align: center">Status</th>
                            <th width=" 15%" style="text-align: center"><i class="fas fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{ $user->name }}</td>
                                    <td style="text-align: center">{{ $user->email }}</td>
                                    @if ($user->level == 'koordinator')
                                        <td style="text-align: center">Koordinator</td>
                                    @elseif ($user->level == 'owner')
                                        <td style="text-align: center">Owner</td>
                                    @elseif($user->level == 'pelanggan')
                                        <td style="text-align: center">Pelanggan</td>
                                    @else
                                        <td style="text-align: center">Staff</td>
                                    @endif

                                    @if ($user->status == 1)
                                        <td style="text-align: center">Aktif</td>
                                    @else
                                        <td style="text-align: center">Tidak Aktif</td>
                                    @endif

                                    <td style="text-align: center">
                                        <a href="/pengguna/edit/{{ $user->id }}" class="btn btn-sm btn-info"><i
                                                class="fas fa-edit"></i></a>
                                        @if (auth()->user()->id != $user->id)
                                            <form role="alert" action="/pengguna/delete/{{ $user->id }}"
                                                method="POST" style=" display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete"
                                                    onclick="selectItem('{{ $user->name }}')"><i
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
                    title: `Apakah yakin ingin menghapus akun "${selectedItem}"?`,
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
