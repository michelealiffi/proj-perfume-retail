<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Support\Facades\Storage;
use App\Models\Perfume;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    public function index()
    {
        $perfumes = Perfume::where('is_visible', true)
            ->where('quantity', '>', 0)
            ->get();

        return view('index', compact('perfumes'));
    }
}
