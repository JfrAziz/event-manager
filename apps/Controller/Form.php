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

    public function index()
    {
        self::view("form-generator");
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
