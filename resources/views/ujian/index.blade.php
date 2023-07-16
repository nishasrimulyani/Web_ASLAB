@extends('layouts.admin')

@section('main-content')
    <?php
    $params_id = null;

    ?>
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Halaman Ujian</h2>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
                @hasanyrole('panitia|admin')
                <a href="{{ route('ujians.create') }}"><button class="btn btn-primary">Tambah Data</button></a>
                <hr>
                @endhasanyrole
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col" >No</th>
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

                                <tr style="text-align: center">
                                    <th scope="row" style="text-align: center">{{ ++$no + ($exams->currentPage()-1) * $exams->perPage() }}</th>
                                    <td>{{ $exam->nama }}</td>
                                    <td>{{ $exam->waktu }}</td>
                                    <td>{{ $exam->soals()->count() }}</td>
                                    @hasanyrole('panitia|admin')
                                    <td>{{ $exam->users->count() }}</td>
                                    @endhasanyrole
                                    @hasrole('peserta')
                                    <td>{{  $user->getScore(Auth()->id(), $exam->id) !== null ? $user->getScore(Auth()->id(), $exam->id) : "Belum dikerjakan"  }}</td>
                                    @endhasrole
                                    <td>{{ ($exam->mulai) }}</td>
                                    <td>{{ ($exam->selesai) }}</td>
                                    <td class="text-center">
                                        @hasanyrole('panitia|admin|peserta')
                                        <a href="{{ route('ujians.show', $exam->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @endhasanyrole
                                        <a href="{{ route('ujians.edit', $exam->id) }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        @hasanyrole('panitia|admin')
                                        <a href="{{ route('ujians.peserta', $exam->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-door-open"></i>
                                        </a>
                                        @endhasanyrole

                                        <a type="button" id="btn-hapus-soal"
                                                class="btn btn-sm btn-danger hapusJenis-{{ $exam->id }}"
                                                onclick="return confirm('Apakah Kamu yakin?')"
                                                href="{{ url('/ujian/delete/' . $exam->id) }}">
                                                <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
    </div>
@endsection
