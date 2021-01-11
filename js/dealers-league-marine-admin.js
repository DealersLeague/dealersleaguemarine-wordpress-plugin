(function($){

    $(document).on('click', '#dealers_league_marine_refresh_listings', function(event) {
        // Show loading icon and block UI
        $('#dealers_league_marine_refresh_listings').attr('disabled', true);
        $(document).find('.refresh-result').remove();
        $.ajax({
            url : ajaxurl, // AJAX handler
            data : {action:'dealers-league-marine_refresh_listings'},
            type : 'POST',
            success : function( data ){
                console.log(data);
                if ( data.status === 'OK') {
                    $('#dealers_league_marine_refresh_listings').parent().append(data.html);
                } else {
                    $('#dealers_league_marine_refresh_listings').parent().append('<span class="refresh-result" style="color: #FF0000;margin-left:5px;">'+data.message+'</span>');
                }

            },
            error: function(data) {
                console.log(data);
            },
            complete: function( data ) {
                $('#dealers_league_marine_refresh_listings').attr('disabled', false);
            }
        });
    });

    $(document).on('click', '#dealers_league_marine_view_listings', function(event) { 
        window.location.href='/wp-admin/edit.php?post_type=boat';
    });

})(jQuery);

