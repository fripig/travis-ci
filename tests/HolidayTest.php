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
    protected $holiday;

    protected function setUp()
    {
        $this->holiday  = new FakeHoliday();
    }

    public function test_date_1225_is_Xmas()
    {
        $this->SayXmasGiveDay(date('1225'));
    }

    public function test_date_1224_is_Xmas_too()
    {
        $this->SayXmasGiveDay(date('1224'));

    }

    public function test_date_1223_is_not_xmas()
    {
        $this->SayXmasNotGiveDay('1223');
    }

    /**
     * @return array
     */
    protected function SayXmasGiveDay($check): void
    {

        $this->holiday->setDate($check);

        $this->assertEquals(
            $this->holiday->SayXmas(),
            'Merry Xmax');

    }

    protected function SayXmasNotGiveDay($check): void
    {
        $this->holiday->setDate($check);

        $this->assertEquals(
            $this->holiday->SayXmas(),
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
