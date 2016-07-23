<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use MartiAdrogue\Http\Uri;
use MartiAdrogue\Http\UriComponent\Scheme;
use MartiAdrogue\Http\UriComponent\Context;

/**
 * A scheme MUST be in lowercase.
 *
 * @covers MartiAdrogue\Http\UriComponent\Scheme::<!public>
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
     * @covers MartiAdrogue\Http\UriComponent\Scheme::__toString
     */
    public function shouldReturnCurrentScheme($expected, $scheme)
    {
        $this->assertEquals($expected, $scheme->__toString(), 'Scheme with a value ' . $scheme . ' must return the same value.');
    }
}
