<?php
/**
 * Created by PhpStorm.
 * User: jakhar
 * Date: 11/19/19
 * Time: 4:50 PM
 */

namespace App\Helpers;

/**
 * Class SortHelper
 * @package App\Helpers
 */
class SortHelper
{
    /**
     * @param $attribute
     * @param string $param
     * @return string
     */
    public static function getLink($attribute, $param = "sort")
    {
        $direction = self::getDirectionSort($param);
        $sort = array_key_exists($attribute, $direction) ? $direction[$attribute] == "DESC" ? "" : "-" : "";
        return RequestHelper::setParam($param, $sort . $attribute);
    }

    /**
     * @param string $param
     * @return array
     */
    public static function getDirectionSort($param = "sort")
    {
        $parse = parse_url($_SERVER['REQUEST_URI']);
        $query = $parse['query'] ?? "";
        parse_str($query, $data);
        if (!isset($data['sort'])) {
            return [];
        }
        $direction = preg_match("#\-#", $data['sort']) ? "DESC" : "ASC";
        return [preg_replace("#\-#",null,$data['sort']) => $direction];
    }

}