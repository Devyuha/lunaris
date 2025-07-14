<?php

    namespace Devyuha\Lunaris;

    use Exception;

    use Devyuha\Lunaris\Http\Router;
    use Devyuha\Lunaris\Http\CsrfVerifier;

    use Dotenv\Dotenv;

    class Container {
        private $path;

        public function __construct($path) {
            $this->path = $path;
        }

        private function loadRoutes($modules) {
            Router::csrfVerifier(new CsrfVerifier());

            $modulesPath = $this->path . "/modules/";

            if(count($modules) > 0) {
                foreach($modules as $module) {
                    $routeFile = $modulesPath . $module . "/routes.php";

                    if(file_exists($routeFile)) {
                        require_once $routeFile;
                    }
                }
            }

            Router::start();
        }

        private function loadModules() {
            $modulesFile = $this->path . "/config/modules.php";

            if(file_exists($modulesFile)) {
                $modules = require_once $modulesFile;

                $this->loadRoutes($modules);
            }
        }

        private function loadEnv() {
            $dotenv = Dotenv::createImmutable($this->path . "/", null, false);

            try {
                $dotenv->load();
            } catch(Exception $e) {
                throw new Exception("Error loading .env :: " . $e->getMessage());
            }
        }

        public function init() {
            $this->loadEnv();
            $this->loadModules();
        }
    }
