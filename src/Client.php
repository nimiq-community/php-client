<?php

namespace NimiqCommunity\RpcClient;

use BadMethodCallException;
use GuzzleHttp\Client as GuzzleHttp;

/**
 * Generic RPC client.
 *
 * @internal
 */
class Client
{
    /**
     * Http Client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Client configuration.
     */
    protected $config = [
        'scheme' => 'http',
        'host' => '127.0.0.1',
        'port' => 8648,
        'user' => null,
        'password' => null,
        'timeout' => false,
    ];

    /**
     * URL path.
     *
     * @var string
     */
    protected $path = '/';

    /**
     * JSON-RPC Id.
     *
     * @var int
     */
    protected $rpcId = 0;

    public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);

        // construct http client
        $httpClient = new GuzzleHttp([
            'base_uri' => $this->getBaseUri(),
            'auth' => $this->getAuth(),
            'timeout' => (float) $this->config['timeout'],
            'connect_timeout' => (float) $this->config['timeout'],
        ]);

        $this->setClient($httpClient);
    }

    /**
     * Makes request to Nimiq Node.
     *
     * @param mixed $params
     */
    public function request(string $method, ...$params)
    {
        $originalResponse = $this->client->post($this->path, $this->makeJson($method, $params));

        $response = new NimiqResponse($originalResponse);

        if ($response->hasError()) {
            throw new BadMethodCallException($response->getError()['message'], $response->getError()['code']);
        }

        if ($response->hasResult()) {
            return $response->getResult();
        }
    }

    /**
     * Gets authentication array.
     */
    public function getAuth(): array
    {
        return [
            $this->config['user'],
            $this->config['password'],
        ];
    }

    /**
     * Gets the base uri.
     */
    public function getBaseUri(): string
    {
        return $this->config['scheme'] . '://' . $this->config['host'] . ':' . $this->config['port'];
    }

    /**
     * Sets the HTTP client.
     */
    public function setClient(GuzzleHttp $client)
    {
        $this->client = $client;
    }

    /**
     * Construct json request.
     *
     * @param mixed $params
     */
    protected function makeJson(string $method, $params = []): array
    {
        return [
            'json' => [
                'jsonrpc' => '2.0',
                'method' => $method,
                'params' => (array) $params,
                'id' => $this->rpcId++,
            ],
        ];
    }
}
