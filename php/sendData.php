<?php
@session_start();
echo "{ \"answer\": [{" . implode('}, {', $_SESSION["jsonData"]) . "}]}";
