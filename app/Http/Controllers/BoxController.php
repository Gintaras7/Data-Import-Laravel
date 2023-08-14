<?php

namespace App\Http\Controllers;

use App\Contracts\SensorClientContract;
use App\Models\Box;
use App\Models\Sensor;
use Exception;

class BoxController extends Controller
{

    public function __construct(private SensorClientContract $client)
    {
    }

    public function index()
    {
        try {
            $result = $this->client->fetchBoxes();

            return response()->json($result);
        } catch (Exception $e) {
            abort(400, 'error occurred');
        }
    }

    public function all()
    {
        return response()->json([
            'sensors' => Sensor::count(),
            'boxes' => Box::count()
        ]);
    }
}
