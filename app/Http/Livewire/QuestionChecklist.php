<?php

namespace App\Http\Livewire;

use App\Models\Ujian;
use App\Models\JenisSoal;
use Livewire\Component;
use App\Models\Soal;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class QuestionChecklist extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $q = null;
    public $p = null;
    public $selectedQuestion = [];
    public $question_list = [];

    public function mount($selectedExam = null)
    {
        if (is_null($selectedExam)) {
            $this->selectedQuestion = [];
        } else {
            $this->selectedQuestion = Ujian::findOrFail($selectedExam)->questions()->pluck('question_id')->toArray();
        }
       
    }

    public function deselectQuestion($questionId)
    {
        if (($key = array_search($questionId, $this->selectedQuestion)) !== false) {
            unset($this->selectedQuestion[$key]);
        }
    }

    public function updatedSelectedQuestion()
    {

        $this->dispatchBrowserEvent('question-updated', ['selectedQuestion' => $this->selectedQuestion]);
    }

    public function render()
    {
        if (empty($this->selectedQuestion)) {
            return view('livewire.question-checklist', [
                'questions' => Soal::latest()
                                ->when($this->q != null, function($questions) {
                                            $questions = $questions->where('detail', 'like', '%'. $this->q . '%');})
                                ->when($this->p != null, function($questions) {
                                    $questions = $questions->whereHas('subject', function (Builder $query) {
                                        $query->where('name', 'like', '%'. $this->p . '%');
                                    })->get();
                                    })
                                ->paginate(5),
                'subject' => new JenisSoal()
                ]);
        } else {
            return view('livewire.question-checklist', [
                'questions' => Soal::latest()
                                ->when($this->q != null, function($questions) {
                                            $questions = $questions->where('detail', 'like', '%'. $this->q . '%');})
                                ->when($this->p != null, function($questions) {
                                    $questions = $questions->whereHas('subject', function (Builder $query) {
                                        $query->where('name', 'like', '%'. $this->p . '%');
                                    })->get();
                                    })->whereNotIn('id', $this->selectedQuestion)
                                ->paginate(5),
                'questionsAll' => Soal::latest()->whereIn('id', $this->selectedQuestion)->get(),
                'subject' => new JenisSoal()
                ]);
        }
        
        
        // dd($this->questions);
    }

    
}
