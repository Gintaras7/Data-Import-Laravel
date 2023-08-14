<?php

namespace App\Clients\OpenSenseMap;

use Illuminate\Support\Facades\Log;
use App\DataObjects\LocationDto;
use App\DataObjects\SensorDTO;
use App\DataObjects\BoxDto;

class Utils
{
    public static function convertResponseToDto(array $fetchedBoxes): array
    {
        $boxes = [];
        foreach ($fetchedBoxes as $box) {
            try {
                $boxDto = self::convertToBoxDto($box);

                if (isset($box['sensors'])) {
                    $sensors = self::convertToSensorDTO(
                        $box['sensors'],
                        $box['_id']
                    );

                    $boxDto->setSensors($sensors);
                }

                $boxes[] = $boxDto;
            } catch (\Exception $e) {
                Log::error(sprintf("Failed to import box: '%s'. Error: %s", $box['name'], $e->getMessage()));
            }
        }

        return $boxes;
    }

    public static function convertToBoxDto(array $box): BoxDto
    {
        $locationData = $box['currentLocation'];
        $description = isset($box['description']) ?: '';

        $location = new LocationDto(
            $locationData['coordinates'][0],
            $locationData['coordinates'][1],
            $locationData['type'],
            $locationData['timestamp'],
            $box['_id']
        );

        $boxDto = new BoxDto(
            $box['_id'],
            $box['name'],
            $box['model'],
            $box['exposure'],
            $description,
            $location,
            $box['updatedAt']
        );

        return $boxDto;
    }

    public static function convertToSensorDTO(array $sensors, string $boxId): array
    {
        $results = [];

        foreach ($sensors as $sensorData) {
            try {
                $results[] = new SensorDTO(
                    $sensorData['_id'],
                    $sensorData['title'],
                    $sensorData['unit'],
                    $sensorData['sensorType'] ?? '',
                    $boxId,
                    $sensorData['lastMeasurement'] ?? ''
                );
            } catch (\Exception $e) {
                Log::error(sprintf(
                    "Failed to import sensor: '%s'. Error: %s",
                    $sensorData['name'],
                    $e->getMessage()
                ));
            }
        }

        return $results;
    }
}
