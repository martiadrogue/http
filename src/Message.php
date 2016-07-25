<?php

namespace MartiAdrogue\Http;

use MartiAdrogue\Http\Exception\MissingRequestMetaVariableException;
use MartiAdrogue\Http\Behaviour\Messageable;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Message implements Messageable
{
    const PROTOCOL_11 = '1.1';

    private $version;
    private $headers;
    private $body;

    public function __construct($version, array $headers, StreamInterface $body)
    {
        $this->version = $version;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getProtocolVersion()
    {
        return $this->version;
    }

    public function withProtocolVersion($version)
    {
        return new self($version, $this->headers, $this->body);
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function hasHeader($name)
    {
        return array_key_exists($name, $this->headers);
    }

    public function getHeader($name)
    {
        return $this->headers[$name];
    }

    public function getHeaderLine($name)
    {
        return implode(', ', $this->getHeader($name));
    }

    public function withHeader($name, $value)
    {
        $value = $this->arrayify($value);

        $headers = $this->getHeaders();
        $headers[$name] = $value;

        return new self($this->version, $headers, $this->body);
    }

    public function withAddedHeader($name, $value)
    {
        $value = $this->arrayify($value);

        $headers = $this->getHeaders();
        $headers[$name] = array_merge($headers[$name], $value);

        return new self($this->version, $headers, $this->body);
    }

    public function withoutHeader($name)
    {

        $headers = $this->getHeaders();
        $value = $headers[$name];

        $headersDifference = array_diff($headers, [$name => $value]);

        return new self($this->version, $headersDifference, $this->body);
    }

    public function getBody()
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body)
    {
        return new self($this->version, $this->headers, $body);
    }

    private function arrayify($value)
    {
        if (!is_array($value)) {
            return [$value];
        }

        return $value;
    }
}
