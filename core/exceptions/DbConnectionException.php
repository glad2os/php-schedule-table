<?php
namespace Exception;

class DbConnectionException extends \RuntimeException
{
    protected $code = 500;
}