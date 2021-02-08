<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Router;

class Mail extends Controller
{

    public function __construct()
    {
        session_start();
        if (empty($_SESSION)) Router::to("/login");
    }


    public function index()
    {
        self::view("mail-bulk");
    }

    public function list()
    {
        self::view("mail-list");
    }
}
