<?php
@session_start();
echo "{\"answer\": [{" . implode('}, {', $_SESSION["jsonData"]) . "}]," .
    "\"table\": \"<table><thead><tr><th>X</th><th>Y</th><th>R</th><th>Попали?</th><th>Текущее время</th><th>Время работы скрипта (в микросек.)</th></tr></thead><tbody>". $_SESSION["table"] . "</tbody></table>\"}";
