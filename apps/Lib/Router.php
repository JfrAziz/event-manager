<?php


namespace Apps\Lib;


class Router
{
    public static function get($route, $callback)
    {
        $isNotGet = strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0;
        if ($isNotGet) return;
        self::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        $isNotPost = strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0;
        if ($isNotPost) return;
        self::on($route, $callback);
    }

    public static function on($regex, $callback)
    {
        $params = strtok(get_url(),"?");
        $regex = base_url($regex);
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            array_shift($matches);
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);
            $callback(new Request($params), new Response());
        }
    }

    public static function to($route) {
        header("Location: ".base_url($route), true, 302);
        die();
    }
}