<?php
/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 08:37
 */

namespace Tests {

    use App\BookDaoInterface;
    use App\Order;
    use App\OrderService;
    use App\OrderServiceForTest;
    use PHPUnit\Framework\TestCase;
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    use Mockery as m;

    class OrderServiceTest extends TestCase
    {
        use MockeryPHPUnitIntegration;

        /** @test */
        private $target;
        private $spyBookDao;


        public function setUp()
        {
            $this->target = m::spy(OrderService::class)
                ->makePartial();
            $this->target->shouldAllowMockingProtectedMethods();



            $this->spyBookDao = m::spy(BookDaoInterface::class);

            $this->target
                ->shouldReceive('getBookDao')
                ->andReturn($this->spyBookDao);

        }

        public function test_sync_book_orders_3_orders_only_2_book_order()
        {
            $this->givenOrders(['Book', 'CD', 'Book']);


            $this->target->syncBookOrders();

            $this->bookDaoShouldInsertTimes(2);


        }

        /**
         * @param $type
         * @return Order
         */
        protected function createBook($type): Order
        {
            $order1 = new Order();
            $order1->type = $type;
            return $order1;
        }

        /**
         * @param $types
         * @param $types
         */
        protected function givenOrders($types): void
        {
            $orders = [];
            foreach ($types as $type) {
                $orders[] = $this->createBook($type);
            }

            $this->target->shouldReceive('getOrders')
                ->andReturn($orders);
        }

        private function bookDaoShouldInsertTimes($times)
        {
            $this->spyBookDao
                ->shouldHaveReceived('insert')
                ->with(m::on(function (Order $order) {
                    return $order->type == 'Book';
            }))->times($times);
        }
    }
}

