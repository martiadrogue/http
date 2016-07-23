<?php

namespace MartiAdrogue\Http;

use PHPUnit_Framework_TestCase;
use MartiAdrogue\Http\CookieBuilder;
use MartiAdrogue\Http\Cookie;

class CookieBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers MartiAdrogue\Http\CookieBuilder::setDefaultDomain
     * @covers MartiAdrogue\Http\CookieBuilder::build
     * @covers MartiAdrogue\Http\Cookie::getHeaderString
     */
    public function shouldSetDefaultDomain()
    {
        $builder = new CookieBuilder();
        $builder->setDefaultDomain('.example.com');

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; domain=.example.com; path=/; secure; HttpOnly',
            $cookie->getHeaderString()
        );
    }

    /** @test */
    public function shouldSetDefaultPath()
    {
        $builder = new CookieBuilder();
        $builder->setDefaultPath('/test');

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; path=/test; secure; HttpOnly',
            $cookie->getHeaderString()
        );
    }

    /** @test */
    public function shouldSetDefaultSecure()
    {
        $builder = new CookieBuilder();
        $builder->setDefaultSecure(true);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; path=/; secure; HttpOnly',
            $cookie->getHeaderString()
        );

        $builder->setDefaultSecure(false);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; path=/; HttpOnly',
            $cookie->getHeaderString()
        );
    }

    /** @test */
    public function shouldSetDefaultHttpOnly()
    {
        $builder = new CookieBuilder();
        $builder->setDefaultHttpOnly(true);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; path=/; secure; HttpOnly',
            $cookie->getHeaderString()
        );

        $builder->setDefaultHttpOnly(false);

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; path=/; secure',
            $cookie->getHeaderString()
        );
    }

    /** @test */
    public function shouldBuild()
    {
        $builder = new CookieBuilder();

        $cookie = $builder->build('name', 'value');
        $this->assertInstanceOf(Cookie::class, $cookie);

        $this->assertEquals(
            'name=value; path=/; secure; HttpOnly',
            $cookie->getHeaderString()
        );
    }
}
