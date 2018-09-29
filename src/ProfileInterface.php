<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 10:57
 */

namespace App;

interface ProfileInterface
{
    public function getPassword($account);
}