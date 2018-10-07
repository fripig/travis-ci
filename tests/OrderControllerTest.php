<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 09:00
 */

namespace Tests;

use App\IOrderModel;
use App\Models\MyOrder;
use App\OrderController;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery as m;

class OrderControllerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @var OrderController
     */
    private $orderController;

    /**
     * @var m\Mock
     */
    private $model;

    public function setUp()
    {
        $this->model = m::mock(IOrderModel::class);


        $this->model->shouldReceive('delete');

        $this->orderController = new OrderController($this->model);
    }


    /** @test */
    public function exist_order_should_update()
    {
        $this->GiveModelUpdate();
        $order = $this->CreateOrder(91, 100);
        $this->orderController->save($order);
        $this->ShouldLog(sprintf('update order id:%s with %s successfully!', $order->id, $order->amount));
    }

    /** @test */
    public function no_exist_order_should_insert()
    {
        $this->GiveModelInsert();
        $order = $this->CreateOrder(91, 100);
        $this->orderController->save($order);
        $this->ShouldLog(sprintf('insert order id:%s with %s successfully!', $order->id, $order->amount));
    }

    /** @test */
    public function verify_lambda_function_of_delete()
    {

        $this->orderController->deleteAmountMoreThan100();
    }

    /**
     * @param $model
     */
    protected function GiveModelInsert(): void
    {
        $this->model->shouldReceive('save')
            ->andReturnUsing(function($order,$insert,$update){
                $result = $insert($order);

            })->once();
    }

    protected function GiveModelUpdate(): void
    {
        $this->model->shouldReceive('save')
            ->andReturnUsing(function($order,$insert,$update){
                $result = $update($order);

            })->once();
    }

    /**
     * @param $id
     * @param $amount
     * @return MyOrder
     */
    protected function CreateOrder($id, $amount): MyOrder
    {
        $order = new MyOrder($id, $amount);
        return $order;
    }

    /**
     * @param $order
     */
    protected function ShouldLog($log): void
    {
        $this->expectOutputString($log);
    }
}
