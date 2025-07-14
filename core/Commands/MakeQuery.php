<?php

    namespace Devyuha\Lunaris\Commands;

    use Devyuha\Lunaris\Utils\PdoTemplate as Template;

    class MakeQuery {
        private string $path;
        private array $args;

        public function __construct(string $path, array $args) {
            $this->path = $path;
            $this->args = $args;
        }

        public function execute(): void {
            $args = Template::getArgs($this->args);
            $queryName= $args['name'];
            $moduleName = $args['module'] ?? 'Main';

            $content = Template::query($moduleName, $queryName);
            $modulePath = $this->path . "/modules/" . $moduleName;
            $queryFolderPath = $this->checkQueriesFolder($modulePath);
            if($queryFolderPath) {
                $this->generate($queryName, $content, $queryFolderPath);
            }
        }

        private function checkQueriesFolder($modulePath) {
            $folderPath = $modulePath . "/Queries";

            if(!is_dir($folderPath)) {
                if(mkdir($folderPath, 0777, true)) {
                    echo "Mails folder has been created in {$modulePath}." . PHP_EOL;
                } else {
                    echo "Failed to create Mails folder in {$modulePath}." . PHP_EOL;
                    return false;
                }
            }

            return $folderPath;
        }

        private function generate($name, $content, $path) {
            $queryFileName = $name . ".php";
            $queryFilePath = $path . "/" . $queryFileName;
            if(file_exists($queryFilePath)) {
                echo "{$name} already exists in {$path}" . PHP_EOL;
                return false;
            }

            file_put_contents($queryFilePath, $content);

            echo $name . " has been created in " . $path . PHP_EOL;
        }
    }
