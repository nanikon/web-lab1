<?php

namespace Lab1;

include_once("Shape.php");
include_once("Quarter.php");

class HorizontalRhomb extends Shape
{

    public function checkHit($x, $y, $r)
    {
        return ($y <= ($r - $x) / 2)
            && ($y >= ($x - $r) / 2)
            && ($y >= -($x + $r) / 2)
            && ($y <= ($r + $x) / 2)
            && $this->quarter->checkPoint($x, $y);
    }
}