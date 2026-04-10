<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Services\Models\Service;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::active()->get();
        return view('services.index', compact('services'));
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('services.show', compact('service'));
    }
}
