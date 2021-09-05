<?php

namespace Lab1;

class SecondQuarter implements Quarter
{

    public function checkPoint($x, $y)
    {
        return ($x <= 0) && ($y >= 0);
    }
}