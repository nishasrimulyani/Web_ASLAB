@extends('layouts.admin')

@section('content-layout')
    <?php
      $params_id = null;

    ?>
    <div class="d-flex flex-column flex-column-fluid">
      <div class='d-flex flex-column-fluid'>
        <div class='container-fluid p-5'>
          @livewire('quiz', ['id' => $id, 'subject' => $subject, 'user' => $user])
        </div>
      </div>
    </div>
@endsection
