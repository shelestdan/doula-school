<?php

namespace App\Livewire;

use App\Domain\Leads\Actions\CreateLeadAction;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name    = '';
    public string $phone   = '';
    public string $email   = '';
    public string $message = '';
    public bool   $sent    = false;

    protected function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'phone'   => ['required', 'string', 'max:20'],
            'email'   => ['nullable', 'email', 'max:255'],
            'message' => ['nullable', 'string', 'max:2000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required'  => 'Укажите ваше имя.',
            'phone.required' => 'Укажите номер телефона.',
        ];
    }

    public function submit(CreateLeadAction $action): void
    {
        $this->validate();

        $action->execute([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'email'   => $this->email ?: null,
            'message' => $this->message ?: null,
            'source'  => 'contacts_page',
        ]);

        $this->sent = true;
        $this->reset(['name', 'phone', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
