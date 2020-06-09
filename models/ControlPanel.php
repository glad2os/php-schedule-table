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

    function changeUser($request)
    {
        RequestedPermissions::Permission(PERMISSION_ADMIN);

        if (!$this->mysqli->authByToken($_COOKIE['id'], $_COOKIE['token'])) throw new ForbiddenException();

        $this->mysqli->changeUser(
            $request['id'],
            $request['name'],
            $request['surname'],
            $request['date_of_birth'],
            $request['club'],
            $request['place_of_living'],
            $request['weight'],
            $request['sex']
        );
    }

    function deleteMember($id)
    {
        RequestedPermissions::Permission(PERMISSION_ADMIN);

        if (!$this->mysqli->authByToken($_COOKIE['id'], $_COOKIE['token'])) throw new ForbiddenException();

        $this->mysqli->deleteMember($id);
    }
}