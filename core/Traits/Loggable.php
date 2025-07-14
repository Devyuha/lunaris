<?php

    namespace Devyuha\Lunaris\Utils;

    trait Loggable {
        /**
         * Logs an informational message in blue.
         */
        public function info(string $message): void
        {
            echo "\033[34m[INFO] $message\033[0m\n"; // Blue text
        }

        /**
         * Logs a success message in green.
         */
        public function success(string $message): void
        {
            echo "\033[32m[SUCCESS] $message\033[0m\n"; // Green text
        }

        /**
         * Logs a warning message in yellow.
         */
        public function warning(string $message): void
        {
            echo "\033[33m[WARNING] $message\033[0m\n"; // Yellow text
        }

        /**
         * Logs an error message in red.
         */
        public function error(string $message): void
        {
            echo "\033[31m[ERROR] $message\033[0m\n"; // Red text
        }
    }
