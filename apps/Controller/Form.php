<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Response;
use Apps\Lib\Router;

class Form extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION)) Router::to("/login");
    }

    public function index()
    {
        self::view("form-generator");
    }

    public function addEvent(Request $request, Response $response){
        session_start();
        $data = $request->getBody();

        $name = $data['event_name'];
        $uid = $_SESSION['id'];
        $desc = $data['event_desc'];
        $num = $data['event_participant'];
        $event_start = $data['event_start_date'].' '.$data['event_start_time'].':00';
        $event_end = $data['event_end_date'].' '.$data['event_end_time'].':00';
        $reg_start = $data['reg_start_date'].' '.$data['reg_start_time'].':00';
        $reg_end = $data['reg_end_date'].' '.$data['reg_end_time'].':00';

        try {
            $conn = (new Database())->connect();
            $sql = $conn->prepare('INSERT INTO events (event_name, event_desc, event_participant, event_date_start, event_date_end, register_date_start, register_date_end, uid) 
            VALUES (:event_name, :event_desc, :event_participant, :event_date_start, :event_date_end, :register_date_start, :register_date_end, :usid);');
            $sql->bindValue(":event_name", $name);
            $sql->bindValue(":event_desc", $desc);
            $sql->bindValue(":event_participant", $num);
            $sql->bindValue(":event_date_start", $event_start);
            $sql->bindValue(":event_date_end", $event_end);
            $sql->bindValue(":register_date_start", $reg_start);
            $sql->bindValue(":register_date_end", $reg_end);
            $sql->bindValue(":usid", $uid);
            $sql->execute();
            echo "sukses";
        } catch (\Exception $e) {
            echo "gagal";
        }
    }

    public function registration(Request $request)
    {
        $display_prompts = [
            'id' => 'ID',
            'timestamp' => 'Timestamp',
            'participant_name' => 'Particpant Name',
            'regno' => 'Registration Number',
            'dept' => 'Department',
            'year' => 'Year',
            'college' => 'College Name',
            'github' => 'GitHub Profile link',
            'email' => 'Email Address',
            'phoneno' => 'Contact number',
            'linkedin' => 'LinkedIn Profile URL',
        ];
        $event = "Choose an event";
        $totalPages = 1;
        $get = $request->getGet();
        $page = empty($get['page']) ? 1 : $get['page'];
        $perPage =  empty($get['perPage']) ? 10 : $get['perPage'];
        if (empty($get['search'])) $get['search'] = "";

        $data = [
            "display_prompts" => $display_prompts,
            "event" => $event,
            "total_pages" => $totalPages,
            "page" => $page,
            "per_page" => $perPage
        ];
        self::view("form-registration", $data);
    }
}
