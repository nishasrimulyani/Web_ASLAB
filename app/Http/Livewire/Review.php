<?php

namespace App\Http\Livewire;

use App\Models\Ujian;
use App\Models\User;
use App\Models\Gambar;
use Livewire\Component;
use Livewire\WithPagination;

class Review extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $user_id;
    public $ujian_id;
    public $selectedAnswers = [];
    public $total_soal;

    public function mount($user_id, $ujian_id)
    {
        $this->user_id = $user_id;
        $this->ujian_id = $ujian_id;
        $user = User::findOrfail($user_id);
        $user_exam = $user->ujians->find($ujian_id);
        $answer = $user_exam->pivot->catatan_jawaban;

        $result = json_decode($answer);
        $this->selectedAnswers = (array)$result;
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

    public function getAnswers()
    {
        
    }

    public function render()
    {
        return view('livewire.review', [
            'exam'      => Ujian::findOrFail($this->ujian_id),
            'questions' => $this->questions(),
            'image'     => new Gambar()
        ]);
    }
}
