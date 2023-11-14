<?php

namespace App\Livewire;

use App\Models\Commune;
use App\Models\District;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Communes extends Component
{
    use WithPagination;

    public Collection $districts;
    public string $searchQuery = '';
    public int $searchDistrict = 0;

    public $selectedCommunes = [];
    public $selectAll = false;
    public $checkeditems = 0;

    public function mount(): void
    {
        $this->checkeditems = count($this->selectedCommunes);
        $this->districts = District::pluck('libelle', 'id');
    }

    public function updating($key): void
    {
        if($key === 'searchQuery' || $key === 'searchDistrict') {
            $this->resetPage();
        }
    }

    public function deleteCommune(int $communeId): void
    {
        Commune::where('id', $communeId)->delete();
    }

    public function render()
    {
        $communes = Commune::with('district')
        ->when($this->searchQuery !== '', fn(Builder $query) => $query->where('nom', 'like', '%'. $this->searchQuery .'%'))
//            ->when($this->searchCategory > 0, fn(Builder $query) => $query->where('category_id', $this->searchCategory))
        ->when($this->searchDistrict > 0, function (Builder $query) {
            $query->whereHas('district', function (Builder $query2) {
                $query2->where('id', $this->searchDistrict);
            });
        })
        ->paginate(10);

        return view('livewire.communes', [
            'communes' => $communes
        ]);
    }

    public function deleteSelected()
    {
        Commune::whereIn('id', $this->selectedCommunes)->delete();
        $this->selectedCommunes = [];

        $this->selectAll = false;
        $this->render();
    }

    public function getSelectedCountProperty()
    {
        return count($this->selectedCommunes);
    }

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;

        // If "Select All" is checked, set all communes as selected
        if ($this->selectAll) {

            $this->selectedCommunes = Commune::with('district')
            ->when($this->searchQuery !== '', function (Builder $query) {
                $query->where('nom', 'like', '%'. $this->searchQuery .'%');
            })
            // Uncomment the next line if you have a 'category_id' field in your 'communes' table
            // ->when($this->searchCategory > 0, function (Builder $query) {
            //     $query->where('category_id', $this->searchCategory);
            // })
            ->when($this->searchDistrict > 0, function (Builder $query) {
                $query->whereHas('district', function (Builder $query2) {
                    $query2->where('id', $this->searchDistrict);
                });
            })
            ->paginate(10)
            ->pluck('id')
            ->toArray();
        } else {
            $this->selectedCommunes = [];
        }
    }


}
