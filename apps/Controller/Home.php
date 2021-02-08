<?php

namespace Apps\Controller;

use Apps\Lib\Controller;

class Home extends Controller
{
    public static function index()
    {
        self::view("homepage");
    }
}
