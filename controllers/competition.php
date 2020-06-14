<?php


namespace Controller;

use Helper\View;

class competition extends Base
{

    public function __construct()
    {
        parent::__construct(\Model\Competition::class);
    }

    public function action_index()
    {
        View::viewPage('competition.html');
    }

    public function action_start($params)
    {

        View::viewPage('tournament_grid.html',
            [
                'title' => "Турнирная таблица"
            ]
        );
    }

}