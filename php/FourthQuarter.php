<?php

namespace Lab1;

class FourthQuarter implements Quarter
{
    public function checkPoint($x, $y)
    {
        return ($x >= 0) && ($y <= 0);
    }
}