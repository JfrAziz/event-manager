<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Router;
use PDO;

class Home extends Controller
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE) session_start();
    }

    public function index()
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from events");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        self::view("homepage", ["data" => $data]);
    }

    public function show(Request $request)
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT e.*, l.fullname as fullname from events e, login l where e.id =:event_id AND e.user_id = l.id");
        $sql->bindValue(':event_id', $request->params[0]);
        $sql->execute();
        $event_data = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (empty($event_data)) Router::to("/");

        self::view("homepage.detail", ["data" => $event_data[0]]);
    }
}
