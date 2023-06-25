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
                <a href="{{ route('soals.create') }}"><button class="btn btn-primary">Tambah Data</button></a>
                <hr>
                <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Jenis Soal</th>
                        <th>Detail</th>
                        <th>Lampiran</th>
                        <th>Pilihan A</th>
                        <th>Pilihan B</th>
                        <th>Pilihan C</th>
                        <th>Pilihan D</th>
                        <th>Jawaban</th>
                        <th>Penjelasan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                @foreach ($questions as $no => $question)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($questions->currentPage()-1) * $questions->perPage() }}</th>
                                    <td>{{ $jenissoal->getName($question->jenis_id) }}</td>
                                    <td>{{ $question->detail }}</td>
                                    <td>
                                       @if($question->image_id)
                                            <a href=" {{ Storage::url('public/images/'.$image->getLink($question->image_id)) }}">IMAGE</a>
                                        @else
                                            NO
                                        @endif
                                    </td>
                                    <td>{{ $question->option_A }}</td>
                                    <td>{{ $question->option_B }}</td>
                                    <td>{{ $question->option_C }}</td>
                                    <td>{{ $question->option_D }}</td>
                                    <td>{{ $question->jawaban }}</td>
                                    <td>{{ $question->penjelasan }}</td>
                                    <td>{{ $user->getName($question->dibuat_oleh) }}</td>
                                    <td class="text-center">
                                        @can('questions.edit')
                                            <a href="{{ route('soals.edit', $soal->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        
                                        @can('questions.delete')
                                            <button onClick="Hapus(this.id)" class="btn btn-sm btn-danger" id="{{ $soal->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                </tbody>
            </table>
            </div>
        </div>    
    </div>
@endsection