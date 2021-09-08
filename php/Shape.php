<?php

namespace Lab1;

include_once("Quarter.php");

abstract class Shape
{
    protected $quarter;
    public function __construct(Quarter $quarter)
    {
        $this->quarter = $quarter;
    }

    abstract public function checkHit($x, $y, $r);
}