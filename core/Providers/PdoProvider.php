<?php

    namespace Devyuha\Lunaris\Providers;

    class PdoProvider {
        public function getCommands() {
            return [
                "make:query" => \Devyuha\Lunaris\Commands\MakeQuery::class
            ];
        }
    }
