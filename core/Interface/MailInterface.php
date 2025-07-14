<?php

    namespace Devyuha\Lunaris\Interface;

    interface MailInterface {
        public function handle(array $args): void;
    }
