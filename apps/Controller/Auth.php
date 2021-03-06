<?php

namespace Apps\Controller;

use Apps\Lib\Controller;
use Apps\Lib\Database;
use Apps\Lib\Request;
use Apps\Lib\Response;
use Apps\Lib\Router;
use PDO;

class Auth extends Controller
{

    public static function register()
    {
        session_start();
        if (!empty($_SESSION)) Router::to("/member/dashboard");
        self::view("register");
    }

    public static function validateRegister(Request $request, Response $response)
    {
        $data = $request->getBody();
        $email = $data['email'];
        $username = $data['username'];
        $fullname = $data['fullname'];
        $password = $data['password'];
        $password_conf = $data['password_conf'];

        if ($username == null) Router::to("/register");
        if ($fullname == null) Router::to("/register");
        if ($email == null) Router::to("/register");
        if ($password == null) Router::to("/register");
        if ($password_conf == null || $password_conf != $password) Router::to("/register");

        try {
            $conn = (new Database())->connect();
            $sql = $conn->prepare('INSERT INTO login (username, password_hash, fullname, email) VALUES (:username, SHA(:password), :fullname, :email);');
            $sql->bindValue(":email", $email);
            $sql->bindValue(":username", $username);
            $sql->bindValue(":password", $password);
            $sql->bindValue(":fullname", $fullname);
            $sql->execute();
            Router::to("/login");
        } catch (\Exception $e) {
            Router::to("/register");
        }
    }

    /**
     * login
     * 
     * Open view for login
     *
     * @return void
     */
    public static function login()
    {
        session_start();
        if (!empty($_SESSION)) Router::to("/member/dashboard");
        self::view("login");
    }

    /**
     * validateLogin
     *
     * validate user login
     * 
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    public static function validateLogin(Request $request, Response $response)
    {
        $data = $request->getBody();
        $username = $data['username'];
        $password = $data['password'];

        if ($username == null || $password == null) Router::to("/login");

        $conn = (new Database())->connect();
        $sql = $conn->prepare('SELECT COUNT(*) as result FROM login WHERE username=:username && password_hash=SHA(:password);');
        $sql->bindValue(":username", $username);
        $sql->bindValue(":password", $password);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $count = $result[0]['result'];

        if ($count != 1) return Router::to("/login");

        $user_data = $conn->prepare('SELECT * FROM login WHERE username=:username;');
        $user_data->bindValue(":username", $username);
        $user_data->execute();
        $result = $user_data->fetchAll(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION = $result[0];
        $_SESSION['login_time'] = date("Y-m-d H:i:s", time());
        return Router::to("/member/dashboard");
    }

    /**
     * logout
     *
     * logout current user and destroy the session
     * 
     * @return void
     */
    public static function logout()
    {
        session_start();
        session_destroy();
        Router::to("/");
    }

    /**
     * forgotPassword
     * 
     * Open forgot password view
     *
     * @return void
     */
    public static function forgotPassword()
    {
        self::view("forgot-password");
    }


    /**
     * sendResetPassword
     * 
     * send reset password
     *
     * @return void
     */
    public static function sendResetPassword()
    {
    }

    /**
     * resetPassword
     * 
     * reset password
     *
     * @return void
     */
    public static function resetPassword()
    {
        $data = [
            "gen" => 1223
        ];
        self::view("reset-password", $data);
    }

    /**
     * changePassword
     *
     * change password from reset password
     * 
     * @return void
     */
    public static function changePassword()
    {
    }
}
