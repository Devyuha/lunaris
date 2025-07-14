<?php

    namespace Devyuha\Lunaris\Commands;

    use Devyuha\Lunaris\Utils\NovaTemplate as Template;

    class MakeCommand
    {
        private string $path;
        private array $args;

        public function __construct(string $path, array $args) {
            $this->path = $path;
            $this->args = $args;
        }

        public function execute(): void {
            $projectRoot = getcwd();
            $args = fetchArgs($this->args);

            $commandName = $args['name'];
            $moduleName = $args['module'] ?? 'Main';

            $content = Template::command($moduleName, $commandName);
            $modulePath = $projectRoot . "/modules/" . $moduleName;
            $commandFolderPath = $this->checkCommandsFolder($modulePath);
            if($commandFolderPath) {
                $this->generate($commandName, $content, $commandFolderPath);
            }
        }

        private function checkCommandsFolder($modulePath) {
            $commandFolderPath = $modulePath . "/Commands";

            if(!is_dir($commandFolderPath)) {
                if(mkdir($commandFolderPath, 0777, true)) {
                    echo "Commands folder has been created in {$modulePath}" . PHP_EOL;
                } else {
                    echo "Failed to create Commands folder in {$modulePath}" . PHP_EOL;
                    return false;
                }
            }

            return $commandFolderPath;
        }

        private function generate($name, $content, $path) {
            $commandFileName = $name . ".php";
            $commandFilePath = $path . "/" . $commandFileName;
            if(file_exists($commandFilePath)) {
                echo "Command: {$name} already exists in {$path}" . PHP_EOL;
                return false;
            }

            file_put_contents($commandFilePath, $content);

            echo $name . " has been created inside " . $path . PHP_EOL;
        }
    }
