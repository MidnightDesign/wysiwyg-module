<?php

namespace Midnight\Wysiwyg\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Wysiwyg extends AbstractHelper
{
    function __invoke($text)
    {
        $view = $this->getView();
        $basePath = $view->plugin('basePath');

        $headScript = $view->plugin('headScript');
        $headScript->appendFile($basePath('midnight/wysiwyg/vendor/ckeditor/ckeditor.js'));
        $headScript->appendFile($basePath('midnight/wysiwyg/js/wysiwyg.js'));

        $headLink = $view->plugin('headLink');
        $headLink->appendStylesheet($basePath('midnight/wysiwyg/css/wysiwyg.css'));

        return '<div'
        . ' contenteditable="true"'
        . '>'
        . $text
        . '</div>';
    }
}
