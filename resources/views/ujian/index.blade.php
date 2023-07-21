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
          <h3 class="card-label text-capitalize m-0 p-0">
            Ujian
            <h6 class="d-block text-muted pt-2 font-size-sm m-0 p-0 fst-italic">
              Management Data Ujian
            </h6>
          </h3>
        </div>
        @hasanyrole('panitia|admin')
        <div class="card-toolbar ml-auto">
          <div class="row d-flex justify-content-end">
            <a href="{{ route('ujians.create') }}">
              <button class="btn btn-outline-success font-weight-bolder" title="Tambah Data" data-toggle="modal" data-target="#tambahJenisModal" id="createNewJenis">
                <i class="fa-solid fa-file-circle-plus"></i>
                Tambah Data
              </button>
            </a>
          </div>
        </div>
        @endhasanyrole
       </div>
      <div class="card-body px-0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr class="text-uppercase">
                <th style="text-align: center;width: 5%">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Waktu</th>
                <th scope="col">Total Soal</th>
                @hasanyrole('panitia|admin')
                <th scope="col">Jumlah Peserta</th>
                @endhasanyrole
                @hasrole('peserta')
                <th scope="col">Nilai</th>
                @endhasrole
                <th scope="col">Mulai</th>
                <th scope="col">Selesai</th>
                <th scope="col" style="width: 15%;text-align: center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($exams as $no => $exam)

              <tr>
                <td scope="row" style="text-align: center">{{ ++$no + ($exams->currentPage()-1) * $exams->perPage() }}</td>
                <td>{{ $exam->nama }}</td>
                <td>{{ $exam->waktu }} Menit</td>
                <td>{{ $exam->soals()->count() }}</td>
                @hasanyrole('panitia|admin')
                <td>{{ $exam->users->count() }}</td>
                @endhasanyrole
                @hasrole('peserta')
                <td>{{ $user->getScore(Auth()->id(), $exam->id) !== null ? $user->getScore(Auth()->id(), $exam->id) : "Belum dikerjakan"  }}</td>
                @endhasrole
                <td>{{ date('d M Y, H:i', strtotime($exam->mulai)) }}</td>
                <td>{{ date('d M Y, H:i', strtotime($exam->selesai)) }}</td>
                <td class="text-center">
                  @hasanyrole('panitia|admin|peserta')
                  <a title="Buka Ujian" href="{{ route('ujians.show', $exam->id) }}" class="btn btn-outline-info btn-sm ">
                    <i class="fa-solid fa-chalkboard-user"></i>
                  </a>
                  @endhasanyrole
                  @hasanyrole('panitia|admin')
                  <a title="Edit Ujian" href="{{ route('ujians.edit', $exam->id) }}" class="btn btn-outline-success btn-sm ">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  <a title="Lihat Peserta" href="{{ route('ujians.peserta', $exam->id) }}" class="btn btn-outline-primary btn-sm ">
                    <i class="fa-solid fa-users"></i>
                  </a>

                  <a title="Hapus" type="button" id="btn-hapus-soal" class="btn btn-outline-danger btn-sm hapusJenis-{{ $exam->id }}" onclick="return confirm('Apakah Kamu yakin?')" href="{{ url('/ujian/delete/' . $exam->id) }}">
                    <i class="fas fa-trash"></i>
                  </a>
                @endhasanyrole
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
