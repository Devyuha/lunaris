<?php

    namespace Devyuha\Lunaris;

    use splitbrain\phpcli\CLI;
    use splitbrain\phpcli\Options;

    class Kernel extends CLI
    {
        private array $commands;
        private $path;

        public function __construct($path) {
            parent::__construct();
            $this->path = $path;
            $this->fetchCommands();
        }

        private function fetchCommands() {
            $file = require $this->path . '/config/commands.php';
            $commands = $this->loadCommands($file);
            $providerCommands = $this->loadProviders($file);

            $this->commands = array_merge($commands, $providerCommands);
        }

        private function loadCommands($file) {
            return $file['commands'] ?? [];
        }

        private function loadProviders($file) {
            $providers = $file['providers'] ?? [];
            $allCommands = [];
            if(count($providers) > 0) {
                foreach($providers as $provider) {
                    if(method_exists($provider, 'getCommands')) {
                        $commands = (new $provider())->getCommands();
                        if(count($commands) > 0) {
                            $allCommands = array_merge($allCommands, $commands);
                        }
                    }
                }
            }
            return $allCommands;
        }

        protected function setup(Options $options) {
            $options->setHelp('A custom CLI application');
            foreach($this->commands as $command => $class) {
                $options->registerCommand($command, "Run the $command command");
            }
        }

        protected function main(Options $options) {
            $command = $options->getCmd();
            if(!$command) {
                $this->error("No command provided. Use --help for a list of commands available.");
                return;
            }

            if(!isset($this->commands[$command])) {
                $this->error("Unknown command: $command");
                return;
            }

            $class = $this->commands[$command];
            $args = $options->getArgs();

            if(!class_exists($class)) {
                $this->error("Command class not found: $class");
                return;
            }

            $instance = new $class($this->path, $args);
            if(!method_exists($instance, "execute")) {
                $this->error("Command class must have an execute() method.");
                return;
            }

            $instance->execute();
        }
    }
