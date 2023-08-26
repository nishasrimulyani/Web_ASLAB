@extends('layouts.single-content')

@section('main-content')
<?php
    $params_id = null;

    ?>
<div class="row mt-5">
  <div class="col-lg-12 margin-tb">
    <div class="float-start">
      <h2>Ubah Pengguna</h2>
    </div>
  </div>
</div>
<hr>
<div class="container-fluid">
  <div class="card card-default">
    <div class="card-body px-0">
      <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>Nama Pengguna</label>
          <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Masukkan Nama Pengguna" class="form-control @error('nama') is-invalid @enderror">

          @error('nama')
          <div class="invalid-feedback font-italic fst-italic" style="display: block">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Email" class="form-control @error('email') is-invalid @enderror">

          @error('email')
          <div class="invalid-feedback font-italic fst-italic" style="display: block">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Kata Sandi</label>
              <input type="password" name="password" value="{{ old('password') }}" placeholder="Masukkan Kata Sandi" class="form-control @error('password') is-invalid @enderror">

            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Konfirmasi Kata Sandi</label>
              <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Masukkan Konfirmasi Kata Sandi" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="font-weight-bold">Role</label>
          @foreach ($roles as $role)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}" id="check-{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="check-{{ $role->id }}">
              {{ $role->name }}
            </label>
          </div>
          @endforeach
        </div>

        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
          Ubah</button>
        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

      </form>
    </div>
  </div>
</div>
@endsection
