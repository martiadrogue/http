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
     * @covers MartiAdrogue\Http\Message::withHeader
     * @covers MartiAdrogue\Http\Message::getHeaders
     * @covers MartiAdrogue\Http\Message::getHeader
     */
    public function shouldReturnANewInstanceWithNewHeader()
    {
        $name = 'fizz';
        $value = ['buzz'];
        $newMessage = $this->message->withHeader($name, $value);
        $this->assertNotSame($this->message, $newMessage, 'Method Message::withHeader always returns a new instance of the same object.');
        $this->assertArrayHasKey($name, $newMessage->getHeaders(), 'Method Message::withHeader must return a new instance of MartiAdrogue\Http\Message::class with new key added.');
        $this->assertEquals($value, $newMessage->getHeader($name), 'Method Message::withHeader must return a new instance of MartiAdrogue\Http\Message::class with correct value mapped to new key.');
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     * @covers MartiAdrogue\Http\Message::withAddedHeader
     * @covers MartiAdrogue\Http\Message::getHeaders
     * @covers MartiAdrogue\Http\Message::getHeader
     */
    public function shouldReturnANewInstanceWithMergedHeader()
    {
        $name = 'foo';
        $valueToAdd = ['woof'];
        $newMessage = $this->message->withAddedHeader($name, $valueToAdd);
        $this->assertNotSame($this->message, $newMessage, 'Method Message::withAddedHeader always returns a new instance of the same object.');
        $this->assertEquals(['boo','woof'], $newMessage->getHeader($name), 'Method Message::withAddedHeader must return a new instance of MartiAdrogue\Http\Message::class with header required merged.');
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     * @covers MartiAdrogue\Http\Message::withoutHeader
     * @covers MartiAdrogue\Http\Message::getHeaders
     */
    public function shouldReturnANewInstanceWithoutHeader()
    {
        $name = 'foo';
        $newMessage = $this->message->withoutHeader($name);
        $this->assertNotSame($this->message, $newMessage, 'Method Message::withoutHeader always returns a new instance of the same object.');
        $this->assertEquals([], $newMessage->getHeaders(), 'Method Message::withoutHeader must return a new instance of MartiAdrogue\Http\Message::class with header required merged.');
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
     * @covers MartiAdrogue\Http\Message::getHeaderLine
     * @covers MartiAdrogue\Http\Message::getHeader
     */
    public function shouldGetHeaderLineMappedToKey()
    {
        $header = $this->message->getHeaderLine('foo');
        $this->assertEquals('boo', $header, 'Method Message::getHeaderLine must return header asked in string format.');
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Message::__construct
     * @covers MartiAdrogue\Http\Message::hasHeader
     */
    public function shouldCheckIfRequiredHeadersKeyExists()
    {
        $result = $this->message->hasHeader('lorem_ipsum');
        $this->assertFalse($result, 'Method Message::getHeaderLine must return false if key doesn\'t exit.');
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
