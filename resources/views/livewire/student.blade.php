<div>

    @if(isset($selectedStudent))
      <div class="form-group">
        <label>Pilih Peserta</label>
        <table id="table_id" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Hapus</th>
            <th>Nama</th>
            <th>Check</th>
          </tr>
          </thead>
          <tbody>
          @if (isset($studentsAll))
              @foreach ($studentsAll as $student)
              <tr>
                <td>
                    <button type="button" class="btn btn-danger" wire:click="deselectStudent({{ $student->id }})"><i class="fas fa-minus-circle"></i></button>
                </td>
                <td>{{ $student->nama }}</td>
                <td><input class="form-check-input" type="checkbox" name="students[]" value="{{ $student->id }}"
                  id="check-{{ $student->id }}" checked></td>
              </tr>
              @endforeach
          @endif

          </tbody>
        </table>
      </div>
    @endif
      <div class="card">
          <div class="card-header">
              <h3>Tambah Peserta</h3>
          </div>
          <div class="card-body px-0">
            {{-- @foreach ($selectedStudent as $item)
                {{ $item  }}
            @endforeach --}}

                      <div class="input-group mb-3">
                          <input type="text" class="form-control" name="q" wire:model="q"
                                 placeholder="cari berdasarkan detail student">
                      </div>
            <table id="table_id" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>Pilih</th>
                <th>Nama</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($students as $student)
                <tr>
                  <td>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" wire:model="selectedStudent" type="checkbox" name="students[]" value="{{ $student->id }}"
                                 id="check-{{ $student->id }}" >
                      </div>
                  </td>
                  <td>{{ $student->nama }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>

            <div style="text-align: center">
              {{$students->links()}}
            </div>
          </div>
      </div>
  </div>
