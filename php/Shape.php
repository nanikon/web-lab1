<?php

namespace Lab1;

abstract class Shape
{
    protected $quarter;
    public function __construct(Quarter $quarter)
    {
        $this->quarter = $quarter;
    }

    abstract public function checkHit($x, $y, $r);
}