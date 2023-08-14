<?php

namespace App\Clients\OpenSenseMap;

use App\Contracts\SensorClientContract;
use App\Clients\OpenSenseMap\Utils;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class OpenSenseMapClient implements SensorClientContract
{
    private const BASE_URL = 'https://api.opensensemap.org/';
    private const BOX_URL = 'boxes';
    private const TIMEOUT_IN_SEC = 300;

    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl(self::BASE_URL)->timeout(self::TIMEOUT_IN_SEC);
    }

    public function fetchBoxes(): array
    {
        return $this->client->get(self::BOX_URL)->json();
    }

    public function transformResponseToDto(array $response): array
    {
        return Utils::convertResponseToDto($response);
    }
}
