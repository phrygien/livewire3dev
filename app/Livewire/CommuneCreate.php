<?php

namespace App\Livewire;

use App\Livewire\Forms\CommuneForm;
use App\Models\District;
use Illuminate\Support\Collection;
use Livewire\Component;

class CommuneCreate extends Component
{
    public CommuneForm $form;

    public Collection $districts;

    public function mount(): void
    {
        $this->districts = District::pluck('libelle', 'id');
    }
    
    public function render()
    {
        return view('livewire.commune-create');
    }

    public function save(): void
    {
        $this->form->save();
        $this->redirect('/autres/communes');
    }
}
