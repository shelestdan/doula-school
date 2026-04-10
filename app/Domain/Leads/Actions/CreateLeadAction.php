<?php

namespace App\Domain\Leads\Actions;

use App\Domain\Leads\Models\Lead;

class CreateLeadAction
{
    public function execute(array $data): Lead
    {
        return Lead::create([
            'name'         => $data['name'],
            'phone'        => $data['phone'],
            'email'        => $data['email'] ?? null,
            'city'         => $data['city'] ?? null,
            'message'      => $data['message'] ?? null,
            'source'       => $data['source'] ?? 'website',
            'utm_source'   => $data['utm_source'] ?? null,
            'utm_medium'   => $data['utm_medium'] ?? null,
            'utm_campaign' => $data['utm_campaign'] ?? null,
            'utm_content'  => $data['utm_content'] ?? null,
            'utm_term'     => $data['utm_term'] ?? null,
            'course_id'    => $data['course_id'] ?? null,
            'service_id'   => $data['service_id'] ?? null,
            'status'       => 'new',
        ]);
    }
}
