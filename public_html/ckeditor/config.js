/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
CKEDITOR.editorConfig = function( config ) {
  config.toolbar  = [
    ['Font', 'FontSize'],
    ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat'],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'Undo', 'Redo'],
    ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'],
    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    ['Link', 'Unlink', 'Table', 'HorizontalRule', 'SpecialChar'],
    ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote'],
    ['Maximize']
  ];

  //config.removeButtons = 'Table';
  config.format_tags = 'p;h1;h2;h3;pre';
  config.removeDialogTabs = 'image:advanced;link:advanced';
  config.language = 'pt_br';
  config.extraPlugins = 'imgbrowse,font,richcombo,floatpanel,panel,listblock,button';
  config.filebrowserImageUploadUrl = "/ckeditor/plugins/imgupload/imgupload.php";
  config.filebrowserImageBrowseUrl = '/ckeditor/plugins/imgbrowse/imgbrowse.html';
};
