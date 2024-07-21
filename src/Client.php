<?php

namespace Naeemmv\BmlConnect;

use BMLConnect\Client as BMLClient;

class Client extends BMLClient
{
    const DEV_ENDPOINT = 'https://pay.naeem.mv/';

    private string $baseUrl;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $appId
     * @param string $mode
     * @param array $clientOptions
     */
    public function __construct(string $apiKey, string $appId, $mode = 'production', array $clientOptions = [])
    {
        parent::__construct($apiKey, $appId, $mode, $clientOptions);

        $this->baseUrl = ($mode === 'development') ? self::DEV_ENDPOINT : $this->baseUrl;
    }
}