@extends('layouts.single-content')

@section('main-content')

<?php
    $params_id = null;

    ?>
<div class="row mb-1">
  <div class="col-12">
    <a href="{{ route('soals.index') }}">
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
            Tambah Soal
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Tambah Data Bank Soal
            </h6>
          </h3>
        </div>
      </div>
      <div class="card-body px-0">
        <form action="{{ route('soals.store') }}" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-6 pl-0" style="min-height: 100%;">
              <div class="card card-default" style="min-height: 100%;">
                <div class="card-header">
                  <h6 class="m-0">Soal</h6>
                </div>
                <div class="card-body bg-body-tertiary">
                  @csrf
                  <div class="row" style="min-height: 100%;">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Jenis Soal</label>
                        <select class="form-select select-subject @error('jenis_id') is-invalid @enderror" name="jenis_id">
                          <option value="">Pilih Jenis Soal</option>
                          @foreach ($subjects as $subject)
                          <option value="{{ $subject->id }}">{{ $subject->nama_soal }}</option>
                          @endforeach
                        </select>
                        @error('subject_id')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Gambar</label>
                        <select class="form-select select-image @error('image_id') is-invalid @enderror" name="image_id">
                          <option value="">Pilih Gambar</option>
                          @foreach ($images as $image)
                          <option value="{{ $image->id }}">{{ $image->judul }}</option>
                          @endforeach
                        </select>
                        @error('image_id')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group pb-2">
                    <label>Isi Soal</label>
                    <textarea name="detail" cols="17" rows="17" class="form-control" placeholder="Masukkan Isi Soal">{{ old('detail') }}</textarea>
                    @error('detail')
                    <div class="invalid-feedback font-italic fst-italic" style="display: block">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 pr-0" style="min-height: 100%;">
              <div class="card card-default" style="min-height: 100%;">
                <div class="card-header">
                  <h6 class="m-0">Jawaban</h6>
                </div>
                <div class="card-body bg-body-tertiary">
                  <div class="row" style="min-height: 100%;">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Pilihan A</label>
                        <input type="text" name="option_A" value="{{ old('option_A') }}" class="form-control" placeholder="Masukkan Pilihan A">
                        @error('option_A')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Pilihan B</label>
                        <input type="text" name="option_B" value="{{ old('option_B') }}" class="form-control" placeholder="Masukkan Pilihan B">
                        @error('option_B')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Pilihan C</label>
                        <input type="text" name="option_C" value="{{ old('option_C') }}" class="form-control" placeholder="Masukkan Pilihan C">
                        @error('option_C')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Pilihan D</label>
                        <input type="text" name="option_D" value="{{ old('option_D') }}" class="form-control" placeholder="Masukkan Pilihan D">
                        @error('option_D')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>Jawaban Benar</label>
                        <input type="text" name="jawaban" value="{{ old('jawaban') }}" class="form-control" placeholder="Masukkan Jawaban Benar">
                        <!-- <select name="jawaban" id="jawaban" class="form-select">
                          <option hidden value="">Pilih Jawaban Yang Benar</option>
                          <option value="option_A">A</option>
                          <option value="option_B">B</option>
                          <option value="option_C">C</option>
                          <option value="option_D">D</option>
                        </select> -->
                        @error('jawaban')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>Penjelasan Jawaban</label>
                        <textarea name="penjelasan" cols="10" rows="10" class="form-control" placeholder="Masukkan Penjelasan Jawaban">{{ old('penjelasan') }}</textarea>
                        @error('penjelasan')
                        <div class="invalid-feedback font-italic fst-italic" style="display: block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
@stop
