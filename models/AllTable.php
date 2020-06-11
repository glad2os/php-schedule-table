<?php


namespace Model;


class AllTable extends \Model\Base
{
    function get8cat($sex)
    {
        return $this->mysqli->get8cat($sex);
    }

    function get9cat($sex)
    {
        return $this->mysqli->get9cat($sex);
    }

    function get10cat($sex)
    {
        return $this->mysqli->get10cat($sex);
    }

    function get11cat($sex)
    {
        return $this->mysqli->get11cat($sex);
    }

    function get12cat($sex)
    {
        return $this->mysqli->get12cat($sex);
    }

    function getClub($sex)
    {
        return $this->mysqli->getClub($sex);
    }
}