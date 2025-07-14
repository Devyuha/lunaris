<?php

    namespace Devyuha\Lunaris\Utils;

    class Config {
        private static $instance = null;
        private $data;

        public function __construct() {
            $root = dirname(getcwd());
            $config = require $root . '/config/app.php';

            $this->data = $config;
        }

        public function data() {
            return $this->data;
        }

        public static function init() {
            if(!self::$instance) {
                self::$instance = new Config();
            }

            return self::$instance;
        }

        public static function getConnectionString($data = []) {
            if($data) {
                $db_engine = $data["db_engine"];
                $db_host = $data["db_host"];
                $db_name = $data["db_name"];
                $db_charset = $data["db_charset"];
                $string = "$db_engine:host=$db_host;dbname=$db_name;charset=$db_charset";
            }

            return $string;
        }
    }
