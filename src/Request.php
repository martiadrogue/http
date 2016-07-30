<?php

namespace MartiAdrogue\Http;

use MartiAdrogue\Http\Exception\MissingRequestMetaVariableException;
use MartiAdrogue\Http\Behaviour\Requestable;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

class Request extends Message implements Requestable
{
    private $version;
    private $getParameters;
    private $postParameters;
    private $server;
    private $files;
    private $cookies;
    private $uri;

    public function __construct(
        $version,
        array $get,
        array $post,
        array $cookies,
        array $files,
        array $server
    ) {
        $this->version = $version;
        $this->getParameters = $get;
        $this->postParameters = $post;
        $this->cookies = $cookies;
        $this->files = $files;
        $this->server = $server;
    }

    public function getRequestTarget()
    {
        return;
    }

    public function withRequestTarget($requestTarget)
    {
        return $requestTarget;
    }

    public function withMethod($method)
    {
        return $method;
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        return [$uri, $preserveHost];
    }

    /**
     * Returns a parameter value or a default value if none is set.
     *
     * @param string $key
     * @param string $defaultValue (optional)
     *
     * @return string
     */
    public function getParameter($key, $defaultValue)
    {
        if (array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }

        if (array_key_exists($key, $this->getParameters)) {
            return $this->getParameters[$key];
        }

        return $defaultValue;
    }

    /**
     * Returns a query parameter value or a default value if none is set.
     *
     * @param string $key
     * @param string $defaultValue (optional)
     *
     * @return string
     */
    public function getQueryParameter($key, $defaultValue)
    {
        if (array_key_exists($key, $this->getParameters)) {
            return $this->getParameters[$key];
        }

        return $defaultValue;
    }

    /**
     * Returns a body parameter value or a default value if none is set.
     *
     * @param string $key
     * @param string $defaultValue (optional)
     *
     * @return string
     */
    public function getBodyParameter($key, $defaultValue)
    {
        if (array_key_exists($key, $this->postParameters)) {
            return $this->postParameters[$key];
        }

        return $defaultValue;
    }

    /**
     * Returns a file value or a default value if none is set.
     *
     * @param string $key
     * @param string $defaultValue (optional)
     *
     * @return string
     */
    public function getFile($key, $defaultValue)
    {
        if (array_key_exists($key, $this->files)) {
            return $this->files[$key];
        }

        return $defaultValue;
    }

    /**
     * Returns a cookie value or a default value if none is set.
     *
     * @param string $key
     * @param string $defaultValue (optional)
     *
     * @return string
     */
    public function getCookie($key, $defaultValue)
    {
        if (array_key_exists($key, $this->cookies)) {
            return $this->cookies[$key];
        }

        return $defaultValue;
    }

    /**
     * Returns all parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return array_merge($this->getParameters, $this->postParameters);
    }

    /**
     * Returns all query parameters.
     *
     * @return array
     */
    public function getQueryParameters()
    {
        return $this->getParameters;
    }

    /**
     * Returns all body parameters.
     *
     * @return array
     */
    public function getBodyParameters()
    {
        return $this->postParameters;
    }

    /**
     * Returns a Cookie Iterator.
     *
     * @return array
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * Returns a File Iterator.
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * The URI which was given in order to access this page.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getUri()
    {
        return $this->getServerVariable('REQUEST_URI');
    }

    /**
     * Return just the path.
     *
     * @return string
     */
    public function getPath()
    {
        return strtok($this->getServerVariable('REQUEST_URI'), '?');
    }

    /**
     * Which request method was used to access the page;
     * i.e. 'GET', 'HEAD', 'POST', 'PUT'.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getMethod()
    {
        return $this->getServerVariable('REQUEST_METHOD');
    }

    /**
     * Contents of the Accept: header from the current request, if there is one.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getHttpAccept()
    {
        return $this->getServerVariable('HTTP_ACCEPT');
    }

    /**
     * The address of the page (if any) which referred the user agent to the
     * current page.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getReferer()
    {
        return $this->getServerVariable('HTTP_REFERER');
    }

    /**
     * Content of the User-Agent header from the request, if there is one.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getUserAgent()
    {
        return $this->getServerVariable('HTTP_USER_AGENT');
    }

    /**
     * The IP address from which the user is viewing the current page.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getIpAddress()
    {
        return $this->getServerVariable('REMOTE_ADDR');
    }

    /**
     * Checks to see whether the current request is using HTTPS.
     *
     * @return bool
     */
    public function isSecure()
    {
        return array_key_exists('HTTPS', $this->server)
            && $this->server['HTTPS'] !== 'off'
        ;
    }

    /**
     * The query string, if any, via which the page was accessed.
     *
     * @return string
     *
     * @throws MissingRequestMetaVariableException
     */
    public function getQueryString()
    {
        return $this->getServerVariable('QUERY_STRING');
    }

    private function getServerVariable($key)
    {
        if (!array_key_exists($key, $this->server)) {
            throw new MissingRequestMetaVariableException($key);
        }

        return $this->server[$key];
    }
}
