<?php

namespace Apps\Controller;

use Apps\Lib\Controller;

class Certificate extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function index(){
        $data = [
            "event_type" => 1
        ];
        self::view("certificate-admin", $data);
    }
}
