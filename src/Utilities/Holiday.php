<?php
/**
 * Created by PhpStorm.
 * User: fripig
 * Date: 2018/9/29
 * Time: 09:14
 */

namespace App\Utilities;


use DateTime;

class Holiday
{
    /**
     * @var null
     */
    private $date;

    public function __construct(DateTime $date = null)
    {
        $this->date = $date ?? new DateTime();
    }

    public function SayXmas()
    {
        $check = [
            '1225',
            '1224'
        ];
        if (in_array($this->GetToday(),$check)){
            return 'Merry Xmax';
        }else {
            return 'Today is not Merry Xmax';
        }
    }

    /**
     * @return string
     */
    protected function GetToday(): string
    {
        return $this->date->format('md');
    }
}