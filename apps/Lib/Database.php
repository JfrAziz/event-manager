<?php

namespace Apps\Lib;

use \PDO;
use \Apps\Config\Database as DatabaseConf;

class Database
{
    public function connect (): PDO
    {
        $dsn = 'mysql:dbname='.DatabaseConf::$db.';host='.DatabaseConf::$host.';charset=utf8';
        $pdo = new PDO($dsn, DatabaseConf::$username, DatabaseConf::$password);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}