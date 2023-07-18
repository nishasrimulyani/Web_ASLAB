@extends('layouts.admin')

@section('main-content')
<?php
    $params_id = null;

    ?>
<div class="container-fluid px-3">
  <div class="row mt-5">
    <div class="col-lg-12 margin-tb">
      <h2 class="m-0">Buat Ujian</h2>
    </div>
  </div>
  <hr>
  <form action="{{ route('ujians.store') }}" method="POST" enctype="multipart/form-data">
    <div class="card card-default mb-3">
      <div class="card-body">
        @csrf

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label>Nama Ujian</label>
              <select name="nama" id="nama_ujian" class="form-select">
                <option hidden value="">Pilih Nama Ujian</option>
                <option value="psikotest">Psikotest</option>
                <option value="umum">Pengetahuan Umum</option>
                <option value="minat">Minat</option>
              </select>

              @error('nama')
              <div class="invalid-feedback" style="display: block">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>Waktu</label>
              <div class="input-group">
                <input type="number" name="waktu" value="{{ old('waktu') }}" class="form-control">
                <span class="input-group-text">menit</span>

                @error('waktu')
                <div class="invalid-feedback" style="display: block">
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
                <input type="number" name="total_soal" value="{{ old('total_soal') }}" class="form-control">
                <span class="input-group-text">soal</span>

                @error('total_soal')
                <div class="invalid-feedback" style="display: block">
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
              <div class="invalid-feedback" style="display: block">
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
              <div class="invalid-feedback" style="display: block">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>

    <livewire:question-checklist />

    <hr>
    <div class="d-flex justify-content-end mt-3">
      {{-- <div class="col-1">  --}}
      <button class="btn btn-outline-danger btn-reset mr-2" type="reset">
        RESET
      </button>
      {{-- </div>  --}}
      {{-- <div class="col-1">  --}}
      <button class="btn btn-primary mr-1 btn-submit" type="submit">
        SIMPAN
      </button>
      {{-- </div>  --}}
    </div>
  </form>
</div>
@endsection
