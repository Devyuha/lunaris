<?php

    require_once "../vendor/autoload.php";

    class Application {
        private $path;

        public function __construct($path) {
            $this->path = $path;
        }

        public function configure() {
            $this->loadProviders();
        }

        private function loadProviders() {
            $providersFile = base_path("config/providers.php");

            if(file_exists($providersFile)) {
                $providers = require_once $providersFile;
                $this->initiateProviders($providers);
            } else {
                throw new Exception("Provider file " . $providersFile . " doesn't exist.");
            }
        }

        private function initiateProviders($providers) {
            if(count($providers) > 0) {
                foreach($providers as $provider) {
                    $class = new $provider($this->path);
                    $class->init();
                }
            }
        }
    }
