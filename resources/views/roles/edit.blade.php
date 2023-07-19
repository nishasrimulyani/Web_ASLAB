@extends('layouts.admin')

@section('main-content')
<?php
    $params_id = null;

    ?>
<div class="row mt-5">
  <div class="col-lg-12 margin-tb">
    <div class="float-start">
      <h2>Ubah Role</h2>
    </div>
  </div>
</div>
<hr>
<div class="container-fluid">
  <div class="card card-default">
    <div class="card-body">
      <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label>NAMA ROLE</label>
          <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="Masukkan Nama Role" class="form-control @error('title') is-invalid @enderror">

          @error('name')
          <div class="invalid-feedback font-italic fst-italic" style="display: block">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label class="font-weight-bold">PERMISSIONS</label>

          @foreach ($permissions as $permission)
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="check-{{ $permission->id }}" @if($role->permissions->contains($permission)) checked @endif>
            <label class="form-check-label" for="check-{{ $permission->id }}">
              {{ $permission->name }}
            </label>
          </div>
          @endforeach
        </div>

        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
          UPDATE</button>
        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

      </form>

    </div>
  </div>
</div>
@endsection
