<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 09:01
 */

namespace Tests;

use App\Interfaces\IRepository;
use App\Models\MyOrder;
use App\MyOrderModel;
use const false;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;
class OrderModelTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /**
     * @var m\Mock
     */
    private $repository;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = m::mock(IRepository::class);



    }

    /** @test */
    public function insert_order()
    {
        // TODO
        $this->ShouldInsertTimes(1);
        $this->OrderShouldExist(false);
        $this->ShouldUpdateTimes(0, 0);

        $myOrderModel = new MyOrderModel($this->repository);

        $order = new MyOrder(1,'test');

        $myOrderModel->save($order,
            function($order){
            },
            function($order){}
            );
    }

    /** @test */
    public function update_order()
    {
        // TODO
        $myOrderModel = new MyOrderModel($this->repository);

        $this->ShouldInsertTimes(0);
        $this->OrderShouldExist(true);
        $this->ShouldUpdateTimes(1, 0);

        $myOrderModel = new MyOrderModel($this->repository);

        $order = new MyOrder(1,'test');

        $myOrderModel->save($order,
            function($order){
            },
            function($order){}
        );
    }

    protected function ShouldInsertTimes($times = 0): void
    {
        $this->repository->shouldReceive('insert')
            ->times($times);
    }

    protected function OrderShouldExist($exist): void
    {
        $this->repository->shouldReceive('isExist')
            ->andReturn($exist);
    }

    protected function ShouldUpdateTimes($times): void
    {
        $this->repository->shouldReceive('update')
            ->times($times);
    }
}
