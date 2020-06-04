<?php

namespace Controller;

use Helper\View;

class PageNotFound extends Base
{
    function action_index($get = null)
    {
        View::viewPage("error_404.html");
    }
}