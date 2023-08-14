<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Location;
use App\Models\Sensor;
use App\Models\Box;

class ImportBoxesService
{
    public function __construct(private Collection $boxes)
    {
    }

    public function handle()
    {
        $locations = collect([]);
        $sensors = collect([]);
        $boxesData = collect([]);

        foreach ($this->boxes as $box) {
            $boxesData->push([
                'id' => $box->getId(),
                'name' => $box->getName(),
                'model' => $box->getModel(),
                'exposure' => $box->getExposure(),
                'description' => $box->getDescription(),
            ]);

            $location = $box->getCurrentLocation();
            $locations->push([
                'latitude' => $location->getLatitude(),
                'longitude' => $location->getLongitude(),
                'type' => $location->getType(),
                'timestamp' => $location->getTimestamp(),
                'box_id' => $box->getId()
            ]);

            foreach ($box->getSensors() as $sensor) {
                $sensors->push([
                    'id' => $sensor->getId(),
                    'title' => $sensor->getTitle(),
                    'unit' => $sensor->getUnit(),
                    'sensorType' => $sensor->getSensorType(),
                    'lastMeasurement' => $sensor->getLastMeasurement(),
                    'box_id' => $box->getId()
                ]);
            }
        };

        DB::beginTransaction();

        try {
            $boxesData->chunk(300)->each(function ($boxesChunk) {
                Box::upsert($boxesChunk->toArray(), ['id'], ['name', 'model', 'exposure', 'description']);
            });

            $sensors->chunk(600)->each(function ($sensorsChunk) {
                Sensor::upsert($sensorsChunk->toArray(), ['id'], ['title', 'unit', 'sensorType', 'lastMeasurement', 'icon', 'updated_at', 'box_id']);
            });

            $locations->chunk(300)->each(function ($locationsChunk) {
                Location::upsert($locationsChunk->toArray(), ['id'], ['type', 'latitude', 'longitude', 'box_id']);
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to save boxes. Error: " . $e->getMessage());
        }
    }
}
