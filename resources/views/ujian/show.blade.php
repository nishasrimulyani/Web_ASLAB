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
                <h4><i class="fas fa-exam"></i> Ujian {{ $ujian->nama }} </h4>
            </div>
            <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Durasi Ujian : {{ $ujian->waktu }} Menit</li>
                        <li class="list-group-item">Durasi Jumlah Soal : {{ $ujian->total_soal }} buah</li>
                        <li class="list-group-item">Ujian dibuka : {{ $ujian->mulai }}</li>
                        <li class="list-group-item">Ujian ditutup : {{ $ujian->selesai }}</li>
                    </ul>
                    <hr>
                    @if(now() > $ujian->mulai && now() < $ujian->selesai)
                        <a href="{{ route('ujians.start', $exam->id) }}" class="btn btn-primary btn-block" role="button" aria-pressed="true">Mulai</a>
                    @elseif(now() < $ujian->mulai)
                        <a onclick="goBack()" class="btn btn-warning  btn-block" role="button" aria-pressed="true">Ujian Belum Dibuka - Kembali</a>
                    @elseif(now() > $ujian->selesai)
                        <a onclick="goBack()" class="btn btn-danger  btn-block" role="button" aria-pressed="true">Ujian Sudah Ditutup - Kembali</a>
                    @endif
            </div>
           
                    
        
            
        </div>
    </div>

<script type="text/javascript">
    function goBack() {
    window.history.back();
}
</script>
@endsection