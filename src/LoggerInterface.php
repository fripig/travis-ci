<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 13:40
 */

namespace App;

interface LoggerInterface
{
    public function save(string $string, ?array $array);

    public function info(string $string, ?array $array);
}