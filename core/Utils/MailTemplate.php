<?php

    namespace Devyuha\Lunaris\Utils;

    class MailTemplate {
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

        public static function mail($moduleName, $mailName=null) {
            if(!$mailName) {
                $mailName = $moduleName . "Mail";
            }

            $content = <<<PHP
            <?php

                namespace Module\\{$moduleName}\\Mails;

                use Devyuha\\Lunaris\\Facades\\Mail;
                use Devyuha\\Lunaris\\Interface\MailInterface;
                
                class {$mailName} extends Mail implements MailInterface
                {
                    public function handle(array \$args): void {
                        // Write your mail content here
                    }
                }
            PHP;

            return $content;
        }
    }
