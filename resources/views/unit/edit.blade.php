@extends('layouts.app')
@section('title', 'Unit')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="/unit">Unit</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-lg-12">
            <form action="/unit/update/{{ $unit->id }}" method="POST">
                @csrf
                @method('put')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Unit</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control  @error('nama') is-invalid @enderror" value="{{ $unit->nama }}"
                                required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <a href="/unit" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.row (main row) -->

@endsection

@push('script')
@endpush
