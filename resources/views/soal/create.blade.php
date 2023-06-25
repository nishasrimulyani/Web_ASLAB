@extends('layouts.admin')

@section('main-content')

    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Soal</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                <form action="{{ route('soals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Jenis Soal</label>
                            <select class="form-control select-subject @error('jenis_id') is-invalid @enderror" name="jenis_id">
                                <option value="">- Pilih Jenis Soal -</option>
                                @foreach ($jenissoals as $jenis)
                                    <option value="{{ $jenissoal->id }}">{{ $jenis->nama }}</option>
                                @endforeach
                            </select>
                            @error('subject_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-3">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <select class="form-control select-image @error('image_id') is-invalid @enderror" name="image_id">
                                        <option value="">- Pilih Gambar -</option>
                                        @foreach ($images as $image)
                                            <option value="{{ $image->id }}">{{ $image->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('image_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        <!--<div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>VIDEO</label>
                                    <select class="form-control select-video @error('video_id') is-invalid @enderror" name="video_id">
                                        <option value="">- SELECT VIDEO -</option>
                                        @foreach ($videos as $video)
                                            <option value="{{ $video->id }}">{{ $video->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('video_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>AUDIO</label>
                                    <select class="form-control select-audio @error('audio_id') is-invalid @enderror" name="audio_id">
                                        <option value="">- SELECT AUDIO -</option>
                                        @foreach ($audios as $audio)
                                            <option value="{{ $audio->id }}">{{ $audio->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('audio_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 

                            <div class="col-3">
                                <div class="form-group">
                                    <label>IMAGE</label>
                                    <select class="form-control select-image @error('image_id') is-invalid @enderror" name="image_id">
                                        <option value="">- SELECT IMAGE -</option>
                                        @foreach ($images as $image)
                                            <option value="{{ $image->id }}">{{ $image->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('image_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>DOCUMENT</label>
                                    <select class="form-control select-document @error('document_id') is-invalid @enderror" name="document_id">
                                        <option value="">- SELECT DOCUMENT -</option>
                                        @foreach ($documents as $document)
                                            <option value="{{ $document->id }}">{{ $document->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('document_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label>DETAIL</label>
                            <textarea name="detail" cols="30" rows="30" class="form-control">{{ old('detail') }}</textarea>
                            @error('detail')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pilihan A</label>
                            <input type="text" name="option_A" value="{{ old('option_A') }}" class="form-control" >

                            @error('option_A')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pilihan B</label>
                            <input type="text" name="option_B" value="{{ old('option_B') }}" class="form-control" >

                            @error('option_B')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pilihan C</label>
                            <input type="text" name="option_C" value="{{ old('option_C') }}" class="form-control" >

                            @error('option_C')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Pilihan D</label>
                            <input type="text" name="option_D" value="{{ old('option_D') }}" class="form-control" >

                            @error('option_D')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!--<div class="form-group">
                            <label>OPTION E</label>
                            <input type="text" name="option_E" value="{{ old('option_E') }}" class="form-control" >

                            @error('option_E')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> -->

                        <div class="form-group">
                            <label>Jawaban</label>
                            <input type="text" name="jawaban" value="{{ old('jawaban') }}" class="form-control" >

                            @error('jawaban')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Penjelasan</label>
                            <textarea name="penjelasan" cols="30" rows="30" class="form-control">{{ old('penjelasan') }}</textarea>
                            @error('penjelasan')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                </form>
            </div>
        </div>
    </div>

@stop