'use strict';
 (function($){
    $(function(){
        if( $('.html-editor').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2
                }
            );
            var editor = wp.codeEditor.initialize( $('.html-editor'), editorSettings );
        }

        if( $('.js-editor').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'javascript',
                }
            );
            var editor = wp.codeEditor.initialize( $('.js-editor'), editorSettings );
        }

        if( $('.css-editor').length ) {
            var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
            editorSettings.codemirror = _.extend(
                {},
                editorSettings.codemirror,
                {
                    indentUnit: 2,
                    tabSize: 2,
                    mode: 'css',
                }
            );
            var editor = wp.codeEditor.initialize( $('.css-editor'), editorSettings );
        }
    });
 })(jQuery);