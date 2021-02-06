<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Request;
use Apps\Lib\Response;
use Apps\Lib\Router;
use PDO;

class Auth extends Controller
{

    public function login()
    {
        session_start();
        if (!empty($_SESSION)) Router::to("/dashboard");
        self::view("login");
    }

    public function validate_login(Request $request, Response $response)
    {
        $data = $request->getBody();
        $username = $data['username'];
        $password = $data['password'];

        if($username == null || $password == null) Router::to("/login");

        echo var_dump($data);

        $conn = $this->database;
        $check_sql = $conn->prepare('CALL CheckUser(:uname,:password)');
        $check_sql->bindValue(":uname", $username);
        $check_sql->bindValue(":password", $password);
        $check_sql->execute();
        $result = $check_sql->fetchAll(PDO::FETCH_ASSOC);
        $count = $result[0]['code'];

        if($count != 1) Router::to("/login");

        session_start();
        $_SESSION['uname']      = $username;
        $_SESSION['loginTime'] = date("Y-m-d H:i:s", time());
        Router::to("/dashboard");
    }

    public function logout(){
        session_start();
        session_destroy();
        Router::to("/login");
    }

    public function forgotPassword()
    {
        self::view("forgot-password");
    }

    public function resetPassword(){
        self::view("reset-password");
    }
}
