<?php


namespace Helper;

use Database\sql;
use Exception\ForbiddenException;

class RequestedPermissions
{
    /**
     * @param $requestedPermission
     * Вернет ForbiddenException в случае, если прав нет.
     */
    public static function Permission($requestedPermission)
    {
        $sql = new sql();
        if ($sql->getUserPermissions($_COOKIE['id']) > $requestedPermission) throw new ForbiddenException();
    }
}