<?php

namespace Router;

class Route {
    static $route;

    public static function get(){
        $parse_url = parse_url($_SERVER['REQUEST_URI']);
        self::$route = [
            "path" => self::get_path( $parse_url['path'] ),
            "query" => self::get_query_string( $parse_url['query'] ?? '')
        ];
    }

    private static function get_path( $parse_path ){
        $path = explode('/', trim($parse_path, '\/') );
        array_shift( $path );
        return $path;
    }

    private static function get_query_string( $parse_query ){
        $query = str_replace('?', '&', $parse_query );
        if( $query === '' ) return [];
        preg_match_all('#(?:[?&]*([^=]*)=([^=&?]*))#', $query, $query_matches );
        for($i=0;$i<count($query_matches[0]);$i++){
            $query_args[ $query_matches[1][$i] ] = $query_matches[2][$i];
        }
        return $query_args;
    }

    public static function path( int $level = null ){
        if( is_null( $level ) ) return self::$route['path'];
        return self::$route['path'][$level] ?? null;
    }

    public static function query( string $key = null ){
        if( is_null( $key ) ) return self::$route['query'];
        return self::$route['query'][$key] ?? null;
    }
}