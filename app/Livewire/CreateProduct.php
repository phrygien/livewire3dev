<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class CreateProduct extends Component
{
    public $product;
    public $formtitle = "Create Product";
    public $editfor = false;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $description;

    #[Rule('required')]
    public $price;


    public function render()
    {
        return view('livewire.create-product');
    }

    public function save(){
        $validated = $this->validate();
        Product::create($validated);
        $this->dispatch('refresh-products');
        session()->flash('status', 'product created!');
        $this->reset();
    }

    #[On('reset-modal')]
    public function close()
    {
        $this->reset();
    }
}
