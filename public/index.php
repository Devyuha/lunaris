<?php

    session_start();

    ini_set("log_errors", 1);
    ini_set("error_log", "../logger.log");

    require_once "../vendor/autoload.php";
    require_once "../bootstrap/app.php";

    (new Application(__DIR__ . "/../"))->configure();
