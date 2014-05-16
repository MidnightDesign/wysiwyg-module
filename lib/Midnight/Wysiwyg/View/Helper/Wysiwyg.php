<?php

namespace Midnight\Wysiwyg\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\BasePath;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\InlineScript;

class Wysiwyg extends AbstractHelper
{
    /**
     * @var array
     */
    private $defaultAttributes = array(
        'contenteditable' => 'true',
    );

    /**
     * @var bool
     */
    private $stylesetIsRegistered = false;
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    function __invoke($text, array $attributes = array())
    {
        $attributes = $this->defaultAttributes + $attributes;

        $view = $this->getView();
        $basePath = $this->getBasePath($view);

        $inlineScript = $this->getInlineScript($view);
        $inlineScript->appendFile($basePath('midnight/wysiwyg/vendor/ckeditor/ckeditor.js'));

        $headLink = $this->getHeadLink($view);
        $headLink->appendStylesheet($basePath('midnight/wysiwyg/css/wysiwyg.css'), 'screen', null, null);

        if (empty($attributes['id'])) {
            $attributes['id'] = uniqid('wysiwyg-');
        }

        $this->registerStyleset();
        $inlineScript->appendScript($this->getScript($attributes['id']));

        $joinedAttributes = array();
        foreach ($attributes as $key => $val) {
            $joinedAttributes[] = $key . '="' . $val . '"';
        }
        $attributesString = '';
        if (!empty($joinedAttributes)) {
            $attributesString = ' ' . join(' ', $joinedAttributes);
        }

        return '<div' . $attributesString . '>' . $text . '</div>';
    }

    /**
     * @return InlineScript
     */
    private function getInlineScript()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getView()->plugin('inlineScript');
    }

    /**
     * @return BasePath
     */
    private function getBasePath()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getView()->plugin('basePath');
    }

    /**
     * @return HeadLink
     */
    private function getHeadLink()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getView()->plugin('headLink');
    }

    private function getScript($id)
    {
        $toolbar = json_encode($this->getToolbar());
        $allowedContent = json_encode($this->getAllowedContent());

        return <<<JS
$(function () {
    'use strict';

    CKEDITOR.disableAutoInline = true;

    CKEDITOR.inline('{$id}', {
        extraPlugins: 'midnightsave',
        shiftEnterMode: CKEDITOR.ENTER_BR,
        toolbar: {$toolbar},
        stylesSet: 'default',
        allowedContent: {$allowedContent}
    });
});
JS;

    }

    private function registerStyleset()
    {
        if ($this->stylesetIsRegistered === true) {
            return;
        }

        $styles = json_encode($this->getStyles());

        $script = "$(function() { CKEDITOR.stylesSet.add('default', {$styles}); }());";

        $this->getInlineScript()->appendScript($script);
        $this->stylesetIsRegistered = true;
    }

    private function getStyles()
    {
        $config = $this->getEditorConfig();
        $styles = array();
        foreach ($config['styles'] as $style) {
            $styles[] = $style;
        }
        return $styles;
    }

    private function getToolbar()
    {
        $config = $this->getEditorConfig();
        return $config['toolbar'];
    }

    private function getAllowedContent()
    {
        $config = $this->getEditorConfig();
        return $config['allowed_content'];
    }

    private function getEditorConfig()
    {
        $config = $this->getConfig();
        return $config['editor_config'];
    }

    private function getConfig()
    {
        return $this->config;
    }
}
