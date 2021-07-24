(function($){

    $(document).ready(function(){
        //TinyMce Editor
        tinymce.init({
            selector: '#mytextarea'
        });


        // Photo library Modal Script
        $('.thumbnails').click(function(){


            // Enabled Button
            $('#set_user_image').prop('disabled', false);
        });
    });

})(jQuery);