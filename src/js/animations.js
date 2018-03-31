( function( $ ) {
    $( document ).ready(function() {

        $( '.menu-search-button' ).click(function(){
            // if has class clicked
            if ( !$(this).hasClass('clicked') ){
                $(this).toggleClass( 'clicked' );
                $( '.menu-search' ).css({   
                                            'opacity': '1',
                                            'background-color': '#fff',
                                            'transform': 'translateX(1px)',
                                            'visibility': 'visible'
                                        });
            }
            else if ( $(this).hasClass('clicked') ){
                $(this).toggleClass( 'clicked' );
                $( '.menu-search' ).css({   
                                            'visibility': 'hidden',
                                            'background-color': 'beige',
                                            'opacity': '0',
                                            'transform': 'translateX(110%)'
                                        });
            }
        });
        
    });
} )( jQuery );

