<?php


namespace Model;


use Exception\ForbiddenException;
use Helper\RequestedPermissions;

class Competition extends Base
{
    function checkUser()
    {
        RequestedPermissions::Permission(PERMISSION_USER);

        if (!$this->mysqli->authByToken($_COOKIE['id'], $_COOKIE['token'])) throw new ForbiddenException();

        return true;
    }

    function checkAdmin()
    {
        RequestedPermissions::Permission(PERMISSION_ADMIN);

        if (!$this->mysqli->authByToken($_COOKIE['id'], $_COOKIE['token'])) throw new ForbiddenException();

        return true;
    }
}