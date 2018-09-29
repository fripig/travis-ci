<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 12:10
 */

namespace App;


class Logger
{

    public function save(string $string, array $array) :string
    {
        return vsprintf($string,$array);
    }
}