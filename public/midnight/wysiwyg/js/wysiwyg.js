/*global $, jQuery, CKEDITOR*/
$(function () {
    'use strict';

    CKEDITOR.disableAutoInline = true;

    CKEDITOR.stylesSet.add('default', [
        // Block-level styles
        { name: 'Seitenüberschrift', element: 'h1' },
        { name: 'Überschrift', element: 'h2' },
        { name: 'Kleine Überschrift', element: 'h3' },
        { name: 'Absatz', element: 'p' },
        { name: 'Umfließen', element: 'img', attributes: {'class': 'float'} },
        { name: 'Block', element: 'img', attributes: {'class': 'block'} }
    ]);

    $('[contenteditable=true]').each(function () {
        var $element = $(this);
        if (!$element.attr('id')) {
            $element.attr('id', 'wysiwyg-' + Math.round(Math.random() * 100000));
        }
        CKEDITOR.inline($element.attr('id'), {
            extraPlugins: 'midnightsave,imagebrowser',
            imageBrowser_listUrl: $element.data('images-url'),
            shiftEnterMode: CKEDITOR.ENTER_BR,
            toolbar: [
                ['Styles', 'Bold', 'Italic'],
                ['Link', 'Unlink'],
                ['BulletedList', 'NumberedList'],
                ['Image'],
                ['Undo', 'Redo'],
                ['MidnightSave']
            ],
            stylesSet: 'default',
            allowedContent: {
                a: {
                    attributes: 'href'
                },
                b: true,
                h1: true,
                h2: true,
                h3: true,
                h4: true,
                h5: true,
                h6: true,
                i: true,
                img: {
                    attributes: 'src, alt',
                    classes: 'float, block'
                },
                li: true,
                ol: true,
                p: true,
                ul: true
            }
        });
    });
});
