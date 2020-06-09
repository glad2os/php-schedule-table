<?php


namespace Model;

use Helper\RequestedPermissions;
use Exception\ForbiddenException;

class ControlPanel extends Base
{
    function getAllMembers($page)
    {
        return $this->mysqli->getAllMembers($page);
    }

    function getCountOfMembers()
    {
        return $this->mysqli->getCountOfMembers();
    }

    function checkuser()
    {
        //TODO: проверить, что выдаст если нет $_COOKIE['id']
        RequestedPermissions::Permission(PERMISSION_USER);

        if (!$this->mysqli->authByToken($_COOKIE['id'], $_COOKIE['token'])) throw new ForbiddenException();

        return true;
    }

    function addUser($request)
    {
        $this->mysqli->addMember(
            $request['name'],
            $request['surname'],
            $request['date_of_birth'],
            $request['club'],
            $request['place_of_living'],
            $request['weight'],
            $request['sex']
        );
    }
}