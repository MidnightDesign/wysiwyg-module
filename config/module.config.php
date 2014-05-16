<?php

namespace Midnight\Wysiwyg;

return array(
    'wysiwyg' => array(
        'editor_config' => array(
            'styles' => array(
                array('name' => 'Page heading', 'element' => 'h1'),
                array('name' => 'Heading', 'element' => 'h2'),
                array('name' => 'Minor heading', 'element' => 'h3'),
                array('name' => 'Paragraph', 'element' => 'p'),
            ),
            'toolbar' => array(
                array('Styles', 'Bold', 'Italic'),
                array('Link', 'Unlink'),
                array('BulletedList', 'NumberedList'),
                array('Undo', 'Redo'),
                array('MidnightSave'),
            ),
            'allowed_content' => array(
                'a' => array(
                    'attributes' => 'href',
                ),
                'b' => true,
                'h1' => true,
                'h2' => true,
                'h3' => true,
                'i' => true,
                'li' => true,
                'ol' => true,
                'p' => true,
                'ul' => true,
            ),
        ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                realpath(__DIR__ . '/../public'),
            ),
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'wysiwyg' => __NAMESPACE__ . '\View\Helper\WysiwygFactory',
        ),
    ),
);
