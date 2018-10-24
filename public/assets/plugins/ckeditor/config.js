/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'en';
	// config.uiColor = '#AADC6E';
    config.filebrowserImageBrowseUrl = '/filemanager?type=Images';
    config.filebrowserImageUploadUrl = '/filemanager/upload?type=Images&_token='+_token;
    config.filebrowserBrowseUrl = '/filemanager?type=Files';
    config.filebrowserUploadUrl = '/filemanager/upload?type=Files&_token='+_token;
    config.filebrowserWindowHeight = 500;
    config.allowedContent = true;
    // config.extraAllowedContent = 'span(*)';
    config.image_prefillDimensions = false;

    config.contentsCss = [
        // '/components/bootstrap/dist/css/bootstrap.min.css',
    ];
    config.fontawesomePath ='/components/font-awesome/css/font-awesome.css';
};
