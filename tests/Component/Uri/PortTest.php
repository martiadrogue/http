<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use MartiAdrogue\Http\Uri;
use MartiAdrogue\Http\Exception\InvalidPortException;
use MartiAdrogue\Http\Component\Uri\Port;

/**
 * A port MUST have a valid value. If it isn't the case. SHOULD launch and
 * exception because the responsability of use a port or not belong to the class
 * wich it's porpose is handle URIs and decide if is going to use a port or
 * not depending on host and sheme standards.
 *
 * @covers MartiAdrogue\Http\Component\Uri\Port::<!public>
 * @uses MartiAdrogue\Http\Exception\InvalidPortException
 */
class PortTest extends PHPUnit_Framework_TestCase
{
    protected $port;

    protected function setUp()
    {
        $this->port = new Port(81);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Component\Uri\Port::__construct
     */
    public function shouldLaunchAnExceptionWhenANoneNumericPortIsCreated()
    {
        $this->setExpectedException(InvalidPortException::class, 'Invalid port: 0. Must be between 1 and 65535.');
        $builder = new Port('qwert');
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Component\Uri\Port::__construct
     */
    public function shouldLaunchAnExceptionWhenAPortLowerThanStandardRangIsCreated()
    {
        $this->setExpectedException(InvalidPortException::class, 'Invalid port: -64. Must be between 1 and 65535.');
        $builder = new Port(-64);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Component\Uri\Port::__construct
     */
    public function shouldLaunchAnExceptionWhenAPortHiggerThanStandardRangIsCreated()
    {
        $this->setExpectedException(InvalidPortException::class, 'Invalid port: 65536. Must be between 1 and 65535.');
        $builder = new Port(65536);
    }

    /**
     * @test
     * @covers MartiAdrogue\Http\Component\Uri\Port::__construct
     * @covers MartiAdrogue\Http\Component\Uri\Port::__toString
     */
    public function shouldReturnCurrentPort()
    {
        $input = 81;
        $this->assertEquals('81', $this->port->__toString(), 'If you init a Port with a value ' . $input . ' it must return the same value.');
    }
}
