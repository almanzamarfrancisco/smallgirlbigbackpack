( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['travelbee-pro-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );

jQuery(document).ready(function($) {
    wp.customize.section( 'sidebar-widgets-featured' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-featured' ).priority( '30' );

    wp.customize.section( 'sidebar-widgets-about' ).panel( 'frontpage_settings' );
    wp.customize.section( 'sidebar-widgets-about' ).priority( '35' );

    wp.customize.panel( 'frontpage_settings', function( section ){
        section.expanded.bind( function( isExpanded ) {
            if( isExpanded ){
                wp.customize.previewer.previewUrl.set( travelbee_cdata.home );
            }
        });
    });

    //Scroll to home page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });


    function scrollToSection( section_id ){
        var preview_section_id = "banner_section";

        var $contents = jQuery('#customize-preview iframe').contents();

        switch( section_id ) {

            case 'accordion-section-header_settings':
            preview_section_id = "masthead";
            break;

            case 'accordion-section-header_image':
            preview_section_id = "banner_section";
            break;

            case 'accordion-section-sidebar-widgets-about':
            preview_section_id = "about-section";
            break;

            case 'accordion-section-sidebar-widgets-featured':
            preview_section_id = "featured-section";
            break;

            case 'accordion-section-cta':
            preview_section_id = "cta-section";
            break;
            
            case 'accordion-section-shop_settings':
            preview_section_id = "product-section";
            break;

        }

        if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
            $contents.find("html, body").animate({
            scrollTop: $contents.find( "#" + preview_section_id ).offset().top
            }, 1000);
        }
    }

    $( 'input[name=travelbee-flush-local-fonts-button]' ).on( 'click', function( e ) {
        var data = {
            wp_customize: 'on',
            action: 'travelbee_flush_fonts_folder',
            nonce: travelbee_cdata.flushFonts
        };  
        $( 'input[name=travelbee-flush-local-fonts-button]' ).attr('disabled', 'disabled');

        $.post( ajaxurl, data, function ( response ) {
            if ( response && response.success ) {
                $( 'input[name=travelbee-flush-local-fonts-button]' ).val( 'Successfully Flushed' );
            } else {
                $( 'input[name=travelbee-flush-local-fonts-button]' ).val( 'Failed, Reload Page and Try Again' );
            }
        });
    });
});