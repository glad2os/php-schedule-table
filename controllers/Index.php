<?php

namespace Controller;

use Helper\View;

class index extends Base
{
    function action_index()
    {
        View::viewPage('index.html',[
            'title'=>"Главная страница",
            'css' => "index"
        ]);
    }
}