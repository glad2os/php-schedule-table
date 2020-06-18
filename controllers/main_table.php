<?php


namespace Controller;


use Helper\View;

class main_table extends Base
{

    /**
     * main_table constructor.
     */
    public function __construct()
    {
        parent::__construct(\Model\MainTable::class);
    }

    function action_index()
    {
        View::viewPage('main_table.html',[
            'title'=>"Общая таблица",
            'css' => 'main_table'
        ]);
    }

}