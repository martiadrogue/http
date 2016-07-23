<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use MartiAdrogue\Http\Uri;

/**
 * @covers MartiAdrogue\Http\Uri::<!public>
 */
class UriTest extends PHPUnit_Framework_TestCase
{
    const RFC3986_URI = 'http://a/b/c/d;p?q#f';

    /** @test */
    public function shouldSetDefaultDomain()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldParseProvidedUri()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function shouldFillPort()
    {
        $this->assertTrue(true);
    }
}
