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

    public function getTimestamp(): \DateTime
    {
        $timestamp = $this->timestamp instanceof \DateTime
            ? $this->timestamp
            : (new \DateTime($this->timestamp));

        $formattedDate = $timestamp->format('Y-m-d H:i:s');

        return new \DateTime($formattedDate);
    }

    public function getBoxId(): string
    {
        return $this->boxId;
    }
}
