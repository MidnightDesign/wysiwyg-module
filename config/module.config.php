<?php

namespace Midnight\Wysiwyg;

return [
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                realpath(__DIR__ . '/../public'),
            ),
        ),
    ),
    'view_helpers' => [
        'invokables' => [
            'wysiwyg' => __NAMESPACE__ . '\View\Helper\Wysiwyg',
        ],
    ],
];