(function($){

    $(document).ready(function(){
        //TinyMce Editor
        tinymce.init({
            selector: '#mytextarea'
        });


        // Create some properties
        let user_href, user_href_splitted, user_id;
        let image_src, image_src_splitted, image_name;

        // Photo library Modal Script
        $('.modal_thumbnails').click(function(e){
            e.preventDefault();
            // Enabled Button
            $('#set_user_image').prop('disabled', false);

            // get user id form href attribute
            user_href = $('#user_id').prop('href');
            user_href_splitted = user_href.split('=');
            // user_id = user_href_splitted[1];
            user_id = user_href_splitted[user_href_splitted.length - 1];
            // alert(user_id);


            // get image name form img src attribute
            image_src = $(this).prop('src');
            image_src_splitted = image_src.split('/');
            image_name = image_src_splitted[image_src_splitted.length - 1];
            // alert(image_name);

            // sidebar modal
            let photo_id = $(this).attr('data');

            $.ajax({
                url: 'includes/ajax_code.php',
                data: {photo_id: photo_id},
                type: "POST",
                success: function(data){
                    $("#modal_sidebar").html(data);
                }
            });
   
        });


        // send ajax request for gallery
        $('#set_user_image').click(function(e){
            // alert(image_name);
            
            $.ajax({
                url: 'includes/ajax_code.php',
                data: {image_name: image_name, user_id: user_id},
                type: "POST",
                success: function(data){
                    if(!data.error){
                        $('.user_image_box a img').prop('src', data);


                        // location.reload();

                    }
                }
            });

        });


        // Edit photo sidebar
        $(".photo-info-box").click(function(e){
            $(".inside").slideToggle("fast");
            $("#toggle").toggleClass('glyphicon-menu-down glyphicon, glyphicon-menu-up');
        });

    });

})(jQuery);