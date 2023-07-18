<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h6 class="m-0">Soal yang tersedia</h6>
      </div>
      <div class="card-body">
        <table id="table_id" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Pilih</th>
              <th>Jenis Soal</th>
              <th>Detail Soal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($questions as $question)
            <tr>
              <td>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" wire:model="selectedQuestion" type="checkbox" name="questions[]" value="{{ $question->id }}" id="check-{{ $question->id }}">
                </div>
              </td>
              <td>{{ $subject->getName($question->jenis_id) }}</td>
              <td>{{ $question->detail }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div style="text-align: center">
          {{$questions->links()}}
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <h6 class="m-0">Soal yang dipilih</h6>
      </div>
      <div class="card-body">
        @if(isset($selectedQuestion))
        <div class="form-group">
          <table id="table_id" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Jenis Soal</th>
                <th>Detail Soal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @if (isset($questionsAll))
              @foreach ($questionsAll as $question)
              <tr>
                <td>{{ $subject->getName($question->jenis_id) }}</td>
                <td>{{ $question->detail }}</td>
                <td>
                  <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" name="questions[]" value="{{ $question->id }}" id="check-{{ $question->id }}" checked>
                  <label class="btn btn-outline-primary btn-sm m-0" for="btncheck1"><i class="fas fa-check"></i></label>
                  {{-- <input class="form-check-input" type="checkbox" name="questions[]" value="{{ $question->id }}" id="check-{{ $question->id }}" checked> --}}
                  <button type="button" class="btn btn-sm btn-outline-danger" wire:click="deselectQuestion({{ $question->id }})"><i class="fas fa-trash"></i>
                  </button>
                </td>
              </tr>
              @endforeach
              @endif

            </tbody>
          </table>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
