<?php

use NimiqCommunity\RpcClient\Client;

/**
 * @internal
 * @coversDefaultClass \NimiqCommunity\RpcClient\Client
 */
class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->client = new Client();
        $this->mock = new \GuzzleHttp\Handler\MockHandler();

        $httpClient = new \GuzzleHttp\Client([
            'handler' => $this->mock,
        ]);

        $this->client->setClient($httpClient);
    }

    public function testClientCanBeInstanciated()
    {
        $client = new Client();

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testClientCalculatesBaseUri()
    {
        $client = new Client([
            'scheme' => 'https',
            'host' => 'localhost',
            'port' => '8181',
        ]);

        $baseUri = $client->getBaseUri();

        $this->assertEquals('https://localhost:8181', $baseUri);
    }

    public function testClientCalculatesAuthInfo()
    {
        $client = new Client([
            'user' => 'admin',
            'password' => 'root',
        ]);

        $auth = $client->getAuth();

        $this->assertEquals([
            'admin', 'root',
        ], $auth);
    }

    public function testClientSendsProperFormattedRequest()
    {
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode([
            'jsonrpc' => '2.0',
            'id' => 0,
            'result' => 1000,
        ])));

        $this->client->request('test', 'test-string', true, 15, [0, 2, 4], ['key' => 'value']);
        $request = $this->mock->getLastRequest();

        $this->assertEquals('POST', $request->getMethod());

        $body = json_decode($request->getBody()->getContents(), true);

        $this->assertEquals(0, $body['id']);
        $this->assertEquals('test', $body['method']);
        $this->assertEquals('test-string', $body['params'][0]);
        $this->assertEquals(true, $body['params'][1]);
        $this->assertEquals(15, $body['params'][2]);
        $this->assertEquals([0, 2, 4], $body['params'][3]);
        $this->assertEquals(['key' => 'value'], $body['params'][4]);
    }

    public function testClientReturnsResponseResult()
    {
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode([
            'jsonrpc' => '2.0',
            'id' => 0,
            'result' => 1000,
        ])));

        $response = $this->client->request('test', 1000);

        $this->assertEquals(1000, $response);
    }

    public function testClientHandlesErrorProperly()
    {
        $this->mock->append(new \GuzzleHttp\Psr7\Response(200, [], json_encode([
            'jsonrpc' => '2.0',
            'id' => 0,
            'error' => [
                'code' => -32601,
                'message' => 'Method not found',
            ],
        ])));

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionCode(-32601);
        $this->expectExceptionMessage('Method not found');

        $this->client->request('test', 1000);
    }
}
