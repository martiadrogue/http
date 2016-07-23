<?php

namespace MartiAdrogue\Http;

class CookieBuilder
{
    private $defaultDomain;
    private $defaultPath = '/';
    private $defaultSecure = true;
    private $defaultHttpOnly = true;

    public function setDefaultDomain($domain)
    {
        $this->defaultDomain = $domain;
    }

    public function setDefaultPath($path)
    {
        $this->defaultPath = $path;
    }

    public function setDefaultSecure($secure)
    {
        $this->defaultSecure = $secure;
    }

    public function setDefaultHttpOnly($httpOnly)
    {
        $this->defaultHttpOnly = $httpOnly;
    }

    public function build($name, $value)
    {
        $cookie = new Cookie($name, $value);
        $cookie->setPath($this->defaultPath);
        $cookie->setSecure($this->defaultSecure);
        $cookie->setHttpOnly($this->defaultHttpOnly);

        if ($this->defaultDomain !== null) {
            $cookie->setDomain($this->defaultDomain);
        }

        return $cookie;
    }
}
