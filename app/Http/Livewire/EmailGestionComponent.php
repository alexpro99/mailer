<?php

namespace App\Http\Livewire;

use App\Models\Email;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class EmailGestionComponent extends Component
{
    use WithPagination;
    //propiedades de estado del componente
    public $filter, $mailState = 'sended', $selectedMail = '', $inputs,
     $createModalToggle = false,
     $editModalToggle = false,
      $viewModalToggle = false;
    protected $paginationTheme = 'tailwind';

    //propiedades de la modelo
    public $topic, $destiny, $body;

    //reglas de validacion
    protected $rules = [
        'topic' => 'required',
        'destiny' => 'required|email',
        'body' => 'nullable'
    ];

    public function mount()
    {

    }

    public function render()
    {
        $emails = Email::where('destiny', 'like', '%' . $this->filter . '%')
            ->where('state', $this->mailState);
        if (Auth::user()->role == 'user') {
            $emails = $emails->where('user_id', Auth::user()->id);
        }
        $emails = $emails->paginate($this->inputs);

        $cantSended = Email::where('state', 'sended')->count();
        $cantNotSended = Email::where('state', 'not sended')->count();
        $cantStored = Email::where('state', 'stored')->count();

        return view('livewire.crud-emails.email-gestion-component', compact('emails', 'cantSended', 'cantNotSended', 'cantStored'));
    }

    public function showCreate()
    {
        $this->createModalToggle = true;
    }

    public function store()
    {
        $this->validate();
        $email = new Email();
        $email->topic = $this->topic;
        $email->destiny = $this->destiny;
        $email->body = $this->body;
        $email->state = 'stored';
        $email->user_id = Auth::user()->id;
        if ($email->save()) {
            session()->flash('message', 'Mail saved as draft');
        }
    }

    public function send()
    {
        $this->validate();
        $email = new Email();
        $email->topic = $this->topic;
        $email->destiny = $this->destiny;
        $email->body = $this->body;
        $email->state = 'not sended';
        $email->user_id = Auth::user()->id;
        if ($email->save()) {
            session()->flash('message', 'Mail in queue to send');
        }
    }

    public function setSelectMail($mail_id)
    {
        $this->selectedMail = $mail_id;
    }

    public function delete($email_id)
    {
        $email = Email::find($email_id);
        if ($email->delete()) {
            session()->flash('message', 'Email succefull deleted');
        } else session()->flash('errorMessage', 'An error ocurred while deleting email');
    }



    public function view($email_id)
    {
        $email = Email::find($email_id);
        $this->selectedMail = $email_id;
        $this->topic = $email->topic;
        $this->destiny = $email->destiny;
        $this->body = $email->body;
        $this->viewModalToggle = true;

    }
    public function editView($email_id)
    {
        $email = Email::find($email_id);
        $this->selectedMail = $email_id;
        $this->topic = $email->topic;
        $this->destiny = $email->destiny;
        $this->body = $email->body;
        $this->editModalToggle = true;

    }

    public function edit()
    {
        $this->validate();
        $email = Email::find($this->selectedMail);
        $email->topic = $this->topic;
        $email->destiny = $this->destiny;
        $email->body = $this->body;
        $email->state = 'stored';
        $email->user_id = Auth::user()->id;
        if ($email->save()) {
            session()->flash('message', 'Mail in queue to send');
        }
    }

    public function sendSaved()
    {
        $email = Email::find($this->selectedMail);
        $email->topic = $this->topic;
        $email->destiny = $this->destiny;
        $email->body = $this->body;
        $email->state = 'not sended';
        if ($email->save()) {
            session()->flash('message', 'Mail in queue to send');
        }
    }
}
