<?php

    namespace Devyuha\Lunaris\Scripts;

    class Publish
    {
        public static function execute(): void {
            $instance = new Static();
            $instance->copyCli();
            $instance->copyCommandsFile();
        }

        private function copyCli(): void {
            $projectRoot = getcwd();
            $source = __DIR__."/../dump/nova";
            $destination = $projectRoot . "/nova";

            echo "Installing Nova...\n";

            if (!file_exists($source)) {
                echo "Source file not found: {$source}\n";
                return;
            }
    
            if (file_exists($destination)) {
                echo "Destination file already exists: {$destination}\n";
                return;
            }
    
            if (!copy($source, $destination)) {
                echo "Failed to copy file to {$destination}\n";
                return;
            }
    
            echo "Nova installed successfully to {$destination}\n";
        }

        private function copyCommandsFile(): void {
            $projectRoot = getcwd();
            $source = __DIR__."/../dump/commands.php";
            $destination = $projectRoot . "/config/commands.php";

            echo "Publishing commands config..." . PHP_EOL;

            if (!file_exists($source)) {
                echo "Source file not found: {$source}\n";
                return;
            }
    
            if (file_exists($destination)) {
                echo "Destination file already exists: {$destination}\n";
                return;
            }
    
            if (!copy($source, $destination)) {
                echo "Failed to copy file to {$destination}\n";
                return;
            }

            echo "Commands file published successfully to {$destination}\n";
        }
    }
