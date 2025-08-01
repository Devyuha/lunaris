<?php

    namespace Devyuha\Lunaris\Utils;

    class GeneralTemplate 
    {
        public static function getArgs(array $args) {
            $parsed = [];
            if(count($args) > 0) {
                foreach($args as $arg) {
                    if(strpos($arg, '=') !== false) {
                        [$key, $value] = explode('=', $arg, 2);
                        $parsed[$key] = $value;
                    }
                }
            }
            return $parsed;
        }

        public static function controller($moduleName, $controllerName=null) {
            if(!$controllerName) {
                $controllerName = $moduleName . 'Controller';
            }

            $content = <<<PHP
            <?php

                namespace Module\\{$moduleName}\\Controllers;

                use Devyuha\\Lunaris\\Http\\Controller;
                
                class {$controllerName} extends Controller
                {
                    public function index() {
                        echo "This is the {$moduleName} module.";
                    }
                }
            PHP;

            return $content;
        }

        public static function router($moduleName) {
            $init = strtolower($moduleName);
            $content = <<<PHP
            <?php

                use Devyuha\\Lunaris\\Http\\Router;

                Router::get("/{$init}", [Module\\{$moduleName}\\Controllers\\{$moduleName}Controller::class, 'index']);
            PHP;

            return $content;
        }
    }
