<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('customer.home', [
            'layanan' => Layanan::active()->orderBy('nama_layanan')->get(),
        ]);
    }

    public function services(): View
    {
        return view('customer.services', [
            'layanan' => Layanan::active()->orderBy('nama_layanan')->get(),
        ]);
    }
}
