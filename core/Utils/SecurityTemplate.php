<?php

    namespace Devyuha\Lunaris\Utils;

    class SecurityTemplate {
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

        public static function request($moduleName, $requestName=null) {
            if(!$requestName) {
                $requestName = $moduleName . 'Request';
            }

            $content = <<<PHP
            <?php

                namespace Module\\{$moduleName}\\Requests;

                use Devyuha\\Lunaris\\Http\\Request;
                
                class {$requestName} extends Request
                {
                    protected function handle() {
                        // add/modify request data
                    }

                    protected function validate() {
                        // validate your request data
                    }
                }
            PHP;

            return $content;
        }

        public static function middleware($moduleName, $middlewareName=null) {
            if(!$middlewareName) {
                $middlewareName = $moduleName . 'Middleware';
            }

            $content = <<<PHP
            <?php

                namespace Module\\{$moduleName}\\Middlewares;

                use Pecee\\Http\\Middleware\\IMiddleware;
                use Pecee\\Http\\Request;

                class {$middlewareName} implements IMiddleware {
                    public function handle(Request \$request): void {
                        //
                    }
                }
            PHP;

            return $content;
        }
    }
