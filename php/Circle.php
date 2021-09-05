<?php

namespace Lab1;

class Circle extends Shape
{
    public function checkHit($x, $y, $r)
    {
        return (pow($x, 2) + pow($y, 2) <= pow($r / 2, 2))
            && $this->quarter->checkPoint($x, $y);
    }
}