<?php


namespace Apps\Lib;


class Request
{
    public $params;
    public string $reqMethod;
    public string $contentType;

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    public function getBody()
    {
        if ($this->reqMethod !== 'POST') return '';
        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }

    public function getGet()
    {
        if ($this->reqMethod !== 'GET') return '';
        $body = [];
        foreach ($_GET as $key => $value) {
            $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }

    public function getFiles()
    {
        if ($this->reqMethod !== 'POST') return '';
        $body = [];
        foreach ($_FILES as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key);
        }
        return $body;
    }

    public function getJSON(): array
    {
        if ($this->reqMethod !== 'POST') return [];
        if (strcasecmp($this->contentType, 'application/json') !== 0) {
            return [];
        }
        $content = trim(file_get_contents("php://input"));
        return json_decode($content);
    }
}