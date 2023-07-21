<?php

namespace App\Http\Livewire;

use App\Models\Ujian;
use App\Models\User;
use App\Models\Gambar;
use Livewire\Component;
use App\Models\Soal;
use Livewire\WithPagination;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use DB;

class Quiz extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $ujian_id;
    public $user_id;
    public $selectedAnswers = [];
    public $total_soal;
    public $subject;
    public $user;
    protected $listeners = ['endTimer' => 'submitAnswers'];

    public function mount($id)
    {
        $this->ujian_id = $id;
    }

    public function questions()
    {
        $exam = Ujian::findOrFail($this->ujian_id);
        $exam_questions = $exam->questions;
        $this->total_soal = $exam->count();

        if($this->total_soal >= $exam->total_soal) {
            $questions = $exam->soals()->take($exam->total_soal)->paginate(1);
        } elseif($this->total_soal < $exam->total_soal ) {
            $questions = $exam->soals()->take($this->total_soal)->paginate(1);
        }

        // dd($exam);
        return $questions;
    }

    public function user() {
      $user = User::findOrFail(Auth()->id());

      return $user;
    }

    public function answers($questionId, $option)
    {
        $this->selectedAnswers[$questionId] = $questionId.'-'.$option;
    }

    public function submitAnswers()
    {
        if(!empty($this->selectedAnswers))
        {

            $score = 0;
            foreach($this->selectedAnswers as $key => $value)
            {
                $userAnswer = "";
                $rightAnswer = Soal::findOrFail($key)->jawaban;
                $userAnswer = substr($value, strpos($value,'-')+1);
                $bobot = 100 / count($this->selectedAnswers);
                if($userAnswer == $rightAnswer){
                    $score = $score + $bobot;
                    $score = abs(round($score));
                }
            }

        }else{
            $score = 0;
        }

        $selectedAnswers_str = json_encode($this->selectedAnswers);
        $this->user_id = Auth()->id();
        $user = User::findOrFail($this->user_id);
        $user_exam = $user->whereHas('ujians', function (Builder $query) {
            $query->where('ujian_id',$this->ujian_id)->where('user_id',$this->user_id);
        })->count();

        // Cek jenis ujian
        $cek_nilai = DB::table('ujians as a')
            ->join('jenis_soals as b', 'a.id_jenis', '=', 'b.id')
            ->select('b.nama_soal')
            ->where('a.id', $this->ujian_id)
            ->first();

        $data_nilai = strtolower(str_replace(' ', '_', $cek_nilai->nama_soal));

        if($user_exam == 0)
        {
            $user->ujians()->attach($this->ujian_id, ['catatan_jawaban' => $selectedAnswers_str, 'nilai' => $score]);

            // Cek user
            $cek_user = DB::table('data_nilais')
                        ->where('id_user', '=', $this->user_id)
                        ->first();

            if($cek_user)
            {
                if($data_nilai == 'pengetahuan_umum')
                {
                    DB::table('data_nilais')
                    ->where('id_user', '=', $cek_user->id_user)
                    ->update([
                        'nilai_pengetahuan' => $score
                    ]);
                } else if($data_nilai == 'pengetahuan_minat')
                {
                    DB::table('data_nilais')
                    ->where('id_user', '=', $cek_user->id_user)
                    ->update([
                        'nilai_minat' => $score
                    ]);
                } else if($data_nilai == 'psikotest')
                {
                    DB::table('data_nilais')
                    ->where('id_user', '=', $cek_user->id_user)
                    ->update([
                        'nilai_psikotest' => $score
                    ]);
                }
            } else {
                if($data_nilai == 'pengetahuan_umum')
                {
                    DB::table('data_nilais')->insert([
                        'id_user' => $this->user_id,
                        'nilai_pengetahuan' => $score
                    ]);
                } else if($data_nilai == 'pengetahuan_minat')
                {
                    DB::table('data_nilais')->insert([
                        'id_user' => $this->user_id,
                        'nilai_minat' => $score
                    ]);
                } else if($data_nilai == 'psikotest')
                {
                    DB::table('data_nilais')->insert([
                        'id_user' => $this->user_id,
                        'nilai_psikotest' => $score
                    ]);
                }
            }

        } else{
            $user->ujians()->updateExistingPivot($this->ujian_id, ['catatan_jawaban' => $selectedAnswers_str, 'nilai' => $score]);


            if($data_nilai == 'pengetahuan_umum')
            {
                DB::table('data_nilais')
                ->where('id_user', '=', $this->user_id)
                ->update([
                    'nilai_pengetahuan' => $score
                ]);
            } else if($data_nilai == 'pengetahuan_minat')
            {
                DB::table('data_nilais')
                ->where('id_user', '=', $this->user_id)
                ->update([
                    'nilai_minat' => $score
                ]);
            } else if($data_nilai == 'psikotest')
            {
                DB::table('data_nilais')
                ->where('id_user', '=', $this->user_id)
                ->update([
                    'nilai_psikotest' => $score
                ]);
            }
        }

        return redirect()->route('ujians.result', [$score, $this->user_id, $this->ujian_id]);
    }

    public function render()
    {
        return view('livewire.quiz', [
            'exam'      => Ujian::findOrFail($this->ujian_id),
            'questions' => $this->questions(),
            'image'     => new Gambar()
        ]);
    }
}
