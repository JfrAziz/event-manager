<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Router;
use PDO;

use PHPMailer\PHPMailer\PHPMailer;

class Mail extends Controller
{

    public function __construct()
    {
        session_start();
        if (empty($_SESSION)) Router::to("/login");
    }


    public function index()
    {
        $conn = (new Database())->connect();
        $result = $conn->prepare('SELECT * FROM login ORDER BY id');
        $result->execute();
        $user_data = $result->fetchAll(PDO::FETCH_ASSOC);

        $events = $conn->prepare('SELECT * FROM events');
        $events->execute();
        $result_event = $events->fetchAll(PDO::FETCH_ASSOC);
        $data = [
            "user_data" => $user_data,
            "events" => $result_event
        ];
        self::view("mail-bulk", $data);
    }

    public function send()
    {
        $email = json_decode($_POST['email_data'], TRUE);
        if (isset($email)) {
            $output = '';
            foreach ($email as $row) {
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = 'alamatEmail';
                $mail->Password = 'PassswordEmail';
                $mail->SMTPSecure = 'ssl';
                $mail->From = 'alamatEmail';
                $mail->FromName = 'Event Manajemen STIS';
                $mail->AddAddress($row["email"], $row["name"]);
                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Subject = $_POST['mail_subject'];
                $mail->Body = $_POST['mail_body'];

                $mail->AltBody = '';

                if (isset($_FILES['files'])) {
                    $file = $_FILES['files'];

                    $file_name = $file["name"];
                    $file_size = $file['size'];
                    $file_tmp = $file["tmp_name"];
                    $file_error = $file['error'];

                    $total_size = 0;
                    $total_file = 0;
                    if ($output != '') {
                        $output = '';
                    }
                    for ($i = 0; $i < count($file_name); $i++) {

                        if ($file_error[$i] == 0) {
                            if (($total_size + $file_size[$i]) < 1048576) {
                                $total_size += $file_size[$i];
                                $mail->AddAttachment($file_tmp[$i], $file_name[$i]);
                                $total_file++;
                            }
                        } elseif ($file_error == 2) {
                            $output .= 'Ukuran file <strong>' . $file_name[$i] . '</strong> melebihi batas maksimal upload di form html.' . '<br>';
                        } else {

                            $output .= 'Kode error upload file <strong>' . $file_name[$i] . '</strong> : ' . $file_error . '<br>';
                        }
                    }

                    if ($total_file == count($file_name)) {
                        $result = $mail->Send();
                        if ($mail->ErrorInfo) {
                            $output .= $mail->ErrorInfo;
                        }
                    } elseif ($total_file < count($file_name) && $total_file > 0) {
                        $result = $mail->Send();
                        if ($mail->ErrorInfo) {
                            $output .= $mail->ErrorInfo;
                        }
                    }
                } else {
                    $result = $mail->Send();
                    if ($mail->ErrorInfo) {
                        $output .= $mail->ErrorInfo;
                    }
                }
            }

            if ($output == '') {
                echo 'ok';
            } else {
                echo $output;
            }
        }
    }

    public function list()
    {
        self::view("mail-list");
    }

    public function search()
    {
        $conn = (new Database())->connect();
        $namaEvent = $_POST['nameEvent'];
        $input = strtolower($_POST["input"]);

        if (isset($_POST['data_checked'])) {
            $data_checked = $_POST['data_checked'];
        } else {
            $data_checked = [];
        }

        if ($namaEvent == "all") {

            $result = $conn->query("SELECT * FROM login WHERE fullname LIKE '%$input%' OR email LIKE '%$input%' ORDER BY id");
            $users = $result->fetchAll(PDO::FETCH_ASSOC);
        } else {

            $user_events = $conn->prepare('SELECT * FROM form WHERE id_event=:id');
            $user_events->bindValue(':id', (int)$namaEvent);
            $user_events->execute();
            $result_event = $user_events->fetchAll(PDO::FETCH_ASSOC);
            $user_data = [];
            foreach ($result_event as $row) {
                $id_pendaftar = $row["id_pendaftar"];
                $result = $conn->query("SELECT * FROM login WHERE id=$id_pendaftar ORDER BY id");
                $user_data[] = $result->fetchAll(PDO::FETCH_ASSOC);
            }
            $users = [];
            foreach ($user_data as $user) {

                if ($input != '') {
                    if (strpos(strtolower($user[0]['fullname']), $input) !== false || strpos(strtolower($user[0]['email']), $input) !== false) {
                        $users[] = [
                            'id' => $user[0]['id'],
                            'fullname' => $user[0]['fullname'],
                            'email' => $user[0]['email']
                        ];
                    }
                } else {
                    $users[] = [
                        'id' => $user[0]['id'],
                        'fullname' => $user[0]['fullname'],
                        'email' => $user[0]['email']
                    ];
                }
            }
        }
        $data = [
            "users" => $users,
            "ischecked" => $data_checked
        ];
        self::view("searchAjax", $data);
    }

    public function changeEvent()
    {
        $conn = (new Database())->connect();
        $namaEvent = $_POST['nameEvent'];
        $input = strtolower($_POST["input"]);
        if (isset($_POST['data_checked'])) {
            $data_checked = $_POST['data_checked'];
        } else {
            $data_checked = [];
        }
        if ($input !== "") {

            if ($namaEvent == "all") {
                $result = $conn->query("SELECT * FROM login WHERE fullname LIKE '%$input%' OR email LIKE '%$input%' ORDER BY id");
                $users = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {

                $user_events = $conn->prepare('SELECT * FROM form WHERE id_event=:id');
                $user_events->bindValue(':id', (int)$namaEvent);
                $user_events->execute();
                $result_event = $user_events->fetchAll(PDO::FETCH_ASSOC);

                $user_data = [];
                foreach ($result_event as $row) {
                    $id_pendaftar = $row["id_pendaftar"];
                    $result = $conn->query("SELECT * FROM login WHERE id=$id_pendaftar ORDER BY id");
                    $user_data[] = $result->fetchAll(PDO::FETCH_ASSOC);
                }
                $users = [];
                foreach ($user_data as $user) {
                    if (strpos(strtolower($user[0]['fullname']), $input) !== false || strpos(strtolower($user[0]['email']), $input) !== false) {
                        $users[] = [
                            'id' => $user[0]['id'],
                            'fullname' => $user[0]['fullname'],
                            'email' => $user[0]['email'],
                        ];
                    }
                }
            }
        } else {

            if ($namaEvent == "all") {
                $result = $conn->prepare('SELECT * FROM login ORDER BY id');
                $result->execute();
                $users = $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $user_events = $conn->prepare('SELECT * FROM form WHERE id_event=:id');
                $user_events->bindValue(':id', (int)$namaEvent);
                $user_events->execute();
                $result_event = $user_events->fetchAll(PDO::FETCH_ASSOC);
                $user_data = [];
                foreach ($result_event as $row) {
                    $result = $conn->prepare('SELECT * FROM login WHERE id=:id_user ORDER BY id');
                    $result->bindValue(":id_user", $row["id_pendaftar"]);
                    $result->execute();
                    $user_data[] = $result->fetchAll(PDO::FETCH_ASSOC);
                }
                $users = [];
                foreach ($user_data as $user) {
                    $users[] = $user[0];
                }
            }
        }

        $data = [
            "users" => $users,
            "ischecked" => $data_checked
        ];
        self::view("searchAjax", $data);
    }
}
