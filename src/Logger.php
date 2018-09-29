<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 12:10
 */

namespace App;


class Logger implements LoggerInterface
{

    public function save(string $string, ?array $array = null) :string
    {
        return vsprintf($string,$array);
    }

    public function info(string $string, ?array $array)
    {
        // TODO: Implement info() method.
    }
}