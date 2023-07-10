@extends('layouts.admin')

@section('main-content')

    <?php
    $params_id = null;

    ?>
        <div class="row mt-5">
            <div class="col-lg-12 margin-tb">
                <div class="float-start">
                    <h2>Gambar</h2>
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-body">
                    <form action="{{ route('gambars.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Nama Gambar" class="form-control @error('judul') is-invalid @enderror">

                                @error('judul')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                                @error('image')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Caption</label>
                                <input type="text" name="caption" value="{{ old('caption') }}" placeholder="Masukkan Caption Gambar" class="form-control @error('caption') is-invalid @enderror">

                                @error('caption')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-upload"></i> UPLOAD</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>


                    </form>
                </div>

                <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Caption</th>
                                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($images as $no => $image)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($images->currentPage()-1) * $images->perPage() }}</th>
                                    <td><img src="{{ Storage::url('public/images/'.$image->link) }}" style="width: 150px"></td>
                                    <td>{{ $image->judul }}</td>
                                    <td>{{ $image->caption }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            
                                            <a type="button" id="{{ $image->id }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Apakah Kamu yakin?')"
                                                href="{{ url('/gambar/delete/' . $image->id) }}">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                    

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        <div>
@endsection
            