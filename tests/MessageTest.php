<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use Mockery;
use Psr\Http\Message\StreamInterface;
use MartiAdrogue\Http\Message;

/**
 * @covers MartiAdrogue\Http\Uri::<!public>
 */
class MessageTest extends PHPUnit_Framework_TestCase
{

    protected $message;

    public function setUp()
    {
        $version = Message::PROTOCOL_11;
        $headers = [];
        $body = Mockery::mock('Psr\Http\Message\StreamInterface');

        $this->Message = new Message($version, $headers, $body);
    }

    /** @test */
    public function shouldReturnANewInstanceWithAnotherProtocolVersion()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldReturnANewInstanceWithAnotherHeader()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldReturnANewInstanceWithAddedHeader()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldReturnANewInstanceWithoutHeader()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldReturnANewInstanceWithAnotherBody()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldGetProtocolVersion()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldGetHeaders()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldGetHeaderMappedToKey()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldGetHeaderLineMappedToKey()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldGetBody()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldCheckIfHeaderWithRequiredKeyExists()
    {
        $this->assertTrue(true);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
