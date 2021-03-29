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
        if (session_status() == PHP_SESSION_NONE) session_start();
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

    public function searchEvent()
    {
        $input = $_POST['input'];
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from events where 
            name LIKE ? OR start_time LIKE ? OR end_time LIKE ? OR register_start LIKE ? OR register_end LIKE ?");
        $sql->bindValue(1, "%$input%");
        $sql->bindValue(2, "%$input%");
        $sql->bindValue(3, "%$input%");
        $sql->bindValue(4, "%$input%");
        $sql->bindValue(5, "%$input%");
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($data);
        self::view("searchEvent", ["data" => $data]);
    }
}
