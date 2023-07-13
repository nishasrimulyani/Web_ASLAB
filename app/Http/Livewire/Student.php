<?php

namespace App\Http\Livewire;

use App\Models\Ujian;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Student extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $q = null;
    public $selectedStudent = [];

    public function mount($selectedExam = null)
    {
        if (is_null($selectedExam)) {
            $this->selectedStudent = [];
        } else {
            $this->selectedStudent = Ujian::findOrFail($selectedExam)->users()->pluck('user_id')->toArray();
        }
       
    }

    public function deselectStudent($userId)
    {
        if (($key = array_search($userId, $this->selectedStudent)) !== false) {
            unset($this->selectedStudent[$key]);
        }
    }

    public function render()
    {
        if (empty($this->selectedStudent)) {
            return view('livewire.student', [
                'students' => User::role('peserta')->latest()
                                ->when($this->q != null, function($users) {
                                    $users = $users->role('peserta')->where('name', 'like', '%'. $this->p . '%');
                                    })
                                    ->paginate(5),
                ]);
        } else {
            return view('livewire.student', [
                'students' => User::role('peserta')->latest()
                                ->when($this->q != null, function($users) {
                                    $users = $users->role('peserta')->where('name', 'like', '%'. $this->p . '%');
                                    })
                                    ->whereNotIn('id', $this->selectedStudent)
                                    ->paginate(5),
                'studentsAll' => User::role('peserta')->latest()->whereIn('id', $this->selectedStudent)->get()
                ]);
        }
        
    }
}
