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
        $check_sql = $conn->prepare('SELECT COUNT(*) as result FROM login WHERE LoginName=:uname && PasswordHash=SHA(:password);');
        $check_sql->bindValue(":uname", $username);
        $check_sql->bindValue(":password", $password);
        $check_sql->execute();
        $result = $check_sql->fetchAll(PDO::FETCH_ASSOC);
        $count = $result[0]['result'];

        if ($count != 1) return Router::to("/login");

        $user_data = $conn->prepare('SELECT * FROM login WHERE LoginName=:uname;');
        $user_data->bindValue(":uname", $username);
        $user_data->execute();
        $result = $user_data->fetchAll(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION = $result[0];
        $_SESSION['loginTime'] = date("Y-m-d H:i:s", time());
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
    public static function sendResetPassword(){

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
