<?php

namespace Apps\Lib;

class Controller
{
    protected static function view(string $path, $data = [])
    {
        $path = "apps/View/" . $path . ".php";
        extract($data);
        include_once $path;
    }
}
