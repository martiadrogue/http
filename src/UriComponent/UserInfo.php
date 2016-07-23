<?php

namespace MartiAdrogue\Http\UriComponent;

/**
 * The userinfo subcomponent may consist of a user name.
 *
 * The user information is followed by a commercial at-sign ("@") that delimits
 * it from the host.
 */
class UserInfo extends Context
{
    public function __construct($user)
    {
        parent::__construct($user);
    }

    protected function filter($value)
    {
        return $value;
    }

    public function withAuthentication($password)
    {
        return new UserInfoWithAuthentication($this->value, $password);
    }

    public function __toString()
    {
        return $this->value.'@';
    }
}
