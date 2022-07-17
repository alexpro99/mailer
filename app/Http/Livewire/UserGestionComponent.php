<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use Livewire\WithPagination;

class UserGestionComponent extends Component
{
    use WithPagination;

    //propiedades de estado
    public $filter, $inputs = 10, $sortColumn = 'id', $sortDirection = 'asc', $columns, $createModalToggle = false;
    protected $paginationTheme = "tailwind";

    //controla el usuario seleccionado
    public $selectedUser;





    public function mount()
    {
        //inicializo las columnas de la tabla usuario que se van a mostrar en el orden de visualizacion
        $this->columns = [
            'id',
            'email',
            'name',
            'phone_number',
            'cedula',
            'birth_date',
            'city_code',
            'role',
            'city_code',
            'age'
        ];

        $this->selectedUser = User::first()->id;
    }


    public function render()
    {
        //se consulta los usuarios y se aplica el filtro
        $users = User::where('name', 'like', '%' . $this->filter . '%')
            ->orWhere('email', 'like', '%' . $this->filter . '%')
            ->orWhere('cedula', 'like', '%' . $this->filter . '%')
            ->orWhere('phone_number', 'like', '%' . $this->filter . '%')
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->inputs);


        return view('livewire.crud-users.user-gestion-component', compact('users'));
    }
    //funcion para manejar el ordenamiento por columnas
    public function sort($column)
    {
        if ($column == 'age') {
           $column = 'birth_date';
        }
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    //setea el usuario seleccionado
    public function selectUser($id_user)
    {
        $this->selectedUser = $id_user;
    }
}
