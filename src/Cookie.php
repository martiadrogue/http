<?php

namespace MartiAdrogue\Http;

/**
 *
 */
class Cookie
{
    private $name;
    private $value;
    private $domain;
    private $path;
    private $maxAge;
    private $secure;
    private $httpOnly;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Returns the cookie name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the cookie value.
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Sets the cookie max age in seconds.
     *
     * @param int $seconds
     */
    public function setMaxAge($seconds)
    {
        $this->maxAge = $seconds;
    }

    /**
     * Sets the cookie domain.
     *
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Sets the cookie path.
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    /**
     * Sets the cookie secure flag.
     *
     * @param bool $secure
     */
    public function setSecure($secure)
    {
        $this->secure = $secure;
    }
    /**
     * Sets the cookie httpOnly flag.
     *
     * @param bool $httpOnly
     */
    public function setHttpOnly($httpOnly)
    {
        $this->httpOnly = $httpOnly;
    }

    /**
     * Returns the cookie HTTP header string.
     *
     * @return string
     */
    public function getHeaderString()
    {
        $parts = [
            $this->name.'='.rawurlencode($this->value),
            $this->getMaxAgeString(),
            $this->getExpiresString(),
            $this->getDomainString(),
            $this->getPathString(),
            $this->getSecureString(),
            $this->getHttpOnlyString(),
        ];
        $filteredParts = array_filter($parts);

        return implode('; ', $filteredParts);
    }

    private function getMaxAgeString()
    {
        if ($this->maxAge !== null) {
            return 'Max-Age='.$this->maxAge;
        }
    }
    private function getExpiresString()
    {
        if ($this->maxAge !== null) {
            return 'expires='.gmdate(
                'D, d-M-Y H:i:s',
                time() + $this->maxAge
            ).' GMT';
        }
    }
    private function getDomainString()
    {
        if ($this->domain) {
            return "domain=$this->domain";
        }
    }
    private function getPathString()
    {
        if ($this->path) {
            return "path=$this->path";
        }
    }
    private function getSecureString()
    {
        if ($this->secure) {
            return 'secure';
        }
    }
    private function getHttpOnlyString()
    {
        if ($this->httpOnly) {
            return 'HttpOnly';
        }
    }
}
