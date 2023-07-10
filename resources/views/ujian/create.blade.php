@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Bank Soal</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <form action="{{ route('ujians.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control" >
                            @error('nama')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="number" name="waktu" value="{{ old('waktu') }}" class="form-control" >

                            @error('waktu')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Total Soal</label>
                            <input type="number" name="total_soal" value="{{ old('total_soal') }}" class="form-control" >

                            @error('total_soal')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mulai</label>
                            <input type="datetime-local" name="mulai" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('mulai') is-invalid @enderror">

                            @error('mulai')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Selesai</label>
                            <input type="datetime-local" name="selesai" value="<?= date('Y-m-d', time()); ?>" class="form-control @error('selesai') is-invalid @enderror">

                            @error('selesai')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    
                        <livewire:question-checklist />

                    <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                    <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                </form>
                        

                    
            </div>
        </div>
    </div>
@endsection