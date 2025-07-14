<?php

    namespace Devyuha\Lunaris\Http;

    use Pecee\Http\Middleware\BaseCsrfVerifier;
    use Devyuha\Lunaris\Http\SessionTokenProvider;

    class CsrfVerifier extends BaseCsrfVerifier {
        protected array $except = ["/api/*"];

        public function __construct() {
            $this->setTokenProvider(new SessionTokenProvider());
        }

        public function validateToken(string $token) {
            //
        }
    }
