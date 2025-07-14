<?php

    namespace Devyuha\Lunaris\Providers;

    class MailerProvider {
        public function getCommands() {
            return [
                "make:mail" => \Devyuha\Lunaris\Commands\MakeMail::class
            ];
        }
    }
