<?php

namespace Lab1;

include_once("Quarter.php");

class FirstQuarter implements Quarter
{
    public function checkPoint($x, $y)
    {
        return ($x >= 0) && ($y >= 0);
    }
}