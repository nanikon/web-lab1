<?php

namespace Lab1;

class Area
{
    private $parts = array();

    public function addShape(Shape $shape) {
        $this->parts[] = $shape;
    }

    public function checkArea($x, $y, $r) {
        $result = true;
        for ($i = 0; $i < count($this->parts); $i++) $result = $result && $this->parts[$i]->checkHit($x, $y, $r);
        return $result;
    }
}