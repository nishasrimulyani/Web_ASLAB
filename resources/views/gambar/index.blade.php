@extends('layouts.admin')

@section('main-content')

<?php
  $params_id = null;
?>
<div class="row">
  <div class="col-12">
    <div class="card d-flex border-0 p-0">
      <div class="card-header d-flex border-0 pt-6 pb-6 px-1" style="background: none">
        <div class="card-title">
          <h3 class="card-label text-capitalize m-0 p-0">
            Gambar
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Data Gambar Soal
            </h6>
          </h3>
        </div>
        @hasanyrole('panitia|admin')
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <button class="btn btn-outline-success font-weight-bolder" title="Tambah Data" data-bs-toggle="modal" data-bs-target="#modalAddGambar">
              <i class="fa-solid fa-file-circle-plus"></i>
              Tambah Data
            </button>
          </div>
        </div>
        @endhasanyrole
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="table-data" class="table">
            <thead>
              <tr class="text-uppercase">
                <th style="text-align: center;width: 5%">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama</th>
                <th scope="col">Caption</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($images as $no => $image)
              <tr>
                <td scope="row" style="text-align: center">{{ ++$no + ($images->currentPage()-1) * $images->perPage() }}</td>
                <td>
                  <a class="btn btn-sm btn-outline-success border-0" href="{{ Storage::url('public/images/'.$image->link) }}" target="_blank">Lihat Gambar</a>
                </td>
                <td>{{ $image->judul }}</td>
                <td>{{ $image->caption }}</td>
                <td>
                  <a type="button" id="{{ $image->id }}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Kamu yakin?')" href="{{ url('/gambar/delete/' . $image->id) }}">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAddGambar" tabindex="-1" aria-labelledby="modalAddGambarLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-capitalize" id="modalAddGambarLabel">Tambah Gambar</h5>
        <a style="cursor: pointer" data-bs-dismiss="modal" aria-label="Close">
          <i class="fa-solid fa-xmark"></i>
        </a>
      </div>
      <div class="modal-body p-0 pb-0">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row" style="min-height: 100%;">
              <form action="{{ route('gambars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Nama</label>
                      <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Masukkan Nama Gambar" class="form-control @error('judul') is-invalid @enderror">

                      @error('judul')
                      <div class="invalid-feedback font-italic fst-italic" style="display: block">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Gambar</label>
                      <input type="file" name="image" accept="image/png, image/gif, image/jpeg" class="form-control @error('image') is-invalid @enderror">

                      @error('image')
                      <div class="invalid-feedback font-italic fst-italic" style="display: block">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Caption</label>
                      <textarea type="text" name="caption" rows="5" value="{{ old('caption') }}" placeholder="Masukkan Caption Gambar" class="form-control @error('caption') is-invalid @enderror"></textarea>

                      @error('caption')
                      <div class="invalid-feedback font-italic fst-italic" style="display: block">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button class="btn btn-primary mr-1 btn-submit btn-sm" type="submit">
                    SIMPAN
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
