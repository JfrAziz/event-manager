<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Router;

class Home extends Controller
{
    public function index()
    {
        self::view("homepage");
    }
}
