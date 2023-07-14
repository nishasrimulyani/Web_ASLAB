@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Data Diri</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   
    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->nama[0] }}"></figure>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->nama }}</h5>
                                <p>Peserta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

       
        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dokumen</h6>
                </div>

                <div class="card-body">

                    <h6 class="heading-small text-muted mb-4">Informasi Pengguna</h6>

                    <div class="pl-lg-4">

                        <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Nama <span class="small text-danger">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" placeholder="" class="form-control @error('nama') is-invalid @enderror">

                                @error('title')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir<span class="small text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="" class="form-control @error('tempat_lahir') is-invalid @enderror">

                                @error('tempat_lahir')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="<?= date('Y-m-d'); ?>" class="form-control @error('tanggal_lahir') is-invalid @enderror">

                                @error('tanggal_lahir')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jurusan <span class="small text-danger">*</span></label>
                                <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="" class="form-control @error('jurusan') is-invalid @enderror">

                                @error('jurusan')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>IPK<span class="small text-danger">*</span></label>
                                <input type="text" name="ipk" value="{{ old('ipk') }}" placeholder="" class="form-control @error('ipk') is-invalid @enderror">

                                @error('ipk')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Posisi Yang Dilamar</label>
                                
                                <select class="form-control select-lowongan @error('lowongan_id') is-invalid @enderror" name="lowongan_id">
                                    <option value="">- Pilih Lowongan -</option>
                                    @if ($lowongans->lowongan instanceof Illuminate\Database\Eloquent\Collection)
                                    @foreach ($lowongans->lowongan as $lowongan)
                                        <option value="{{ $lowongan->id }}">{{ $lowongan->nama_loker }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('lowongan_id')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>CV<span class="small text-danger">*</span></label>
                                <input type="file" name="document" class="form-control @error('document') is-invalid @enderror">

                                @error('document')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Surat Lamaran<span class="small text-danger">*</span></label>
                                <input type="file" name="document" class="form-control @error('document') is-invalid @enderror">

                                @error('document')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tangkapan Layar Produk<span class="small text-danger">*</span></label>
                                <input type="file" name="document" class="form-control @error('document') is-invalid @enderror">

                                @error('document')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-upload"></i> UPLOAD</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>


                        </form>

                    </div>
                
              

                </div>

            </div>

        </div>
    

    </div> 
    </div>

@endsection
