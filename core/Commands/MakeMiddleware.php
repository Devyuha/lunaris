<?php

    namespace Devyuha\Lunaris\Commands;

    use Devyuha\Lunaris\Utils\SecurityTemplate as Template;

    class MakeMiddleware
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

            $middlewareName = $args['name'];
            $moduleName = $args['module'] ?? 'Main';

            $content = Template::middleware($moduleName, $middlewareName);
            $modulePath = $projectRoot . "/modules/" . $moduleName;
            $middlewareFolderPath = $this->checkMiddlewaresFolder($modulePath);
            if($middlewareFolderPath) {
                $this->generate($middlewareName, $content, $middlewareFolderPath);
            }
        }

        private function checkMiddlewaresFolder($modulePath) {
            $folderPath = $modulePath . "/Middlewares";

            if(!is_dir($folderPath)) {
                if(mkdir($folderPath, 0777, true)) {
                    echo "Middlewares folder has been created in {$modulePath}." . PHP_EOL;
                } else {
                    echo "Failed to create Middlewares folder in {$modulePath}." . PHP_EOL;
                    return false;
                }
            }

            return $folderPath;
        }

        private function generate($name, $content, $path) {
            $middlewareFileName = $name . ".php";
            $middlewareFilePath = $path . "/" . $middlewareFileName;
            if(file_exists($middlewareFilePath)) {
                echo "{$name} already exists in {$path}" . PHP_EOL;
                return false;
            }

            file_put_contents($middlewareFilePath, $content);

            echo $name . " has been created in " . $path . PHP_EOL;
        }
    }
