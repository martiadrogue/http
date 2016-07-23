<?php

namespace MartiAdrogue\Http;

use MartiAdrogue\Http\Exception\MissingRequestMetaVariableException;
use MartiAdrogue\Http\Behaviour\Messageable;
use MartiAdrogue\Http\Behaviour\Streameable;
use Psr\Http\Message\UriInterface;

class Message implements Messageable
{
    private $protocolVersion;
    private $version;
    private $headers;
    private $body;

    public function __construct($protocolVersion, $version, array $headers, Streameable $body)
    {
        $this->protocolVersion = $protocolVersion;
        $this->version = $version;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    public function withProtocolVersion($version)
    {
        return $version;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function hasHeader($name)
    {
        return $name;
    }

    public function getHeader($name)
    {
        return $this->headers[$name];
    }

    public function getHeaderLine($name)
    {
        return $this->headers[$name];
    }

    public function withHeader($name, $value)
    {
        return [$name, $value];
    }

    public function withAddedHeader($name, $value)
    {
        return [$name, $value];
    }

    public function withoutHeader($name)
    {
        return $name;
    }

    public function getBody()
    {
        return $this->body;
    }
    public function withBody(Streameable $body)
    {
        return $body;
    }
}
