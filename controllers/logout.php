<?php


namespace Controller;


use Exception\ForbiddenException;
use Helper\View;
use http\Header;

class logout extends Base
{
    public function __construct()
    {
        parent::__construct(\Model\Auth::class);
    }

    function action_index()
    {
        if (!(isset($_COOKIE['id']) && isset($_COOKIE['token']) && $this->model->authByToken())) {
            header("Location: /auth");
        } else {
            $this->model->logout();
            http_response_code(200);

            header("Location: /");
        }
    }
}