<?php


namespace Controller;


use Helper\View;

class control_panel extends Base
{
    function action_index()
    {
        View::viewPage('control_panel.html');
    }
}