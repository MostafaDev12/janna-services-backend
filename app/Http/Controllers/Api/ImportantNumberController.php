<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImportantNumberResource;
use App\Models\ImportantNumber;

class ImportantNumberController extends Controller
{
    public function index()
    {
        $numbers = ImportantNumber::active()->ordered()->get();
        return ImportantNumberResource::collection($numbers);
    }
}
