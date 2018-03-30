( function( $ ) {
    $( document ).ready(function() {
        $( '.menu-search' ).toggleClass( 'invisible' );

        $( '.menu-search-button' ).click(function(){
            $( '.menu-search' ).toggleClass( 'invisible' );
            $( '.menu-search' ).toggleClass( 'animated slideInRight' );
        });
    });
} )( jQuery );

