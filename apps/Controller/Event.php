<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Router;
use PDO;

class Event extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION)) Router::to("/login");
    }

    public static function index()
    {
        session_start();
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from events where user_id =:user_id");
        $sql->bindValue(':user_id', $_SESSION['id']);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        self::view("all-event", ["data" => $data]);
    }

    public static function register(Request $request){

    }
}
