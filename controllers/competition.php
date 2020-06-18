<?php


namespace Controller;

use Exception\ForbiddenException;
use Helper\View;

class competition extends Base
{

    public function __construct()
    {
        parent::__construct(\Model\Competition::class);
    }

    public function action_index()
    {
        try {
            $this->model->checkUser();

            View::viewPage('competition.html', [
                'выбор участников'
            ]);
        } catch (ForbiddenException $exception) {
            $this->forbidden();
        }
    }

    public function action_start($params)
    {
        try {
            $this->model->checkAdmin();

            View::viewPage('tournament_grid.html',
                [
                    'title' => "Турнирная таблица",
                    'css' => "main_table"
                ]
            );
        } catch (ForbiddenException $exception) {
            $this->forbidden();
        }
    }

}