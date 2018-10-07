<?php
/**
 * Created by PhpStorm.
 * User: fripi
 * Date: 2018/10/7
 * Time: 上午 01:25
 */

namespace App\Interfaces;

use App\Models\MyOrder;

interface IRepository
{
    public function isExist(MyOrder $order);

    public function insert(MyOrder $order);

    public function update(MyOrder $order);
}