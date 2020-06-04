<?php

namespace Helper;

class View
{

    /**
     * View constructor.
     */
    public static function viewPage($content_view, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        include __DIR__ . '/../views/template_view.php';
    }
}