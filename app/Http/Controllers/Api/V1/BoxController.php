<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Box;
use App\Http\Controllers\Controller;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::with('sensors', 'location')->paginate(15);

        return response()->json($boxes);
    }
}
