<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 11:00
 */

namespace App;

interface TokenInterfance
{
    public function getRandom($account);
}