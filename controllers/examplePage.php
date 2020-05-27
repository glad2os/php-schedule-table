<?php

class examplePage extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function action_index($get = null)
    {
        new View("ExamplePage.html");
    }

    function action_action($get = null)
    {
        // Нужна проверка на данные + нужно заранее предполагать что будет передано
        if (!empty($get)) {
            new View('ExampleGetParam.html', [
                //http://localhost/test/test2/id/5
                $get[0] => $get[1],
            ]);
        }
    }
}