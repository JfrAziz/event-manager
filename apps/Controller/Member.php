<?php

namespace Apps\Controller;

use Apps\Lib\Request;
use Apps\Lib\Response;
use Apps\Lib\Controller;

class Member extends Controller
{

    public function index(){
        self::view("dashboard");
    }

    public function test(Request $request, Response $response){
        $response->toJSON([
            'id' => $request->params[0],
            'asdas' => $request->params[1],
            'status' => 200
        ]);
    }

    public function mantap(){
        $conn = $this->database;
        $sql = $conn->prepare("SELECT * FROM login WHERE LoginName=:currentUser LIMIT 1");
        $sql->bindValue(':currentUser', "admin");
        $sql->execute();
        $result = $sql->fetch();
        if($result) {
            $data = [
                'result' => $result
            ];
            self::view("mantap", $data);
        } else echo "asdasdad";
    }
}