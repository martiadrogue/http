<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use MartiAdrogue\Http\Uri;
use MartiAdrogue\Http\Component\Uri\Scheme;
use MartiAdrogue\Http\Component\Uri\Context;

/**
 * A scheme MUST be in lowercase.
 *
 * @covers MartiAdrogue\Http\Component\Uri\Scheme::<!public>
 */
class SchemeTest extends PHPUnit_Framework_TestCase
{
    public function additionScheme()
    {
        return [
            ['http', new Scheme('http:/')],
            ['https', new Scheme('https:/')],
        ];
    }

    /**
     * @test
     * @dataProvider additionScheme
     * @covers MartiAdrogue\Http\Component\Uri\Scheme::__toString
     */
    public function shouldReturnCurrentScheme($expected, $scheme)
    {
        $this->assertEquals($expected, $scheme->__toString(), 'Scheme with a value ' . $scheme . ' must return the same value.');
    }
}
