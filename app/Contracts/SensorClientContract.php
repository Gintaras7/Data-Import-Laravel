<?php

namespace App\Contracts;

interface SensorClientContract
{
    /**
     * Fetch data from API
     *
     * @return array
     */
    public function fetchBoxes(): array;

    /**
     * Transform response to BoxDto
     *
     * @param array $response
     * @return BoxDto[]
     */
    public function transformResponseToDto(array $response): array;
}
