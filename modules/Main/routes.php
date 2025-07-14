<?php

    use Devyuha\Lunaris\Http\Router;

    Router::get("/", [Module\Main\Controllers\MainController::class, "home"])->name("main.index");
