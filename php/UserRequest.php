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
    private $i;

    private $X_MIN = -3;
    private $X_MAX = 5;
    private $Y_ARRAY = array(-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2);
    private $R_ARRAY = array(1, 2, 3, 4, 5);

    public function __construct($i)
    {
        $this->i = $i;
        $this->validateData();
    }

    public function getData() { return array($this->x, $this->y, $this->r); }

    private function validateX() {
        if (!isset($_GET['x'])) {
            throw new ErrorException("Don't found argument x");
        } else if (!is_numeric($_GET['x'])) {
            throw new InvalidArgumentException("Argument x must be number");
        } else if (($_GET['x'] >= $this->X_MIN) && ($_GET['x'] <= $this->X_MAX)) {
            $this->x = (float) $_GET['x'];
            return true;
        } else {
            throw new UnexpectedValueException("Argument x must be between $this->X_MIN and $this->X_MAX");
        }
    }

    private function validateY() {
        if (!isset($_GET['y'])) {
            throw new ErrorException("Don't found argument y");
        } elseif (in_array($_GET['y'], $this->Y_ARRAY)) {
            $this->y = (float) $_GET['y'];
            return true;
        } else {
            throw new UnexpectedValueException("Argument y must be from the set: " . print_r($this->Y_ARRAY));
        }
    }

    private function validateR() {
        if (!isset($_GET['r'][$this->i])) {
            throw new ErrorException("Don't found argument r");
        } else if (in_array($_GET['r'][$this->i], $this->R_ARRAY)) {
            $this->r = (float) $_GET['r'][$this->i];
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