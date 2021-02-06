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

        $result = $conn->prepare('SELECT CONCAT("event_",LOWER(REPLACE((SELECT `event_name` FROM `events` order by `date` desc limit 1)," ","_"))) as code');
        $result->execute();
        $row = $result->fetch();
        $eventTable = $row[0];

        $result = $conn->prepare('SELECT COUNT(*) as code FROM events;');
        $result->execute();
        $row = $result->fetch();
        $eventsCount = $row[0];

        $data = [
            "event_table" => $eventTable,
            "events_count" => $eventsCount
        ];
        self::view("dashboard", $data);
    }

    public function profile()
    {
        $conn = (new Database())->connect();
        $sql = $conn->prepare("SELECT * from login where LoginName =:currentUser");
        $sql->bindValue(':currentUser', $_SESSION['uname']);
        $sql->execute();
        $userData = $sql->fetch();
        $image_src = $userData['imgsrc'] == "" ? "/assets/img/avatars/image2.png" : "/assets/img/avatars/users/" . $userData['imgsrc'];

        $data = [
            "data" => $userData,
            "image_src" => $image_src
        ];
        self::view("profile", $data);
    }

    public function update_photo(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['photo_settings'])) {

            $data = $request->getFiles();
            $name = $data['file']['name'];
            $target_dir = "/assets/img/avatars/users/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = ["jpg", "jpeg", "png", "gif"];
            
            if (in_array($imageFileType, $extensions_arr)) {

                $conn = (new Database())->connect();
                $sql = $conn->prepare("UPDATE login SET imgsrc=:imgSRC where LoginName=:currentUser");
                $sql->bindValue(':imgSRC', $name);
                $sql->bindValue(':currentUser', $_SESSION['uname']);
                $sql->execute();

                move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);
            }
        }
        Router::to("/member/profile");
    }

    public function update_user(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['user_settings'])) {

            $email     = $data['email'];
            $firstname = $data['first_name'];
            $lastname  = $data['last_name'];

            $conn = (new Database())->connect();
            $query = $conn->prepare("UPDATE login SET lastname = :lastname, FirstName = :firstname, Email = :email where LoginName =:currentUser");
            $query->bindValue(':lastname',    $lastname);
            $query->bindValue(':firstname',   $firstname);
            $query->bindValue(':email',       $email);
            $query->bindValue(':currentUser', $_SESSION['uname']);
            $query->execute();
        }
        Router::to("/member/profile");
    }

    public function update_contact(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['contact_settings'])) {

            $address = $data['address'];
            $phno    = $data['phno'];

            $conn = (new Database())->connect();
            $query = $conn->prepare("UPDATE login SET Address= :address, Phno= :phno where LoginName =:currentUser");
            $query->bindValue(':address', $address);
            $query->bindValue(':phno', $phno);
            $query->bindValue(':currentUser', $_SESSION['uname']);
            $query->execute();
        }
        Router::to("/member/profile");
    }

    public function update_signature(Request $request)
    {
        $data = $request->getBody();
        if (isset($data['signature_settings'])) {
            
            $signature = $data['signature'];

            $conn = (new Database())->connect();
            $query = $conn->prepare("UPDATE login SET Signature= :signature where LoginName =:currentUser");
            $query->bindValue(':signature', $signature);
            $query->bindValue(':currentUser', $_SESSION['uname']);
            $query->execute();
        }
        Router::to("/member/profile");
    }
}
