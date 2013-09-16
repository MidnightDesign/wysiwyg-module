<?php

namespace Midnight\Wysiwyg\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Renderer\PhpRenderer;

class Wysiwyg extends AbstractHelper
{
    static $defaultOptions = [
        'images_url' => null,
    ];

    function __invoke($text, $save_url, array $options = [])
    {
        if (isset($options['condition'])) {
            if (!$options['condition'] === true) {
                return $text;
            }
        }
        $options = $options + self::$defaultOptions;
        if (!$text) {
            $text = '<p></p>';
        }
        /** @var $renderer PhpRenderer */
        $renderer = $this->getView()->getEngine();
        $renderer->headScript()->appendFile($renderer->basePath('midnight/wysiwyg/vendor/ckeditor/ckeditor.js'));
        $renderer->headScript()->appendFile($renderer->basePath('midnight/wysiwyg/js/wysiwyg.js'));
        $renderer->headLink()->appendStylesheet($renderer->basePath('midnight/wysiwyg/css/wysiwyg.css'));
        return '<div class="wysiwyg" contenteditable="true" data-save-url="' . $save_url . '" data-images-url="' . $options['images_url'] . '">' . $text . '</div>';
    }
}
