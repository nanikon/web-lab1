<?php

namespace Lab1;

include_once("Shape.php");
include_once("Quarter.php");

class VerticalRect extends Shape
{

    public function checkHit($x, $y, $r)
    {
        $little_r = $r / 2;
        return ($y <= $r) && ($y >= -1 * $r)
            && ($x <= $little_r) && ($x >= -1 * $little_r)
            && $this->quarter->checkPoint($x, $y);
    }
}