<?php

namespace Apps\Config;

use Apps\Controller\Auth;
use Apps\Controller\Form;
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

// Member

Router::get("/member/dashboard", function () {
    (new Member())->index();
});

Router::get("/member/profile", function () {
    (new Member())->profile();
});

Router::post("/member/profile/photo", function (Req $req, Res $res) {
    (new Member())->update_photo($req);
});

Router::post("/member/profile/info", function (Req $req, Res $res) {
    (new Member())->update_user($req);
});

Router::post("/member/profile/contact", function (Req $req, Res $res) {
    (new Member())->update_contact($req);
});

Router::post("/member/profile/signature", function (Req $req, Res $res) {
    (new Member())->update_signature($req);
});

// Form

Router::get("/member/form", function () {
    (new Form())->index();
});

Router::get("/member/form/reg", function (Req $req, Res $res) {
    (new Form())->registration($req);
});