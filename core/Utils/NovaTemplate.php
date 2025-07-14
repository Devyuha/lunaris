<?php

    namespace Devyuha\Lunaris\Utils;

    class NovaTemplate {
        public static function command($moduleName, $commandName=null) {
            if(!$commandName) {
                $commandName = $moduleName . 'Command';
            }

            $commandContent = <<<PHP
            <?php

                namespace Module\\{$moduleName}\\Commands;

                use Devyuha\\Lunaris\\Traits\\Loggable;

                class {$commandName}
                {
                    use Loggable;

                    private string \$path;
                    private array \$args;

                    public function __construct(string \$path, array \$args = []) {
                        \$this->path = \$path;
                        \$this->args = \$args;
                    }

                    public function execute(): void {
                        // Write your command logic on execution
                        // Use \$args in your logic as needed
                        \$this->info("Command has been created");
                    }
                }
            PHP;

            return $commandContent;
        }
    }
