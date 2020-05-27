<?php

abstract class Controller
{
    protected $model;

    /**
     * Controller constructor.
     * @param $model
     */
    public function __construct($model = null)
    {
        if (!file_exists(__DIR__ . "/../models/" . $model . ".php")) return;

        include_once __DIR__ . "/../models/" . $model . ".php";
        $this->model = new $model;
    }

    public function method_not_found(){
        new View('Error_405.html');
        die;
    }
}