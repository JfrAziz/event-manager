<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Router;

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
        self::view("form-generator");
    }

    public static function addEvent(Request $request){
        session_start();
        $data = $request->getBody();

        $name = $data['event_name'];
        $desc = $data['event_desc'];
        $num = $data['event_max'];
        $event_start = $data['event_start_date'].' '.$data['event_start_time'].':00';
        $event_end = $data['event_end_date'].' '.$data['event_end_time'].':00';
        $reg_start = $data['reg_start_date'].' '.$data['reg_start_time'].':00';
        $reg_end = $data['reg_end_date'].' '.$data['reg_end_time'].':00';

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
            Router::to("/dashboard");
        } catch (\Exception $e) {
            Router::to("/member/form");
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
