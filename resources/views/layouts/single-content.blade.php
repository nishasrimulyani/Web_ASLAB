@extends('layouts.admin')

@section('content-layout')
<div class="d-flex flex-column flex-column-fluid">
  <div class='d-flex flex-column-fluid'>
    <div class='container-fluid p-5'>
      <div class='card card-custom'>
        <div class='card-body'>
          @yield('main-content')
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
