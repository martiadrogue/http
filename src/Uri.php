<?php

namespace MartiAdrogue\Http;

use MartiAdrogue\Http\Behaviour\UniformResourceIdentifiable;
use MartiAdrogue\Http\Exception\InvalidUriException;
use MartiAdrogue\Http\Component\Uri\Context;
use MartiAdrogue\Http\Component\Uri\Port;
use MartiAdrogue\Http\Component\Uri\Scheme;
use MartiAdrogue\Http\Component\Uri\UserInfo;
use MartiAdrogue\Http\Component\Uri\UserInfoWithAuthentication;

class Uri implements UniformResourceIdentifiable
{
    const EMPTY_PORT = '';

    private static $schemes = [
        'http' => 80,
        'https' => 443,
    ];

    private static $charUnreserved = 'a-zA-Z0-9_\-\.~';
    private static $charSubDelims = '!\$&\'\(\)\*\+,;=';
    private static $replaceQuery = ['=' => '%3D', '&' => '%26'];

    private $scheme;
    private $host;
    private $userInfo;

    private $components;

    /**
     * Create a new Skeleton Instance.
     */
    public function __construct($uri)
    {
        $parts = parse_url($uri);
        if (false === $parts) {
            throw new InvalidUriException($uri);
        }
        $this->setComponents($parts);
    }

    public function getScheme()
    {
        return (string) $this->components['scheme'];
    }

    public function getAuthority()
    {
        $authority = $this->host;

        if ('' != $this->getUserInfo()) {
            $authority = $this->getUserInfo() . $authority;
        }

        if (self::EMPTY_PORT !== $this->getPort()) {
            $authority .= ':' . $this->getPort();
        }

        return $authority;
    }

    public function getUserInfo()
    {
        return (string) $this->components['userinfo'];
    }

    public function getHost()
    {
        # code...
    }

    public function getPort()
    {
        return (string) $this->components['port'];
    }

    public function getPath()
    {
        # code...
    }

    public function getQuery()
    {
        # code...
    }

    public function getFragment()
    {
        # code...
    }

    public function withScheme($scheme)
    {
        # code...
    }

    public function withUserInfo($user, $password = null)
    {
        # code...
    }

    public function withHost($host)
    {
        # code...
    }

    public function withPort($port)
    {
        # code...
    }

    public function withPath($path)
    {
        # code...
    }

    public function withQuery($query)
    {
        # code...
    }

    public function withFragment($fragment)
    {
        # code...
    }

    public function __toString()
    {
        # code...
    }

    private function setComponents(array $parts)
    {
        $this->initComponents();

        if (isset($parts['scheme'])) {
            $this->filterScheme($parts['scheme']);
        }

        if (isset($parts['user'])) {
            $userInfo = new UserInfo($parts['user']);
            $this->setComponent('userinfo', $userInfo);
        }

        if (isset($parts['pass'])) {
            $usetInfo = $this->components['userinfo'];
            $authentication = $usetInfo->withAuthentication($parts['pass']);
            $this->setComponent('userinfo', $authentication);
        }

        if (isset($parts['host'])) {
            $this->host = $parts['host'];
        }

        if (isset($parts['port'])) {
            $this->filterPort($parts['port']);
        }

        if (isset($parts['path'])) {
            $this->path = $parts['path'];
        }

        if (isset($parts['query'])) {
            $this->query = $this->filterQueryAndFragment($parts['query']);
        }

        if (isset($parts['fragment'])) {
            $this->fragment = $this->filterQueryAndFragment($parts['fragment']);
        }
    }

    private function filterScheme($resourceDetails)
    {
        if (!empty($resourceDetails)) {
            $scheme = new Scheme($resourceDetails);
            $this->setComponent('scheme', $scheme);
        }
    }

    private function filterPort($value)
    {
        $port = (int) $value;

        if ($this->isNonStandardPort($port)) {
            $port = new Port($port);
            $this->setComponent('port', $port);
        }
    }

    private function filterPath($value)
    {
        return;
    }

    private function filterQueryAndFragment($value)
    {
        return;
    }

    private function isNonStandardPort($port)
    {
        if (!$this->getScheme() && $port) {
            return true;
        }

        if (!$this->host || !$port) {
            return false;
        }

        return !isset($this->schemes[$this->getScheme()]) || $port !== $this->schemes[$this->getScheme()];
    }

    private function initComponents()
    {
        $this->host = $this->path =
        $this->query = $this->fragment = '';
    }

    private function setComponent($key, Context $component)
    {
        $this->components[$key] = $component;
    }
}
