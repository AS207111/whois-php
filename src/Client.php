<?php

namespace AS207111\Whois;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Client
{
    private string $accessToken;

    private \GuzzleHttp\Client $client;

    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => 'https://whois.as207111.net/api/',
        ]);
    }

    public function whois(array $query): Result
    {
        try {
            $response = $this->client->get('lookup', [
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->accessToken),
                ],
                RequestOptions::QUERY => $query
            ]);
        } catch (ClientException $exception) {
            return new Result($exception->getResponse(), $exception);
        } catch (GuzzleException $exception) {
            return new Result(null, $exception);
        }

        return new Result($response);
    }
}