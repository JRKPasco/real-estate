<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Livewire\Component;

class PropertySearch extends Component
{
    public function render()
    {
        return view('livewire.property-search', [
            'properties' => Property::latest()->get()
        ])->layout('layouts.base');
    }
}
