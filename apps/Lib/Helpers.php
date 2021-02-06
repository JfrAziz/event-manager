<?php

function get_full_url(): string
{
    $link = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $link .= $_SERVER['HTTP_HOST'];
    $link .= $_SERVER['REQUEST_URI'];
    $link = trim($link, "/");
    return $link;
}

function base_url(string $uri = ""): string
{
    $url = trim(\Apps\Config\Config::$base_url, "/");
    $uri = trim($uri, "/");
    return trim($url."/".$uri, "/");
}