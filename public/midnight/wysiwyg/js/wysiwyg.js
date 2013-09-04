$(function () {
    CKEDITOR.disableAutoInline = true;
    $('.wysiwyg').each(function () {
        $element = $(this);
        if (!$element.attr('id')) {
            $element.attr('id', 'wysiwyg-' + Math.round(Math.random() * 100000));
        }
        CKEDITOR.stylesSet.add('default',
            [
                // Block-level styles
                { name: 'Seitenüberschrift', element: 'h1' },
                { name: 'Überschrift', element: 'h2' },
                { name: 'Kleine Überschrift', element: 'h3' },
                { name: 'Absatz', element: 'p' },
                { name: 'Umfließen', element: 'img', attributes: {'class': 'float'} },
                { name: 'Block', element: 'img', attributes: {'class': 'block'} }
            ]
        );
        console.log($element.data('images-url'));
        CKEDITOR.inline($element.attr('id'), {
            extraPlugins: 'midnightsave,imagebrowser',
            imageBrowser_listUrl: $element.data('images-url'),
            shiftEnterMode: CKEDITOR.ENTER_BR,
            toolbar: [
                ['Styles', 'Bold', 'Italic'],
                ['Link', 'Unlink'],
                ['BulletedList', 'NumberedList'],
                ['Image'],
                ['MidnightSave'],
            ],
            stylesSet: 'default'
        });
    });
});