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
        $result = $conn->prepare('SELECT * FROM users ORDER BY user_id');
        $result->execute();
        $dataUsers = $result->fetchAll(PDO::FETCH_ASSOC);
        $data = [
            "dataUsers" => $dataUsers
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
                $mail->Username = 'aldi1hamidi9@gmail.com';
                $mail->Password = 'Stisks0101';
                $mail->SMTPSecure = 'ssl';
                $mail->From = 'aldihamidi9@gamil.com';
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
                            if (($total_size + $file_size[$i]) < 1000000) {
                                $total_size += $file_size[$i];
                                $mail->AddAttachment($file_tmp[$i], $file_name[$i]);
                                $total_file++;
                            } else {
                                $output .= 'File "' . $file_name[$i] . '" tidak terkirim karena batas maksimal mengirim file 25MB.' . '<br>';
                            }
                        } elseif ($file_error == 1 || $file_error == 2) {

                            $output .= 'Ukuran file "' . $file_name[$i] . '" melebihi batas maksimal 25MB.' . '<br>';
                        } else {

                            $output .= 'Kode error upload file "' . $file_name[$i] . '" : ' . $file_error . '<br>';
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
}
