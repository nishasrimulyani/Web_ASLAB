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

class Quiz extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $ujian_id;
    public $user_id;
    public $selectedAnswers = [];
    public $total_soal;
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
        return $questions;
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
                $bobot = 100 / $this->total_soal;
                if($userAnswer == $rightAnswer){
                    $score = $score + $bobot;
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
        if($user_exam == 0)
        {
            $user->ujians()->attach($this->ujian_id, ['catatan_jawaban' => $selectedAnswers_str, 'nilai' => $score]);
        } else{
            $user->ujians()->updateExistingPivot($this->ujian_id, ['catatan_jawaban' => $selectedAnswers_str, 'nilai' => $score]);
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
