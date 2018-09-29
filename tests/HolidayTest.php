<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 09:16
 */

namespace App;

use App\Utilities\Holiday;
use DateTime;
use PHPUnit\Framework\TestCase;

class HolidayTest extends TestCase
{
    protected $target;

    public function setUp()
    {
        $this->target  = new FakeHoliday();
    }

    public function testSayXmas()
    {
        $this->SayXmasGiveDay('1225');

        $this->SayXmasGiveDay('1224');

        $this->SayXmasNotGiveDay('1223');
    }

    /**
     * @return array
     */
    protected function SayXmasGiveDay($check): void
    {

        $check = '1225';
        $this->target->setDate($check);

        $this->assertEquals(
            $this->target->SayXmas(),
            'Merry Xmax');

    }

    protected function SayXmasNotGiveDay($check): void
    {
        $check = '1223';
        $this->target->setDate($check);

        $this->assertEquals(
            $this->target->SayXmas(),
            'Today is not Merry Xmax');
    }
}

class FakeHoliday extends Holiday{
    protected $date;

    public function setDate(string $date):void
    {
        $date = DateTime::createFromFormat('md', $date);
        $this->date = $date;
    }

    protected function GetToday() :string
    {
        return $this->date->format('md');
    }

}
