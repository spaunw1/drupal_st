(function ($) {
    Drupal.behaviors.ajax_example = {
        attach:function (context) {

            // If the site name is present set it to the username.
            if ($('#site-name', context).length) {
                $.ajax({
                    url: '/ajax/username',
                    success: function(data) {

                        // Change site name to current user name.
                        $('#site-name a span').html(data + '.com');
                    }
                });
            }
        }
    }
})(jQuery); 