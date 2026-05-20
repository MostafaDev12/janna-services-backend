<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ImportantNumber;
use Illuminate\View\View;

class ImportantNumberController extends Controller
{
    public function index(): View
    {
        $numbers = ImportantNumber::active()->ordered()->get();
        return view('web.important_numbers', compact('numbers'));
    }
}
