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
        $id_user = $_SESSION['id'];
        $conn = (new Database())->connect();
        $events = $conn->prepare('SELECT id, name FROM events WHERE user_id=:id');
        $events->bindValue(":id", $id_user);
        $events->execute();
        $result_event = $events->fetchAll(PDO::FETCH_ASSOC);
        $data = [
            "events" => $result_event,
            "bulkMailer" => true
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
                $mail->Username = '3sisteminformasi160@gmail.com';
                $mail->Password = 'Kelas_3SI1_60';
                $mail->SMTPSecure = 'ssl';
                $mail->From = '3sisteminformasi160@gmail.com';
                $mail->FromName = 'Event Manajemen STIS';
                $mail->AddAddress($row["email"], $row["name"]);
                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->Subject = $_POST['mail_subject'];
                $mail->Body = $_POST['mail_body'];

                $mail->AltBody = '';
                if ($output != '') {
                    $output = '';
                }

                if (isset($_FILES['files'])) {
                    $file = $_FILES['files'];

                    $file_name = $file["name"];
                    $file_size = $file['size'];
                    $file_tmp = $file["tmp_name"];
                    $file_error = $file['error'];

                    $total_size = 0;
                    $total_file = 0;
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

    public function changeEvent()
    {
        $namaEvent = $_GET['nameEvent'];
        if (isset($_GET['data_checked'])) {
            $data_checked = $_GET['data_checked'];
        } else {
            $data_checked = [];
        }
        $conn = (new Database())->connect();
        $result = $conn->prepare('SELECT login.fullname, login.email FROM form JOIN login ON form.id_pendaftar = login.id AND form.id_event =:id;');
        $result->bindValue(":id", (int)$namaEvent);
        $result->execute();
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $result[count($result) + '1'] = $data_checked;
        echo json_encode($result);
    }
}
