$(function() {
    'use strict';


    // if ($(".tinymceExample").length) {
    //   tinymce.init({
    //     selector: '.tinymceExample',
    //     height: 200,
    //     theme: 'silver',
    //     plugins: [
    //       'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    //       'searchreplace wordcount visualblocks visualchars code fullscreen',
    //       'contextmenu paste' // Include 'contextmenu' and 'paste' plugins
    //     ],
    //     toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    //     toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
    //     image_advtab: true,
    //     templates: [{
    //         title: 'Test template 1',
    //         content: 'Test 1'
    //       },
    //       {
    //         title: 'Test template 2',
    //         content: 'Test 2'
    //       }
    //     ],
    //     content_css: [],
    //     contextmenu: "paste | link image inserttable | cell row column deletetable", // Customize the context menu
    //   });
    // }

    $('.tinymceExample').summernote({
        placeholder: 'You can write here...',
        tabsize: 2,
        height: 100
      });

  });
