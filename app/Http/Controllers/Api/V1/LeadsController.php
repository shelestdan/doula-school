<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Domain\Leads\Actions\CreateLeadAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function store(Request $request, CreateLeadAction $action): JsonResponse
    {
        $data = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'phone'        => ['required', 'string', 'max:20'],
            'email'        => ['nullable', 'email', 'max:255'],
            'message'      => ['nullable', 'string', 'max:2000'],
            'source'       => ['nullable', 'string', 'max:100'],
            'utm_source'   => ['nullable', 'string', 'max:100'],
            'utm_medium'   => ['nullable', 'string', 'max:100'],
            'utm_campaign' => ['nullable', 'string', 'max:100'],
            'utm_content'  => ['nullable', 'string', 'max:100'],
            'utm_term'     => ['nullable', 'string', 'max:100'],
        ]);

        $lead = $action->execute($data);

        return response()->json(['message' => 'Заявка принята.', 'id' => $lead->id], 201);
    }
}
