@extends('layouts.single-content')

@section('main-content')
<?php
    $params_id = null;
?>
<div class="row mb-1">
  <div class="col-12">
    <a href="{{ route('ujians.index') }}">
      <button class="btn btn-outline-secondary btn-sm font-weight-bolder border-0" title="Kembali">
        <i class="fa-solid fa-left-long"></i>
      </button>
    </a>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card d-flex border-0 p-0">
      <div class="card-header d-flex border-0 pt-6 pb-6 px-1" style="background: none">
        <div class="card-title">
          <h3 class="card-label text-capitalize m-0 p-0">
            Tambah Ujian
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Tambah Data Ujian
            </h6>
          </h3>
        </div>
      </div>
      <div class="card-body px-0">
        <form action="{{ route('ujians.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row bg-body-secondary mx-0 py-md-3 py-5 rounded-lg mb-3">
            <div class="col-12">
              <div class="form-group">
                <label>Nama Jenis Ujian</label>
                <select name="id_jenis" id="nama_ujian" class="form-select">
                  <option hidden value="">Pilih Nama Ujian</option>
                  @foreach($ujian as $row)
                    <option value="{{$row->id}}">{{$row->nama_soal}}</option>
                  @endforeach
                </select>

                @error('nama')
                <div class="invalid-feedback font-italic fst-italic" style="display: block">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Waktu</label>
                <div class="input-group">
                  <input type="number" min="1" name="waktu" value="{{ old('waktu') }}" class="form-control">
                  <span class="input-group-text">menit</span>

                  @error('waktu')
                  <div class="invalid-feedback font-italic fst-italic" style="display: block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Total Soal</label>
                <div class="input-group">
                  <input type="number" min="1" name="total_soal" value="{{ old('total_soal') }}" class="form-control">
                  <span class="input-group-text">soal</span>

                  @error('total_soal')
                  <div class="invalid-feedback font-italic fst-italic" style="display: block">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Mulai</label>
                <input type="datetime-local" name="mulai" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('mulai') is-invalid @enderror">

                @error('mulai')
                <div class="invalid-feedback font-italic fst-italic" style="display: block">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Selesai</label>
                <input type="datetime-local" name="selesai" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('selesai') is-invalid @enderror">

                @error('selesai')
                <div class="invalid-feedback font-italic fst-italic" style="display: block">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>

          <livewire:question-checklist />

          <hr>
          <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-outline-danger btn-reset mr-2" type="reset">
              RESET
            </button>
            <button class="btn btn-primary mr-1 btn-submit" type="submit">
              SIMPAN
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
