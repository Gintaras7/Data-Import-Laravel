<?php

namespace App\DataObjects;

class LocationDto
{
    public function __construct(
        private float $latitude,
        private float $longitude,
        private string $type,
        private \DateTime|string $timestamp,
        private string $boxId
    ) {
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTimestamp(): \DateTime|string
    {
        if ($this->timestamp instanceof \DateTime) {
            return $this->timestamp;
        }

        return $this->timestamp;
    }

    public function getBoxId(): string
    {
        return $this->boxId;
    }
}
