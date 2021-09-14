<?php

namespace Lab1;

use ErrorException;
use InvalidArgumentException;
use UnexpectedValueException;

class UserRequest
{
    private $x;
    private $y;
    private $r;

    private $X_MIN = -3;
    private $X_MAX = 5;
    private $Y_ARRAY = array(-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2);
    private $R_ARRAY = array(1, 2, 3, 4, 5);

    public function __construct($i)
    {
        $this->x = (float) $_GET['x'];
        $this->y = (float) $_GET['y'];
        $this->r = (float) $_GET['r'][$i];
    }

    public function getData() { return array($this->x, $this->y, $this->r); }

    private function validateX() {
        if (!isset($this->x)) {
            throw new ErrorException("Don't found argument x");
        } else if (!is_numeric($this->x)) {
            throw new InvalidArgumentException("Argument x must be number");
        } else if (($this->x >= $this->X_MIN) && ($this->x <= $this->X_MAX)) {
            return true;
        } else {
            throw new UnexpectedValueException("Argument x must be between $this->X_MIN and $this->X_MAX");
        }
    }

    private function validateY() {
        if (!isset($this->y)) {
            throw new ErrorException("Don't found argument y");
        } elseif (in_array($this->y, $this->Y_ARRAY)) {
            return true;
        } else {
            throw new UnexpectedValueException("Argument y must be from the set: " . print_r($this->Y_ARRAY));
        }
    }

    private function validateR() {
        if (!isset($this->r)) {
            throw new ErrorException("Don't found argument r");
        } else if (in_array($this->r, $this->R_ARRAY)) {
            return true;
        } else {
            throw new UnexpectedValueException("Argument r must be from the set: " . print_r($this->R_ARRAY));
        }
    }

    public function validateData() {
        return $this->validateX()
            && $this->validateY()
            && $this->validateR();
    }
}