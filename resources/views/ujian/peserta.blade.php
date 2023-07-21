@extends('layouts.single-content')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Peserta</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                    <h4><i class="fas fa-exam"></i> {{  $exam->nama }} </h4>
            </div>
            <div class="card-body px-0">
                <form action="{{ route('ujians.assign', $exam->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @livewire('student', ['selectedExam' => $exam->id])

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                </form>
            </div>
        </div>
    </div>
@endsection



