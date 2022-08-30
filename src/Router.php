<?php

namespace Router;

class Router extends Route {
    public static function get_page(){
        $page = self::path(0) ?? 'index';
        $path = PUBLIC_HTML . $page . '.php';
        if( !file_exists($path) ) return 404;
        else return $page . '.php';
    }
}