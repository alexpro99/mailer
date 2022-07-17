<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserGestionComponent extends Component
{
    public $filter;



    public function render()
    {
        
        return view('livewire.user-gestion-component');
    }
}
