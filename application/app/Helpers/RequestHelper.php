<?php

namespace App\Helpers;


/**
 * Class RequestHelper
 * @package App\Helpers
 */
class RequestHelper
{
    /**
     * @param $param
     * @param $value
     * @return string
     */
    public static function setParam($param, $value)
    {
        $parse = parse_url($_SERVER['REQUEST_URI']);
        $query = $parse['query'] ?? "";
        parse_str($query, $data);
        $data[$param] = $value;
        $parse['query'] = http_build_query($data);
        return http_build_url($_SERVER['REQUEST_URI'], $parse);
    }
}