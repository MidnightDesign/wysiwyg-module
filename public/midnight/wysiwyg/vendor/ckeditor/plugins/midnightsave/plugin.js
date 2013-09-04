(function () {
    'use strict';
    CKEDITOR.plugins.add('midnightsave', {
        init: function (editor) {
            var $editor = $(editor.element.$);
            editor.on('change', function() {
                $editor.addClass('dirty');
            });
            editor.addCommand('midnightSave', {
                exec: function (editor) {
                    $editor.addClass('saving');
                    $.ajax($editor.data('save-url'), {
                        type: 'post',
                        data: { text: editor.getData() },
                        complete: function() {
                            $editor.removeClass('saving');
                        },
                        success: function() {
                            $editor
                                .removeClass('dirty')
                                .addClass('saved');
                            setTimeout(function() {
                                $editor.removeClass('saved');
                            }, 2000);
                        },
                        error: function() {
                        }
                    });
                }
            });
            editor.ui.addButton('MidnightSave', {
                label: 'Text speichern',
                command: 'midnightSave'
            });
        }
    });
}());