<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Router;
use PDO;

class Form extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION)) Router::to("/login");
    }

    public static function index()
    {
        session_start();
        self::view("form-generator", ["eventMaker" => true]);
    }

    public static function addEvent(Request $request)
    {
        session_start();
        $data = $request->getBody();

        $name = $data['event_name'];
        $desc = $data['event_desc'];
        $num = $data['event_max'];
        $event_start = $data['event_start_date'] . ' ' . $data['event_start_time'] . ':00';
        $event_end = $data['event_end_date'] . ' ' . $data['event_end_time'] . ':00';
        $reg_start = $data['reg_start_date'] . ' ' . $data['reg_start_time'] . ':00';
        $reg_end = $data['reg_end_date'] . ' ' . $data['reg_end_time'] . ':00';

        try {
            $conn = (new Database())->connect();
            $sql = $conn->prepare('INSERT INTO events (name, description, max_participant, start_time, end_time, register_start, register_end, user_id) 
            VALUES (:name, :description, :max_participant, :start_time, :end_time, :register_start, :register_end, :user_id);');
            $sql->bindValue(":name", $name);
            $sql->bindValue(":description", $desc);
            $sql->bindValue(":max_participant", $num);
            $sql->bindValue(":start_time", $event_start);
            $sql->bindValue(":end_time", $event_end);
            $sql->bindValue(":register_start", $reg_start);
            $sql->bindValue(":register_end", $reg_end);
            $sql->bindValue(":user_id", $_SESSION['id']);
            $sql->execute();
            Router::to("/member/dashboard");
        } catch (\Exception $e) {
            Router::to("/member/form");
        }
    }

    public function selectEvt()
    {
        $id_event = $_GET['id_event'];
        $conn = (new Database())->connect();
        $event_data = $conn->prepare('SELECT form.regno, login.fullname, login.email, login.address, login.phone FROM form JOIN login ON form.id_pendaftar = login.id AND form.id_event =:id_evt;');
        $event_data->bindValue(":id_evt", $id_event);
        $event_data->execute();
        $event = $event_data->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($event);
    }

    public function registration(Request $request)
    {
        $id = $_SESSION['id'];
        $conn = (new Database())->connect();
        $event_data = $conn->prepare('SELECT * FROM events WHERE user_id=:id');
        $event_data->bindValue(":id", $id);
        $event_data->execute();
        $event = $event_data->fetchAll(PDO::FETCH_ASSOC);

        $data = [
            "event" => $event,
            "reg" => true
        ];
        self::view("form-registration", $data);
    }
}
