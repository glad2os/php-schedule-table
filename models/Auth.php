<?php

namespace Model;

class Auth extends Base
{
    function registerUser($request)
    {
        $this->mysqli->registerUser($request['login'], $request['password']);
    }

    function authByToken()
    {
        return $this->mysqli->authByToken($_COOKIE['id'], $_COOKIE['token']);
    }

    function checkUserExists($login)
    {
        return $this->mysqli->checkUserExists($login);
    }

    function authentication($login, $password)
    {
        return $this->mysqli->authentication($login, $password);
    }

    function authorization($login)
    {
        $userId = $this->mysqli->getUserId($login);

        setcookie('id', $userId, time() + 86400, '/');
        setcookie('login', $login, time() + 86400, '/');
        setcookie('token', $this->mysqli->authorization($userId), time() + 86400, '/');
    }

    function getUserInfo()
    {
        return $this->mysqli->getUserInfo($_COOKIE['id']);
    }

    function logout()
    {
        $this->mysqli->invalidateToken($_COOKIE['id'], $_COOKIE['token']);
        unset($_COOKIE['id']);
        unset($_COOKIE['login']);
        unset($_COOKIE['token']);
        setcookie('id', null, -1, '/');
        setcookie('login', null, -1, '/');
        setcookie('token', null, -1, '/');
    }
}