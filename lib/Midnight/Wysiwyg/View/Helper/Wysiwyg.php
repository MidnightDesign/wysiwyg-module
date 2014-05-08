<?php

namespace Midnight\Wysiwyg\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Wysiwyg extends AbstractHelper
{
    /**
     * @var array
     */
    private $defaultAttributes = array(
        'contenteditable' => 'true'
    );

    function __invoke($text, array $attributes = array())
    {
        $attributes = $this->defaultAttributes + $attributes;

        $view = $this->getView();
        $basePath = $view->plugin('basePath');

        $headScript = $view->plugin('headScript');
        $headScript->appendFile($basePath('midnight/wysiwyg/vendor/ckeditor/ckeditor.js'));
        $headScript->appendFile($basePath('midnight/wysiwyg/js/wysiwyg.js'));

        $headLink = $view->plugin('headLink');
        $headLink->appendStylesheet($basePath('midnight/wysiwyg/css/wysiwyg.css'));

        $joinedAttributes = array();
        foreach ($attributes as $key => $val) {
            $joinedAttributes[] = $key . '="' . $val . '"';
        }
        if (!empty($joinedAttributes)) {
            $attributesString = ' ' . join(' ', $joinedAttributes);
        }

        return '<div' . $attributesString . '>' . $text . '</div>';
    }
}
