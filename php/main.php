<?php

namespace Lab1;

use ErrorException;
use InvalidArgumentException;
use UnexpectedValueException;

include_once("UserRequest.php");
include_once("Area.php");
include_once("HorizontalRhomb.php");
include_once("VerticalRect.php");
include_once("Circle.php");
include_once("SecondQuarter.php");
include_once("ThirdQuarter.php");
include_once("FourthQuarter.php");

@session_start();
if (!isset($_SESSION["jsonData"])) $_SESSION["jsonData"] = array();
try {
    $userRequest = new UserRequest();
    $userRequest->validateData();
    list ($x, $y, $r) = $userRequest->getData();
    $area = new Area();
    $area->addShape(new HorizontalRhomb(new SecondQuarter()));
    $area->addShape(new VerticalRect(new ThirdQuarter()));
    $area->addShape(new Circle(new FourthQuarter()));
    $result = $area->checkArea($x, $y, $r) ? "Попали" : "Не попали";

    date_default_timezone_set($_GET["timezone"]);
    $currentTime = date("H : i : s");
    $executionTime = round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 7);
    array_push($_SESSION["jsonData"],
    "\"x\":\"$x\"," .
           "\"y\":\"$y\"," .
           "\"r\":\"$r\"," .
           "\"currentTime\":\"$currentTime\"," .
           "\"executionTime\":\"$executionTime\"," .
           "\"isHit\":\"$result\""
    );
} catch (ErrorException $e) {
    http_response_code(418);
    array_push($_SESSION["jsonData"],
        "\"errorMessage\":\"" . $e->getMessage()
    );
} catch (InvalidArgumentException $e) {
    http_response_code(415);
    array_push($_SESSION["jsonData"],
        "\"errorMessage\":\"" . $e->getMessage()
    );
} catch (UnexpectedValueException $e) {
    http_response_code(418);
    array_push($_SESSION["jsonData"],
        "\"errorMessage\":\"" . $e->getMessage()
    );
} finally {
    echo "{ \"data\": [{" . implode('}, {', $_SESSION["jsonData"]) . "}]}";
}

