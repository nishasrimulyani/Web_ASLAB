@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Ujian</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <h4><i class="fas fa-exam"></i> Hasil {{ $exam->name.' '.$user->name }}</h4>
            </div>
            <div class="card-body">
                <h4>Score Anda Adalah {{ round($score, 2) }}</h4>
            </div>
            <div class="card-footer">
                    <a href="{{ route('ujians.review', [$user->id, $exam->id]) }}" class="btn btn-primary mr-1 btn-submit" role="button" aria-pressed="true">Review</a>
                    <a href="{{ route('ujians.index') }}" class="btn btn-warning btn-resetk" role="button" aria-pressed="true">Kemabli</a>
            </div>
        </div>
    </div>
@endsection