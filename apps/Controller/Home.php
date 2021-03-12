<?php

namespace Apps\Controller;

use Apps\Lib\Controller;

class Home extends Controller
{
    public static function index()
    {
        session_start();
        self::view("homepage");
    }
}
