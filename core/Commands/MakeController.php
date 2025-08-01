<?php

    namespace Devyuha\Lunaris\Commands;

    use Devyuha\Lunaris\Utils\GeneralTemplate as Template;

    class MakeController
    {
        private string $path;
        private array $args;

        public function __construct(string $path, array $args) {
            $this->path = $path;
            $this->args = $args;
        }

        public function execute(): void {
            $projectRoot = getcwd();
            $args = Template::getArgs($this->args);

            $controllerName = $args['name'];
            $moduleName = $args['module'] ?? 'Main';

            $content = Template::controller($moduleName, $controllerName);
            $modulePath = $projectRoot . "/modules/" . $moduleName;
            $controllerFolderPath = $this->checkControllersFolder($modulePath);
            if($controllerFolderPath) {
                $this->generate($controllerName, $content, $controllerFolderPath);
            }
        }

        private function checkControllersFolder($modulePath) {
            $folderPath = $modulePath . "/Controllers";

            if(!is_dir($folderPath)) {
                if(mkdir($folderPath, 0777, true)) {
                    echo "Controllers folder has been created in {$modulePath}." . PHP_EOL;
                } else {
                    echo "Failed to create Controllers folder in {$modulePath}." . PHP_EOL;
                    return false;
                }
            }

            return $folderPath;
        }

        private function generate($name, $content, $path) {
            $controllerFileName = $name . ".php";
            $controllerFilePath = $path . "/" . $controllerFileName;
            if(file_exists($controllerFilePath)) {
                echo "{$name} already exists in {$path}" . PHP_EOL;
                return false;
            }

            file_put_contents($controllerFilePath, $content);

            echo $name . " has been created in " . $path . PHP_EOL;
        }
    }
