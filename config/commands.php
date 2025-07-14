<?php

    return [
        "commands" => [
            //
        ],
        "providers" => [
            Devyuha\Lunaris\Providers\NovaProvider::class,
            Devyuha\Lunaris\Providers\FrameworkProvider::class,
            Devyuha\Lunaris\Providers\SecurityProvider::class,
            Devyuha\Lunaris\Providers\MailerProvider::class,
            Devyuha\Lunaris\Providers\PdoProvider::class
        ]
    ];
