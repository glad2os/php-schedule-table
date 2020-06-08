<?php

namespace Controller;

use Exception\ForbiddenException;
use Exception\IllegalArgumentException;
use Exception\InvalidCredentialsException;
use Helper\View;

class auth extends Base
{
    public function __construct()
    {
        parent::__construct(\Model\Auth::class);
    }

    function action_index($get = null)
    {
        View::viewPage("ExamplePage.html");
    }

    function action_register()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents("php://input"), true);

        try {
            if (isset($_COOKIE['id']) && isset($_COOKIE['token']) && $this->model->authByToken())
                throw new ForbiddenException('You are already logged in');

            if ($this->model->checkUserExists($request['login']))
                throw new IllegalArgumentException("User already exists");

//            if (!isset($request['login']) || !preg_match('/[-_#!0-9a-zA-Z]{3,}/', $request['login']))
//                throw new IllegalArgumentException('Login is not set or does not match RegEx /[-_#!0-9a-zA-Z]{3,}/');

//            if (!isset($request['password']) || !preg_match('/.{8,}/', $request['password']))
//                throw new IllegalArgumentException('Password is not set or does not match RegEx /.{8,}/');

            $this->model->registerUser($request);
        } catch (\RuntimeException $exception) {
            http_response_code(500);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        }
    }

    function action_auth()
    {
        header('Content-Type: application/json');
        $request = json_decode(file_get_contents("php://input"), true);
        try {
            if (isset($_COOKIE['id']) && isset($_COOKIE['token']) && $this->model->authByToken())
                throw new ForbiddenException('You are already logged in');
            else if (isset($request['login']) && isset($request['password'])) {
                if (!$this->model->authentication($request['login'], $request['password']))
                    throw new InvalidCredentialsException("User or password is invalid");

                $this->model->authorization($request['login']);
            } else throw new IllegalArgumentException();

            http_response_code(200);
        } catch (\RuntimeException $exception) {
            http_response_code(500);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        }
    }

    function action_get_info()
    {
        header('Content-Type: application/json');
        try {
            if (!(isset($_COOKIE['id']) && isset($_COOKIE['token']) && $this->model->authByToken()))
                throw new ForbiddenException('You are not logged in');

            print json_encode($this->model->getUserInfo());

            http_response_code(200);
        } catch (\RuntimeException $exception) {
            http_response_code(500);
            print json_encode([
                'issueType' => substr(strrchr(get_class($exception), "\\"), 1),
                'issueMessage' => $exception->getMessage(),
            ]);
        }
    }
}