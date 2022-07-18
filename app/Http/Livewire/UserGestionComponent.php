<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules\Password;

class UserGestionComponent extends Component
{
    use WithPagination;

    //propiedades de estado
    public $filter, $inputs = 10, $sortColumn = 'id', $sortDirection = 'asc', $columns, $createModalToggle = false, $editModalToggle = false;
    protected $paginationTheme = "tailwind";

    //controla el usuario seleccionado
    public $selectedUser;

    //propiedades para consumir del api de paises
    private $api_token = 'A0qzTg5ZF3zIusP4YMaRWW7TBtk839VPLXmCka2hJ1IFzhIAGmt-bTech_1Inq6vweA';
    private $api_url = 'https://www.universal-tutorial.com/api/';
    public $auth_token = '';

    //propiedades del formulario
    //---selects
    public $countries = [];
    public $states = [];
    public $cities = [];

    //---propiedades de usuario
    public $name, $email, $identificator, $password, $password_confirmation, $cedula, $phone_number, $birth_date, $city_code;
    public $country, $state, $city;


    protected $messages = [
        'birth_date.before' => 'You must be 18+'
    ];
    //reglas de validacion
    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users',
            'phone_number' => 'nullable|numeric|digits_between:6,10',
            'cedula' => 'required|numeric|digits_between:11,11',
            'birth_date' => 'required|date|before:now - 18 years',
            'identificator' => 'required|numeric',
            'city' => 'required',
            'city_code' => 'required|numeric',
            'password' => ['confirmed', 'required',],
            'password_confirmation' => 'required|same:password'
        ];
    }
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
            'city',
            'age'
        ];
        //se selecciona por defecto el primer elemento
        $this->selectedUser = User::first()->id;
    }

    public function redyToLoadCountries()
    {
        // obteniendo el bearer token de la api
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'api-token' => $this->api_token,
            'user-email' => 'acuevasferras@gmail.com'
        ])->get('https://www.universal-tutorial.com/api/getaccesstoken');

        $data = (array)json_decode($response->body());
        $this->auth_token = $data['auth_token'];

        $countryResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->auth_token
        ])->get('https://www.universal-tutorial.com/api/countries/');

        $this->countries = (array)json_decode($countryResponse->body());
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

    //al actualizar pais
    public function updatedCountry()
    {
        $stateResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->auth_token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/states/' . $this->country);

        $this->states = (array)json_decode($stateResponse->body());
    }

    //al actualizar estado
    public function updatedState()
    {
        $cityResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->auth_token,
            "Accept" => "application/json"
        ])->get('https://www.universal-tutorial.com/api/cities/' . $this->state);

        $this->cities = (array)json_decode($cityResponse->body());
    }

    //crea un nuevo usuario
    public function store()
    {
        //validar reglas
        $this->validate();
        //validar el password con todo lo que lleva
        Validator::make(
            ['password' => $this->password],
            ['password' => Password::min(8)->symbols()->mixedCase()->numbers()]
        )->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->identificator = $this->identificator;
        $user->phone_number = $this->phone_number;
        $user->cedula = $this->cedula;
        $user->birth_date = $this->birth_date;
        $user->city_code = $this->city_code;
        $user->city = $this->city;


        if ($user->save()) {
            session()->flash('message', 'User succefull created');
        }
    }

    public function prepareEdit()
    {
        $selectedUser = User::find($this->selectedUser);
        $this->name = $selectedUser->name;
        $this->identificator = $selectedUser->identificator;
        $this->phone_number = $selectedUser->phone_number;
        $this->birth_date = $selectedUser->birth_date;
        $this->city_code = $selectedUser->city_code;
        $this->editModalToggle = true;
    }

    public function edit()
    {
        $user = User::find($this->selectedUser);
        $user->name = $this->name;
        $user->identificator = $this->identificator;
        $user->phone_number = $this->phone_number;
        $user->birth_date = $this->birth_date;
        $user->city_code = $this->city_code;
        if ($user->save()) {
            session()->flash('message', 'User edited succefully');
        }
    }

    public function showCreate()
    {
        $this->reset('name', 'identificator', 'phone_number', 'birth_date', 'city_code');
        $this->createModalToggle = true;
    }

    public function delete()
    {
        $user = User::find($this->selectedUser);
        $user_name = $user->name;
        if ($user->email != Auth::user()->email) {
            $user->delete();
            session()->flash('message', 'User ' . $user_name . ' has been deleted');
        } else{
            session()->flash("message', 'You can't delete your account since this view");
        }
    }
}
