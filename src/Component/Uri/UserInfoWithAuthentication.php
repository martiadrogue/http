<?php

namespace MartiAdrogue\Http\Component\Uri;

/**
 * The userinfo subcomponent may consist of a user name and, optionally,
 * scheme-specific information about how to gain authorization to access the
 * resource. That information must be separated by colon (":").
 *
 * The passing of authentication information in clear text has proven to be a
 * security risk in almost every case where it has been used. So, applications
 * should not render as clear text any data after the first colon (":").
 * The user information is followed by a commercial at-sign ("@") that delimits
 * it from the host.
 *
 * @deprecated UserInfo with authentication has proven to be a security risk in
 * almost every case where it has been used.
 */
class UserInfoWithAuthentication extends UserInfo
{
    public function __construct($user, $password)
    {
        parent::__construct($user.':'.$password);
    }
}
