<?php

    use Devyuha\Lunaris\Http\Router;
    use Pecee\Http\Request;
    use Pecee\Http\Response;
    use Pecee\Http\Url;

    // ? View methods
    function view($path, $options = []) {
        $module = $options["module"] ?? "Main";
        $args = $options["args"] ?? [];
        $path = str_replace(".", "/", $path);
        $viewPath = "../modules/" . $module . "/views/" . $path . ".php";

        if(!file_exists($viewPath)) {
            throw new Exception("View file not found : {$viewPath}");
        }

        extract($args);
        ob_start();
        include($viewPath);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    function inject($path, $options = []) {
        $module = $options["module"] ?? "Main";
        $args = $options["args"] ?? [];
        $path = str_replace(".", "/", $path);
        $viewPath = "../modules/" . $module . "/views/" . $path . ".php";

        if(!file_exists($viewPath)) {
            throw new Exception("View file not found : {$viewPath}");
        }

        extract($args);
        ob_start();
        include($viewPath);
        $var = ob_get_contents();
        ob_end_clean();
        echo $var;
    }

    function is_module($moduleName) {
        try {
            $root = dirname(getcwd());
            $modules = require_once $root . "/config/modules.php";

            if(in_array($moduleName, $modules)) {
                return true;
            } else {
                return false;
            }
        } catch(Exception $e) {
            return false;
        }
    }

    // ? Router methods
    function route(?string $name = null, $parameters = null, ?array $getParams = null): Url
    {
        return Router::getUrl($name, $parameters, $getParams);
    }

    function response(): Response
    {
        return Router::response();
    }

    function request(): Request
    {
        return Router::request();
    }

    function input($index = null, $defaultValue = null, ...$methods)
    {
        if ($index !== null) {
            return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
        }

        return request()->getInputHandler();
    }

    function redirect(string $url, ?int $code = null): void
    {
        if ($code !== null) {
            response()->httpCode($code);
        }

        response()->redirect($url);
    }

    function csrf_token(): ?string
    {
        $baseVerifier = Router::router()->getCsrfVerifier();
        if ($baseVerifier !== null) {
            return $baseVerifier->getTokenProvider()->getToken();
        }

        return null;
    }

    function csrf_field(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '" />';
    }

    function server()
    {
        $host = $_SERVER['HTTP_HOST'];
        $proto = "http";
        if(isset($_SERVER['HTTP_X_ORIGINAL_HOST']) && !empty($_SERVER['HTTP_X_ORIGINAL_HOST'])) {
            $host = $_SERVER['HTTP_X_ORIGINAL_HOST'];
        }
        if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && !empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
            $proto = $_SERVER['HTTP_X_FORWARDED_PROTO'];
        }
        $host = $proto . "://" . $host;
        return $host;
    }

    function asset($string)
    {
        $enurl = server();
        $string = $enurl . "/public/" . $string;
        return $string;
    }

    function env($key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            $value = $_ENV[$key];
            return $value === false ? $default : $value;
        }
        return $default;
    }

    function base_path($path) {
        $root = "..";
        $path = $root . "/" . $path;
        return $path;
    }

    function public_path($path) {
        return base_path("public/" . $path);
    }

    function config($path) {
        return base_path("config/" . $path);
    }

    function app($var) {
        $root = dirname(getcwd());
        $config = require_once $root . '/config/app.php';

        return $config[$var] ?? NULL;
    }

    // ? Storage methods
    function storage_path($path) {
        $file = public_path("uploads/" . $path);
        return $file;
    }

    function storage_asset($string) {
        return asset("uploads/" . $string);
    }

    function storage_exists($path) {
        if(file_exists(storage_path($path))) {
            return true;
        }
        return false;
    }

    function storage_unlink($path) {
        if(storage_exists($path)) {
            unlink(storage_path($path));
            return true;
        }
        return false;
    }

    function fetchArgs(array $args) {
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
