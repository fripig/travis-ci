<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 09:13
 */

namespace App;

use App\Interfaces\IRepository;
use App\Models\MyOrder;
use Closure;

class MyOrderModel implements IOrderModel
{
    /**
     * @var IRepository
     */
    private $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(MyOrder $order, Callable  $insertCallback, Callable  $updateCallback)
    {
        if (!$this->repository->isExist($order)) {
            $this->repository->insert($order);
            $insertCallback($order);
        }
        else {
            $this->repository->update($order);
            $updateCallback($order);
        }
    }

    public function delete(Callable  $predicate)
    {
        throw new Exception('Not implemented');
    }
}