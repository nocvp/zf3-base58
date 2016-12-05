<?php

namespace Base58;

use Base58\Service\Base58Service;
use Base58\Service\Factory\Base58ServiceFactory;

return [
    'base58' => [
        'alphabet' => '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ'
    ],
    'service_manager' => [
        'aliases' => [
            'base58' => Base58Service::class,
        ],
        'factories' => [
            Base58Service::class => Base58ServiceFactory::class,
        ],
    ],
];