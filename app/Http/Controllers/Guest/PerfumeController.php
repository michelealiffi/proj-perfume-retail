<?php

namespace App\Http\Controllers\Guest;

use App\Models\Perfume;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    private $jsonFile = 'json/perfumes.json';

    private function getPerfumes()
    {
        $filePath = storage_path('app/' . $this->jsonFile);
        if (!file_exists($filePath)) {
            return [];
        }
        return json_decode(file_get_contents($filePath), true) ?? [];
    }

    public function index()
    {
        $perfumes = $this->getPerfumes();
        return view('index', compact('perfumes'));
    }
}
