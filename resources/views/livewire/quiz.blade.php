{{--  <div class="row mb-3">
  <div class="col-12">
    <div class="card card-custom">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="card d-flex border-0 p-0">
              <div class="card-header d-flex align-items-center border-0 pt-6 px-1" style="background: none">
                <div class="card-title">
                  <h3 class="card-label text-capitalize m-0 p-0">
                    Ujian {{ $subject->getName($exam->id_jenis) }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-6">
    <div class="card card-custom">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="card d-flex border-0 p-0">
              <div class="card-header d-flex align-items-center border-0 pt-6 px-0" style="background: none">
                <div class="card-title">
                  <h5 class="card-label font-weight-bolder text-uppercase m-0 p-0">
                    Soal No {{ $questions->currentPage() }}
                  </h5>
                </div>
              </div>
              <div class="card-body px-0">
                @foreach ($questions as $question)
                  <p>{{ $question['detail'] }}</p>
                      @if($question['image_id'])
                      <img src="{{ Storage::url('public/images/'.$image->getLink($question['image_id'])) }}" style="width: 600px">
                      @endif
                  <div>
                    <i><small>Pilih salah satu jawaban dibawah ini :</small></i>
                  </div>
                  <div class="vstack gap-3 mt-2">
                    <button
              type="button"
              class="{{ in_array($question['id'].'-'.$question['option_A'], $selectedAnswers) ? 'btn btn-success border border-secondary rounded' : 'btn btn-light border border-secondary rounded' }}"
              wire:click="answers({{ $question['id'] }}, '{{ $question['option_A'] }}')"
            >
                <p class="text-left">
                  <b> A. {{ $question['option_A'] }} </b>
                </p>
            </button>
                    <button
                      type="button"
                      class="btn rounded {{ in_array($question['id'].'-'.$question['option_B'], $selectedAnswers) ? 'btn-primary' : 'btn-outline-primary' }}"
                      wire:click="answers({{ $question['id'] }}, '{{ $question['option_B'] }}')"
                    >
                        <p class="text-left">
                          <b> B. {{ $question['option_B'] }} </b>
                        </p>
                    </button>
                    <button
                      type="button"
                      class="btn rounded {{ in_array($question['id'].'-'.$question['option_C'], $selectedAnswers) ? 'btn-primary' : 'btn-outline-primary' }}"
                      wire:click="answers({{ $question['id'] }}, '{{ $question['option_C'] }}')"
                    >
                      <p class="text-left">
                        <b> C. {{ $question['option_C'] }} </b>
                      </p>
                    </button>
                    <button
                      type="button"
                      class="btn rounded {{ in_array($question['id'].'-'.$question['option_D'], $selectedAnswers) ? 'btn-primary' : 'btn-outline-primary' }}"
                      wire:click="answers({{ $question['id'] }}, '{{ $question['option_D'] }}')"
                    >
                      <p class="text-left">
                        <b> D. {{ $question['option_D'] }} </b>
                      </p>
                    </button>
                  </div>
                @endforeach

                <div class="d-flex justify-content-center">
                  {{$questions->links()}}
                </div>
                <div class="card-footer">
                    @if ($questions->currentPage() == $questions->lastPage())
                        <button wire:click="submitAnswers" class="btn btn-primary btn-block">Submit</button>
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="card card-custom">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="card d-flex border-0 p-0">
              <div class="card-header d-flex align-items-center border-0 pt-6 px-1" style="background: none">
                <div class="card-title">
                  <h3 class="card-label text-capitalize m-0 p-0">
                    Ujian {{ $subject->getName($exam->id_jenis) }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  --}}

<div class="row">
  <div class="col-6">
    <div class="card card-custom">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="card d-flex border-0 p-0">
              <div class="card-header d-flex align-items-center border-0 pt-6 px-0" style="background: none">
                <div class="card-title">
                  <h5 class="card-label font-weight-bolder text-uppercase m-0 p-0">
                    Soal No {{ $questions->currentPage() }}
                  </h5>
                </div>
                <div class="card-toolbar ml-auto">
                  <div class="d-flex justify-content-center">
                    {{ $questions->links() }}
                  </div>
                </div>
              </div>
                @foreach ($questions as $question)
                <div class="card-body px-0">
                  <p>{{ $question['detail'] }}</p>

                  @if($question['image_id'])
                  <img src="{{ Storage::url('public/images/'.$image->getLink($question['image_id'])) }}" style="width: 600px">
                  @endif

                  <div>
                    <i><small>Pilih salah satu jawaban dibawah ini :</small></i>
                  </div>
                  <div class="vstack gap-2 mt-2">
                    <div class="btn-group">
                      <label class="input-group-text" style="border-top-right-radius: 0%; border-bottom-right-radius: 0%; width: auto; min-width: 2vw;">
                        <b>A</b>
                      </label>
                      <button
                        type="button"
                        style="width: 90%;"
                        class="{{ in_array($question['id'].'-'.$question['option_A'], $selectedAnswers) ? 'btn btn-primary text-left p-3' : 'btn btn-outline-primary text-left p-3' }}"
                        wire:click="answers({{ $question['id'] }}, '{{ $question['option_A'] }}')"
                      >
                        <b> {{ $question['option_A'] }} </b>
                      </button>
                    </div>
                    <div class="btn-group">
                      <label class="input-group-text" style="border-top-right-radius: 0%; border-bottom-right-radius: 0%; width: auto; min-width: 2vw;">
                        <b>B</b>
                      </label>
                      <button
                        type="button"
                        style="width: 90%;"
                        class="{{ in_array($question['id'].'-'.$question['option_B'], $selectedAnswers) ? 'btn btn-primary text-left p-3' : 'btn btn-outline-primary text-left p-3' }}"
                        wire:click="answers({{ $question['id'] }}, '{{ $question['option_B'] }}')"
                      >
                        <b> {{ $question['option_B'] }} </b>
                      </button>
                    </div>
                    <div class="btn-group">
                      <label class="input-group-text" style="border-top-right-radius: 0%; border-bottom-right-radius: 0%; width: auto; min-width: 2vw;">
                        <b>C</b>
                      </label>
                      <button
                        type="button"
                        style="width: 90%;"
                        class="{{ in_array($question['id'].'-'.$question['option_C'], $selectedAnswers) ? 'btn btn-primary text-left p-3' : 'btn btn-outline-primary text-left p-3' }}"
                        wire:click="answers({{ $question['id'] }}, '{{ $question['option_C'] }}')"
                      >
                        <b> {{ $question['option_C'] }} </b>
                      </button>
                    </div>
                    <div class="btn-group">
                      <label class="input-group-text" style="border-top-right-radius: 0%; border-bottom-right-radius: 0%; width: auto; min-width: 2vw;">
                        <b>D</b>
                      </label>
                      <button
                        type="button"
                        style="width: 90%;"
                        class="{{ in_array($question['id'].'-'.$question['option_D'], $selectedAnswers) ? 'btn btn-primary text-left p-3' : 'btn btn-outline-primary text-left p-3' }}"
                        wire:click="answers({{ $question['id'] }}, '{{ $question['option_D'] }}')"
                      >
                        <b> {{ $question['option_D'] }} </b>
                      </button>
                    </div>
                  </div>
                </div>
                @endforeach
                @if ($questions->currentPage() == $questions->lastPage())
                <div class="card-footer" style="background: none">
                  <div class="row">
                    <div class="col-12 px-0">
                      <button wire:click="submitAnswers" class="btn btn-outline-success btn-block text-uppercase mt-3">Selesai Ujian</button>
                    </div>
                  </div>
                </div>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row mb-3">
      <div class="col-12">
        <div class="card card-custom">
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="card d-flex border-0 p-0">
                  <div class="card-header d-flex align-items-center border-0 pt-6 px-1" style="background: none">
                    <div class="card-title">
                      <h3 class="card-label text-capitalize m-0 p-0">
                        Ujian {{ $subject->getName($exam->id_jenis) }}
                      </h3>
                    </div>
                    <div class="card-toolbar ml-auto">
                      <div class="row">
                        <div class="d-flex justify-content-end">
                          <div class="vstack">
                            {{--  <badge class="">  --}}
                              <h5 class="h-100 m-0 badge border border-2 border-danger d-flex p-2 text-danger" id="timer"></h5>
                            {{--  </badge>  --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-12">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    var add_minutes =  function (dt, minutes) {
      return new Date(dt.getTime() + minutes*60000);
    }

    // Get today's date and time
    var now = new Date();

    // Set the date we're counting down to
    var countDownDate = add_minutes(now, {{ $exam->waktu }});

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now2 = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now2;

    // Time calculations for days, hours, minutes and seconds
    var hours = 0;
    var minutes = 0;
    var seconds = 0;

    hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("timer").innerHTML = hours + " jam "
    + minutes + " menit "+ seconds + " detik ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        Livewire.emit('endTimer');
    }
    }, 1000);
</script>
