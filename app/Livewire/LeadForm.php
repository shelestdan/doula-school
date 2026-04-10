<?php

namespace App\Livewire;

use App\Domain\Leads\Actions\CreateLeadAction;
use Livewire\Component;

class LeadForm extends Component
{
    public string $name    = '';
    public string $phone   = '';
    public string $email   = '';
    public string $message = '';
    public string $source;
    public bool   $sent    = false;

    public function mount(string $source = 'website'): void
    {
        $this->source = $source;
    }

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
            'email.email'    => 'Некорректный email.',
        ];
    }

    public function submit(CreateLeadAction $action): void
    {
        $this->validate();

        $utms = session('utms', []);

        $action->execute([
            'name'         => $this->name,
            'phone'        => $this->phone,
            'email'        => $this->email ?: null,
            'message'      => $this->message ?: null,
            'source'       => $this->source,
            'utm_source'   => $utms['utm_source'] ?? null,
            'utm_medium'   => $utms['utm_medium'] ?? null,
            'utm_campaign' => $utms['utm_campaign'] ?? null,
            'utm_content'  => $utms['utm_content'] ?? null,
            'utm_term'     => $utms['utm_term'] ?? null,
        ]);

        $this->sent = true;
        $this->reset(['name', 'phone', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.lead-form');
    }
}
