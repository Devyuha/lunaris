<?php

    namespace Devyuha\Lunaris\Providers;

    class SecurityProvider {
        public function getCommands() {
            return [
                "key:generate" => \Devyuha\Lunaris\Commands\KeyGenerate::class,
                "make:request" => \Devyuha\Lunaris\Commands\MakeRequest::class
            ];
        }
    }
