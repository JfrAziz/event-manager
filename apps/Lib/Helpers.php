<?php

use Config\Config;

function get_url(): string
{
    $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $link .= $_SERVER['HTTP_HOST'];
    $link .= $_SERVER['REQUEST_URI'];
    $link = trim($link, "/");
    return $link;
}

function base_url(string $uri = ""): string
{
    $url = trim(Config::$base_url, "/");
    $uri = trim($uri, "/");
    return trim($url."/".$uri, "/");
}

function is_admin(): bool
{
    if(session_status() == PHP_SESSION_NONE) session_start();
    return $_SESSION['is_admin'] ? true : false;
}