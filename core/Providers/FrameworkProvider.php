<?php

    namespace Devyuha\Lunaris\Providers;

    class FrameworkProvider
    {
        public function getCommands() {
            return [
                "make:controller" => \Devyuha\Lunaris\Commands\MakeController::class,
                "make:module" => \Devyuha\Lunaris\Commands\MakeModule::class
            ];
        }
    }
