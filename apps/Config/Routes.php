<?php

namespace Apps\Config;

use Apps\Controller\Auth;
use Apps\Controller\Certificate;
use Apps\Controller\Form;
use Apps\Controller\Home;
use Apps\Controller\Mail;
use Apps\Controller\Member;
use Apps\Lib\Request as Req;
use Apps\Lib\Response as Res;
use Apps\Lib\Router;

// Public

Router::get("/", function () {
    Home::index();
});


// Admin authentication and authorization 

Router::get("/login", function () {
    Auth::login();
});

Router::post("/login", function (Req $req, Res $res) {
    Auth::validateLogin($req, $res);
});

Router::get("/logout", function () {
    Auth::logout();
});

Router::get("/forgot-password", function () {
    Auth::forgotPassword();
});

Router::post("/forgot-password", function () {
    Auth::sendResetPassword();
});

Router::get("/reset-password", function () {
    Auth::resetPassword();
});

Router::post("/reset-password", function () {
    Auth::changePassword();
});

// Member Dashboard and profile

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


// Mail

Router::get("/member/mail", function () {
    (new Mail())->index();
});

Router::get("/member/mail/list", function () {
    (new Mail())->list();
});


// Cerricate

Router::get("/member/certificate", function () {
    (new Certificate())->index();
});