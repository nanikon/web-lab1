<?php

function checkX($x) {
    $X_MIN = -3;
    $X_MAX = -5;
    return isset($x) && is_numeric($x) && $x >= $X_MIN && $x <= $X_MAX;
}

function checkY($y) {
    return isset($y) && in_array($y, array(-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2));
}
function checkR($r) {
    return isset($r) && in_array($r, array(1, 2, 3, 4, 5));
}

function checkForm($x, $y, $r) {
    return checkX($x) & checkY($y) & checkR($r);
}

@session_start();
$x = (float) $_GET['x'];
$y = (float) $_GET['y'];
$r = (float) $_GET['r'];
$isValid = checkForm($x, $y, $r) ? "true" : "false";

?>
