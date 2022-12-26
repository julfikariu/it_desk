/*===================================================================================================

 - TEMPLATE : PROTOTIPO
 - DESCRIPTION : MODERN BOOTSTRAP 4 ADMIN TEMPLATE - FULLY RESPONSIVE
 - AUTHOR : SNAZZYSHEET (http://www.snazzysheet.com/)
 - VERSION : 1.0
 - FILE : FORM SUMMERNOTE JS

 ===================================================================================================*/

$(document).ready(function () {

    //---------------------------------------------------------------------------------------------
    // - SUMMERNOTE INIT --------------------------------------------------------------------------
    //---------------------------------------------------------------------------------------------
    $('#summernote').summernote({
        placeholder: 'Write description here................',
        minHeight: 350,
        maxHeight: 350,
        lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview']]
        ],
    });

});

