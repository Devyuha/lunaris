<?php

    namespace Devyuha\Lunaris\Utils;

    class PdoTemplate {
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

        public static function query($moduleName, $queryName=null) {
            if(!$queryName) {
                $queryName = $moduleName . "Query";
            }

            $content = <<<PHP
            <?php

                namespace Module\\{$moduleName}\\Queries;

                use Devyuha\Lunaris\Facades\Query;

                class {$queryName} extends Query {
                    public function sql() {
                        return <<<SQL
                        
                        SQL;
                    }
                }
            PHP;

            return $content;
        }
    }
