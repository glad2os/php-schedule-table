<?php

namespace Controller;

use Helper\View;

class index extends Base
{
    public function __construct()
    {
        parent::__construct(\Model\Index::class);
    }

    function action_index($get = null)
    {
        View::viewPage('index.html');
    }
}