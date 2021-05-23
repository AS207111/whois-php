<?php

namespace AS207111\Whois;

use Psr\Http\Message\ResponseInterface;
use Throwable;

class Result
{
    private ?ResponseInterface $response;
    private ?Throwable $exception;

    /**
     * @var mixed|null
     */
    private $data = null;

    private bool $success = false;

    private string $message = 'Unknown API Error';

    public function __construct(?ResponseInterface $response = null, ?Throwable $exception = null)
    {
        $this->response = $response;
        $this->exception = $exception;

        if($this->response) {
            $this->success = $response->getStatusCode() === 200;
            $this->data = @json_decode($this->response->getBody()->getContents(), false);
            $this->message = $this->data->message ?? 'Unknown API Error';
        }
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function getException(): ?Throwable
    {
        return $this->exception;
    }

    public function getData()
    {
        return $this->data;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}