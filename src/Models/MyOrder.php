<?php
/**
 * Created by PhpStorm.
 * User: fripi
 * Date: 2018/10/7
 * Time: 上午 01:25
 */

namespace App\Models;

class MyOrder
{
    public $id;
    public $amount;

    public function __construct($id = null, $amount = null)
    {
        $this->id = $id;
        $this->amount = $amount;
    }
}