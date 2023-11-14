<?php

namespace App\Livewire\Forms;

use App\Models\Commune;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CommuneForm extends Form
{
    public ?Commune $commune;

    #[Rule('required|min:5')]
    public string $nom = '';

    #[Rule('required|integer')]
    public int $id_district;

    public function setCommune(Commune $commune): void
    {
        $this->commune = $commune;
        $this->nom = $commune->nom;
        $this->id_district = $commune->id_district;
    }

    public function save(): void
    {
        $this->validate();

        $commune = Commune::create($this->all());
        //$commune->district()->sync($this->id_district);
    }

    public function update(): void
    {
        $this->validate();

        $this->commune->update($this->all());
        //$this->commune->id_district()->sync($this->id_district);
    }
}
