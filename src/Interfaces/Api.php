<?php namespace Palmabit\GoogleDirections\Interfaces;

interface Api
{
    public static function getOptionalFields();
    public function setTimeout($timeout = null);
    public function call();
}
