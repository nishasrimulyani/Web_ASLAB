@extends('layouts.single-content')

@section('main-content')
<?php
    $params_id = null;

    ?>
<div class="row">
  <div class="col-12">
    <div class="card d-flex border-0 p-0">
      <div class="card-header d-flex border-0 pt-6 pb-6 px-1" style="background: none">
        <div class="card-title">
          <div class="card-label text-capitalize m-0 p-0">
            <h2 class="">Ujian {{ $subject->getName($ujian->id_jenis) }}</h2>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0">
        <div class="row">
          <div class="col-6">
            <div class="row bg-body-secondary mx-0 mb-3 py-md-4 py-5 px-3 rounded-lg">
              <p class="m-0 text-muted" style="line-height: 1.75rem; text-align: justify;">
              @if (Str::contains(strtolower($subject->getName($ujian->id_jenis)), 'minat'))
                Ujian pengetahuan minat adalah ujian yang bertujuan untuk mengukur
                seberapa besar minat seseorang terhadap bidang-bidang tertentu,
                seperti ilmu pengetahuan, seni, sosial, bahasa, olahraga, dan lain-lain.
                Ujian ini biasanya digunakan untuk membantu seseorang menentukan jurusan,
                karir, atau hobi yang sesuai dengan minatnya. Ujian ini juga dapat membantu
                seseorang mengenali potensi dan bakat yang dimilikinya.
              @elseif (Str::contains(strtolower($subject->getName($ujian->id_jenis)), 'umum'))
                Ujian pengetahuan umum adalah ujian yang bertujuan untuk mengukur seberapa
                luas pengetahuan seseorang tentang berbagai hal, seperti sejarah, geografi,
                politik, ekonomi, budaya, sains, teknologi, dan lain-lain. Ujian ini biasanya
                digunakan untuk menilai kemampuan seseorang dalam berpikir kritis, logis, dan
                analitis. Ujian ini juga dapat membantu seseorang meningkatkan wawasan dan
                pemahaman tentang dunia.
              @elseif (Str::contains(strtolower($subject->getName($ujian->id_jenis)), 'psikotes'))
                Ujian psikotes adalah ujian yang bertujuan untuk mengukur aspek-aspek
                psikologis seseorang, seperti kecerdasan, kepribadian, minat, bakat, motivasi,
                emosi, dan lain-lain. Ujian ini biasanya digunakan untuk mengevaluasi kesiapan
                seseorang untuk menghadapi situasi tertentu, seperti sekolah, pekerjaan, atau
                hubungan. Ujian ini juga dapat membantu seseorang mengenal dirinya sendiri
                lebih baik.
              @endif
              </p>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table table-borderless">
                    <tr>
                      <th>Durasi</th>
                      <td>: {{ $ujian->waktu }} Menit</td>
                    </tr>
                    <tr>
                      <th>Jumlah Soal</th>
                      <td>: {{ $ujian->total_soal }} Buah</td>
                    </tr>
                    <tr>
                      <th>Mulai Ujian</th>
                      <td>: {{ date('d M Y, H:i', strtotime($ujian->mulai)) }}</td>
                    </tr>
                    <tr>
                      <th style="width: 20vw;">Batas Pengerjaan Ujian</th>
                      <td>: {{ date('d M Y, H:i', strtotime($ujian->selesai)) }}</td>
                    </tr>
                  </table>
                </div>
                <hr class="mt-0">
                @php
                  $mulai = \Carbon\Carbon::parse($ujian->mulai);
                  $selesai = \Carbon\Carbon::parse($ujian->selesai);
                @endphp
                @if(now() >= $mulai && $mulai <= $selesai)
                  <a href="{{ route('ujians.start', $ujian->id) }}" class="btn btn-primary btn-block font-weight-bolder text-uppercase" role="button" aria-pressed="true">Mulai Ujian</a>
                  <a onclick="goBack()" class="btn btn-outline-secondary btn-block btn-sm text-uppercase" role="button" aria-pressed="true">Kembali</a>
                @elseif(now() < $mulai)
                  <a onclick="goBack()" class="btn btn-warning  btn-block" role="button" aria-pressed="true">Ujian Belum Dibuka</a>
                @elseif(now() > $selesai)
                  <a onclick="goBack()" class="btn btn-danger  btn-block" role="button" aria-pressed="true">Ujian Sudah Ditutup</a>
                @endif
              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="row bg-body-secondary mx-0 mb-3 py-md-3 py-3 px-3 rounded-lg" style="height: 100%">
              <div class="row">
                <div class="col-12 mb-3 text-center">
                  <span class="text-center font-weight-bold text-uppercase" style="height: 100%">KETENTUAN UJIAN</span>
                </div>
              </div>
              <p class="mb-0" style="height: 100%; line-height: 2rem; text-align: justify;">
                1. Ujian ini berlangsung selama <b>{{ $ujian->waktu }} menit</b> dan terdiri dari <b>{{ $ujian->total_soal }} soal</b> pilihan ganda. <br>
                2. Anda harus menggunakan komputer atau laptop yang terhubung dengan internet
                untuk mengakses ujian. Anda tidak diperbolehkan menggunakan <b>ponsel, tablet, atau
                  perangkat lainnya</b> selama ujian. Jika Anda kedapatan melanggar aturan ini,
                Anda akan langsung <b>diskualifikasi</b> dari ujian. <br>
                3. Anda harus memulai ujian pada waktu yang ditentukan.
                Jika Anda terlambat memulai ujian, Anda akan kehilangan waktu
                yang sesuai dengan keterlambatan Anda. <br>
                4. Anda harus mengakhiri ujian sebelum waktu ujian berakhir dengan
                menekan tombol selesai yang tersedia di sistem ujian online. Jika Anda
                tidak mengakhiri ujian, sistem akan secara otomatis mengakhiri ujian
                pada waktu yang ditentukan. <br>
                5. Kerjakan ujian dengan jujur, dan semoga berhasil!
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var now = new Date();

    function goBack() {
    window.history.back();

}
</script>
@endsection
