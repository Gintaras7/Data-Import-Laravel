<?php

namespace App\DataObjects;

class SensorDto
{
    public function __construct(
        public string $id,
        public string $title,
        public string $unit,
        public string $sensorType,
        public string $boxId,
        public ?string $lastMeasurement = null
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getSensorType(): string
    {
        return $this->sensorType;
    }

    public function getBoxId(): string
    {
        return $this->boxId;
    }

    public function getLastMeasurement(): ?string
    {
        return $this->lastMeasurement;
    }
}
