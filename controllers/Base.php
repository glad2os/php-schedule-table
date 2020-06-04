<?php

namespace Controller;

use Helper\View;

abstract class Base
{
    protected $model;

    /**
     * Controller constructor.
     * @param $model
     */
    public function __construct($model = null)
    {
        if ($model != null) $this->model = new $model;
    }

    public function method_not_found()
    {
        View::viewPage('error_405.html');
    }
}