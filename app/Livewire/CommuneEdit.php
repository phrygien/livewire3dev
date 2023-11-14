<?php

namespace App\Livewire;

use App\Livewire\Forms\CommuneForm;
use App\Models\Commune;
use App\Models\District;
use Illuminate\Support\Collection;
use Livewire\Component;

class CommuneEdit extends Component
{
    public CommuneForm $form;

    public Collection $districts;

    public function mount(Commune $commune): void
    {
        $this->form->setCommune($commune);
        $this->districts = District::pluck('libelle', 'id');
    }

    public function save(): void
    {
        $this->form->update();

        $this->redirect('/autres/communes');
    }

    public function render()
    {
        return view('livewire.commune-edit');
    }
}
