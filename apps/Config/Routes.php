<?php

namespace Apps\Config;

use Apps\Controller\Auth;
use Apps\Controller\Certificate;
use Apps\Controller\Event;
use Apps\Controller\Form;
use Apps\Controller\Home;
use Apps\Controller\Mail;
use Apps\Controller\Member;
use Apps\Lib\Request as Req;
use Apps\Lib\Response as Res;
use Apps\Lib\Router;

// Public

Router::get("/", function () {
    (new Home())->index();
});

Router::get("/e/([0-9]*)", function (Req $req, Res $res) {
    (new Home())->show($req);
});


// Admin authentication and authorization 
Router::get("/register", function () {
    Auth::register();
});

Router::post("/register", function (Req $req, Res $res) {
    Auth::validateRegister($req, $res);
});


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

Router::get("/member", function () {
    (new Member())->index();
});

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
    Form::index();
});

Router::post("/member/form", function (Req $req, Res $res) {
    Form::addEvent($req);
});

Router::get("/member/form/selectevt", function (Req $req) {
    (new Form())->selectEvt($req);
});

Router::get("/member/form/reg", function (Req $req, Res $res) {
    (new Form())->registration($req);
});


// ALl event
Router::get("/member/event", function () {
    (new Event())->index();
});

Router::get("/member/event", function () {
    (new Event())->index();
});

Router::post("/member/event/register", function (Req $req, Res $res) {
    (new Event())->register($req);
});

Router::get("/member/event/([0-9]*)", function (Req $req, Res $res) {
    (new Event())->show($req);
});

// Certificate

Router::get("/member/certificate", function () {
    (new Event())->certificate();
});


Router::get("/member/certificate/([0-9]*)", function (Req $req, Res $res) {
    (new Event())->showCertificate($req);
});


// Mail

Router::get("/member/mail", function () {
    (new Mail())->index();
});

Router::post("/member/sendEmail", function () {
    (new Mail())->send();
});

Router::post("/member/changeEvent", function () {
    (new Mail())->changeEvent();
});

Router::post("/member/searchAjax", function () {
    (new Mail())->search();
});

Router::get("/member/mail/list", function () {
    (new Mail())->list();
});


