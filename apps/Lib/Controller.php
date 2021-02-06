<?php

namespace Apps\Lib;

use PDO;

class Controller
{
    protected PDO $database;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
         $this->database = (new Database())->connect();
    }

    protected static function view(string $path, $data = []) {
        $path = "apps/View/".$path.".php";
        extract($data);
        include_once $path;
    }
}