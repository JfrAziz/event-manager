<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Router;

class Member extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION)) Router::to("/login");
    }

    public function index()
    {
        $conn = (new Database())->connect();

        // $result = $conn->prepare('SELECT CONCAT("event_",LOWER(REPLACE((SELECT `event_name` FROM `events` order by `event_date_start` desc limit 1)," ","_"))) as code');
        // $result->execute();
        // $row = $result->fetch();
        // $eventTable = $row[0];

        // $result = $conn->prepare('SELECT COUNT(*) as code FROM events;');
        // $result->execute();
        // $row = $result->fetch();
        // $eventsCount = $row[0];

        $data = [
            // "event_table" => $eventTable,
            // "events_count" => $eventsCount
        ];
        self::view("dashboard", $data);
    }

    public function profile()
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from login where username =:username");
        $sql->bindValue(':username', $_SESSION['username']);
        $sql->execute();
        $user_data = $sql->fetch();
        $user_data['imgsrc'] = $user_data['imgsrc'] == null ? "/assets/img/avatars/image2.png" : "/assets/img/avatars/users/" . $user_data['imgsrc'];
        self::view("profile", $user_data);
    }

    public function update_photo(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['photo_settings'])) {

            $data = $request->getFiles();
            $file_name = $data['file']['name'];
            $target_dir = "/assets/img/avatars/users/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = ["jpg", "jpeg", "png", "gif"];

            if (in_array($image_file_type, $extensions_arr)) {

                $conn = (new Database())->connect();
                $sql = $conn->prepare("UPDATE login SET imgsrc=:imgsrc where username=:username");
                $sql->bindValue(':imgsrc', $file_name);
                $sql->bindValue(':username', $_SESSION['username']);
                $sql->execute();

                move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $file_name);
            }
        }
        Router::to("/member/profile");
    }

    public function update_user(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['user_settings'])) {
            $conn = (new Database())->connect();
            $query = $conn->prepare("UPDATE login SET email = :email where username =:username");
            $query->bindValue(':email',      $data['email']);
            $query->bindValue(':username', $_SESSION['username']);
            $query->execute();
        }
        Router::to("/member/profile");
    }

    public function update_contact(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['contact_settings'])) {
            $conn = (new Database())->connect();
            $query = $conn->prepare("UPDATE login SET address= :address, phone= :phone where username =:username");
            $query->bindValue(':address', $data['address']);
            $query->bindValue(':phone', $data['phone']);
            $query->bindValue(':username', $_SESSION['username']);
            $query->execute();
        }
        Router::to("/member/profile");
    }

    public function update_signature(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['signature_settings'])) {
            $conn = (new Database())->connect();
            $query = $conn->prepare("UPDATE login SET signature= :signature where username =:username");
            $query->bindValue(':signature', $data['signature']);
            $query->bindValue(':username', $_SESSION['username']);
            $query->execute();
        }
        Router::to("/member/profile");
    }
}
