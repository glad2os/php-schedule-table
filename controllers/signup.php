<?php


namespace Controller;

use Helper\View;

class signup extends Base
{
    function action_index()
    {
        View::viewPage('signup.html',
            ['title' => "Регистрация"]
        );
    }
}