<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 09:12
 */

namespace App;

use App\Models\MyOrder;
use Closure;

interface IOrderModel
{
    public function save(MyOrder $order, Callable  $insertCallback, Callable  $updateCallback);

    public function delete(Callable  $predicate);
}