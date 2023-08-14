<?php

namespace App\DataObjects;

use App\DataObjects\LocationDto;

class BoxDto
{
    public function __construct(
        private string $id,
        private string $name,
        private string $model,
        private string $exposure,
        private string $description,
        private LocationDto $currentLocation,
        private string $updatedAt,
        private array $sensors = [],
    ) {
        $this->sensors = array_map(fn ($sensor) => new SensorDTO(...$sensor), $this->sensors);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getExposure(): string
    {
        return $this->exposure;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCurrentLocation(): LocationDto
    {
        return $this->currentLocation;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getSensors(): array
    {
        return $this->sensors;
    }

    /**
     * Set sensors
     *
     * @param SensorDTO[] $sensors
     * @return void
     */
    public function setSensors(array $sensors): void
    {
        $this->sensors = $sensors;
    }
}
