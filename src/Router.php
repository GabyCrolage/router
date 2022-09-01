<?php

namespace Router;

class Router extends Route {
    public static function get_page(){
        $page = self::path(0) ?? 'index';
        $path = PUBLIC_HTML . $page . '.php';
        if( !file_exists($path) ) self::_404();
        else return $page . '.php';
    }

    public static function _404(){
        Header('Location : ' . BASE_URL . '404');
        exit();
    }
}