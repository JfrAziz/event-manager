<?php

namespace Apps\Controller;

use Apps\Config\Config;
use Apps\Lib\Controller;

class Main extends Controller
{
    public function logActivity($loggedOnUser, $log)
    {
        $conn = $this->database;
        $logSQL = $conn->prepare('CALL enterLog(:loggedOnUser,:log);');
        $logSQL->bindValue(":loggedOnUser", $loggedOnUser);
        $logSQL->bindValue(":log", $log);
        $logSQL->execute();
    }

    public function retIsAdmin($loggedOnUser)
    {
        $conn = $this->database;
        $retIsAdminSQL = $conn->prepare('select count(1) as code from login where LoginName= :loggedOnUser and IsAdmin=1;');
        $retIsAdminSQL->bindValue(":loggedOnUser", $loggedOnUser);
        $retIsAdminSQL->execute();
        foreach ($retIsAdminSQL as $row) {
            return $row["code"];
        }
    }

    public function retProfilePic($loggedOnUser)
    {
        $conn = $this->database;
        $retProfilePicSQL =  $conn->prepare('select imgsrc from login where LoginName= :loggedOnUser limit 1;');
        $retProfilePicSQL->bindValue(":loggedOnUser", $loggedOnUser);
        $retProfilePicSQL->execute();

        foreach ($retProfilePicSQL as $row) {
            return Config::$startPath . '/assets/img/avatars/users/' . $row["imgsrc"];
        }
    }
}
