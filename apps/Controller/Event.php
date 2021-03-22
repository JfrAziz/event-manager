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
        if(session_status() == PHP_SESSION_NONE) session_start();
        if (empty($_SESSION)) Router::to("/login");
    }

    public function index()
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from events");
        $sql->bindValue(':user_id', $_SESSION['id']);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        self::view("all-event", ["data" => $data]);
    }

    public function show(Request $request)
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT e.*, l.fullname as fullname from events e, login l where e.id =:event_id AND e.user_id = l.id");
        $sql->bindValue(':event_id', $request->params[0]);
        $sql->execute();
        $event_data = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (empty($event_data)) Router::to("/member/event");

        $sql = $conn->prepare("SELECT * from form where id_pendaftar =:user_id AND id_event = :event_id");
        $sql->bindValue(':user_id', $_SESSION['id']);
        $sql->bindValue(':event_id', $request->params[0]);
        $sql->execute();
        $registered_data = $sql->fetchAll(PDO::FETCH_ASSOC);

        $registered = !empty($registered_data);

        self::view("event-details", ["data" => $event_data[0], "registered" => $registered]);
    }

    public function register(Request $request)
    {
        $data = $request->getBody();
        try {
            $conn = (new Database())->connect();
            $sql = $conn->prepare("INSERT INTO form (id_event, id_pendaftar, regno) VALUES (:id_event, :id_pendaftar, :regno)");
            $sql->bindValue(':id_event', $data['event_id']);
            $sql->bindValue(':id_pendaftar', $_SESSION['id']);
            $sql->bindValue(':regno', $_SESSION['id'] . date("Ymd") . $data['event_id']);
            $sql->execute();
        } catch (\Exception $th) {
            return Router::to("/member/event/{$data['event_id']}");
        }

        return Router::to("/member/event/{$data['event_id']}");
    }

    public function certificate()
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from events e, form f where f.id_pendaftar =:user_id AND f.id_event = e.id");
        $sql->bindValue(':user_id', $_SESSION['id']);
        $sql->execute();
        $event_data = $sql->fetchAll(PDO::FETCH_ASSOC);

        self::view("my-event", ["data" => $event_data]);
    }

    public function showCertificate(Request $request)
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT e.*, l.fullname as fullname from events e, login l where e.id =:event_id AND e.user_id = l.id");
        $sql->bindValue(':event_id', $request->params[0]);
        $sql->execute();
        $event_data = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (empty($event_data)) Router::to("/member/event");

        self::view("my-event-details", ["data" => $event_data[0]]);
    }
}
