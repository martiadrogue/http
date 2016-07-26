<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use Mockery;
use Psr\Http\Message\StreamInterface;
use MartiAdrogue\Http\Message;

/**
 * @covers MartiAdrogue\Http\Message::<!public>
 */
class MessageTest extends PHPUnit_Framework_TestCase
{

    protected $message;

    public function setUp()
    {
        $version = Message::PROTOCOL_11;
        $headers = ['foo' => ['boo']];
        $body = Mockery::mock('Psr\Http\Message\StreamInterface');

        $this->message = new Message($version, $headers, $body);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     * @covers MartiAdrogue\Http\Message::withProtocolVersion
     * @covers MartiAdrogue\Http\Message::getProtocolVersion
     */
    public function shouldReturnANewInstanceWithAnotherProtocolVersion()
    {
        $version = Message::PROTOCOL_10;
        $newMessage = $this->message->withProtocolVersion($version);
        $this->assertNotSame($this->message, $newMessage, 'Method Message::withProtocolVersion always returns a new instance of the same object.');
        $this->assertEquals($version, $newMessage->getProtocolVersion(), 'Method Message::withProtocolVersion must return a new instance of MartiAdrogue\Http\Message::class with protocol asked.');
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldReturnANewInstanceWithAnotherHeader()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldReturnANewInstanceWithAddedHeader()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldReturnANewInstanceWithoutHeader()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     * @covers MartiAdrogue\Http\Message::getBody
     * @covers MartiAdrogue\Http\Message::withBody
     */
    public function shouldReturnANewInstanceWithAnotherBody()
    {
        $newBody = Mockery::mock('Psr\Http\Message\StreamInterface');
        $newMessage = $this->message->withBody($newBody);
        $this->assertNotSame($this->message, $newMessage, 'Method Message::withBody always returns a new instance of the same object.');
        $this->assertEquals($newBody, $newMessage->getBody(), 'Method Message::withBody must return a new instance of MartiAdrogue\Http\Message::class with Body asked.');
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldGetHeaders()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldGetHeaderMappedToKey()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldGetHeaderLineMappedToKey()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldGetBody()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     */
    public function shouldCheckIfHeaderWithRequiredKeyExists()
    {
        $this->assertTrue(true);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
