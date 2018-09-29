<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 15:34
 */

namespace App;

interface BookDaoInterface
{
    public function insert(Order $order);
}