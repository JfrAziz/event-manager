<?php

namespace Apps\Config;

use Apps\Controller\Auth;
use Apps\Controller\Home;
use Apps\Controller\Member;
use Apps\Lib\Request as Req;
use Apps\Lib\Response as Res;
use Apps\Lib\Router;

Router::get("/", function () {
    (new Home())->index();
});

Router::get("/login", function () {
    (new Auth())->login();
});

Router::post("/login", function (Req $req, Res $res) {
    (new Auth())->validate_login($req, $res);
});

Router::get("/logout", function () {
    (new Auth())->logout();
});

Router::get("/post/([0-9]*)/([0-9]*)", function (Req $req, Res $res) {
    (new Member())->test($req, $res);
});
