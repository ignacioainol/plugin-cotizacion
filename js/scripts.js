(function ($) {
    $('.addCotizacion').on('click', function (e) {
        e.preventDefault()
        var idPost = $(this).attr('data-idpost');

        $.ajax({
            url: dcms_vars.ajaxurl,
            type: 'POST',
            data: {
                action: 'dcms_ajax_cotizacion',
                id_post: idPost
            },
            success: function (response) {
                console.log(response);
                alert("Item has been added into cotization");
            }
        })
    })
})(jQuery);