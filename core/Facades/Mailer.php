<?php

    namespace Devyuha\Lunaris\Facades;

    use Devyuha\Lunaris\Facades\Mail;
    use Exception;
    use Devyuha\Lunaris\Exceptions\MailNotSentException;

    class Mailer {
        private $mailInstance;
        private $args = [];

        public static function build(string $mailClass) {
            if(!class_exists($mailClass) || !is_subclass_of($mailClass, Mail::class)) {
                throw new Exception("Invalid mail class. It must extend the App\Facades\Mail\Mail class.");
            }

            $instance = new self();
            $instance->mailInstance = new $mailClass();
            return $instance;
        }

        public function args(array $args) {
            $this->args = $args;
            return $this;
        }

        public function send() {
            if(method_exists($this->mailInstance, 'handle')) {
                $this->mailInstance->handle($this->args);
            }

            try {
                $this->mailInstance->send();
                return;
            } catch (Exception $e) {
                throw new MailNotSentException($e->getMessage());
            }
        }
    }
