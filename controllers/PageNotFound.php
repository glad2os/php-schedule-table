<?php

class PageNotFound extends Controller
{
    /**
     * PageNotFound constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->action_index();
    }

    function action_index($get = null)
    {
        new View("error_404.html");
        die;
    }
}