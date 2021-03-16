<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use PDO;

class Home extends Controller
{
    public static function index()
    {
        session_start();
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from events");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        self::view("homepage", ["data" => $data]);
    }
}
