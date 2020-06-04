<?php


namespace Exception;


class InvalidCredentialsException extends \RuntimeException
{
    protected $code = 400;
}