(function($){

    $(document).ready(function(){
        //TinyMce Editor
        tinymce.init({
            selector: '#mytextarea'
        });


        // Create some properties
        let user_href, user_href_splitted, user_id;

        // Photo library Modal Script
        $('.thumbnails').click(function(){
            // Enabled Button
            $('#set_user_image').prop('disabled', false);

            // get user id form href attribute
            user_href = $('#user_id').prop('href');
            user_href_splitted = user_href.split('=');
            // user_id = user_href_splitted[1];
            user_id = user_href_splitted[user_href_splitted.length - 1];
            alert(user_id);
        });
    });

})(jQuery);