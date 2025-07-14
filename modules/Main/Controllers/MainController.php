<?php

    namespace Module\Main\Controllers;

    use Devyuha\Lunaris\Http\Controller;
    use Devyuha\Lunaris\Facades\Pdo;
    use Module\Main\Queries\ListUsers;

    class MainController extends Controller {
        public function home() {            
            return view("home");
        }
    }
