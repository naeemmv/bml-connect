<?php

namespace Naeemmv\BmlConnect;

use BMLConnect\Crypt\Signature;
use BMLConnect\Model\Transaction;

class BmlConnect
{
    private Client $client;
    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $appId
     * @param string $mode
     * @param array $clientOptions
     */
    public function __construct(string $apiKey, string $appId, $mode = 'sandbox', array $clientOptions = [])
    {
        $this->client = new Client($apiKey, $appId, $mode, $clientOptions);
    }

    private function makeTransaction(array $data): Transaction
    {
        return (new Transaction())->fromArray($data);
    }

    public function verifySignature(array $data): bool
    {
        $generatedSignature = (new Signature($this->makeTransaction($data), $this->client->getApiKey()))->sign();
        return !is_null($generatedSignature) && $generatedSignature === ($data['signature'] ?? null);
    }

    public function createTransaction(array $data)
    {
        return $this->client->transactions->create($data);
    }

    public function getTransaction(string $id)
    {
        return $this->client->transactions->get($id);
    }

    public function listTransactions(array $params)
    {
        return $this->client->transactions->list($params);
    }
}