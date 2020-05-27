<?php

class Index extends Controller
{
    public function __construct()
    {
        parent::__construct("Model" . __CLASS__);
    }

    function action_index($get = null)
    {
        $this->model->get_data();
        new View('index.html');
    }
}