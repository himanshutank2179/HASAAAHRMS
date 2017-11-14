<?php

namespace app\components;

class UserIdentity
{
    const ROLE_SUPER_ADMIN = 'SUPER_ADMIN';
    const ROLE_ADMIN = 2;
    const ROLE_USER = 3;
    const ROLE_HR = 4;

    public function init()
    {

    }

    static public function isUserAuthenticate($userrole)
    {
        if ($userrole == self::ROLE_SUPER_ADMIN) {
            return true;
        } elseif ($userrole == self::ROLE_ADMIN) {
            return true;
        } elseif ($userrole == self::ROLE_USER) {
            return true;
        } elseif ($userrole == self::ROLE_HR) {
            return true;
        } else {
            return false;
        }
    }

}
