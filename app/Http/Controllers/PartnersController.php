<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Partners\Models\Partner;

class PartnersController extends Controller
{
    public function index(): View
    {
        $partners = Partner::active()->get();
        return view('partners', compact('partners'));
    }
}
