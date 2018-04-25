

jQuery(document).ready(function($){

	/**
	* 1 - Curreny Slide Focussing
	*/
	$(document).on( 'focus click' , 'ul[id^="slide_list_"] li a.layers-accordion-title, ul[id^="slide_list_"] li input', function(e){

		// Set focus slide
		$widget = $(this).closest( '.widget' );
		$li = $(this).closest( 'li.layers-accordion-item' );

		if( undefined !== $li.data('guid') ){
			$slide_index = $li.index();
			$slide_guid = $li.data('guid');
			layers_set_slide_index( $widget, $slide_index, $slide_guid );
		}
	});

	function layers_set_slide_index( $widget, $slide_index, $slide_guid ){
		if( undefined !== $widget ){
			$widget.find( 'input[data-focus-slide="true"]' ).val( $slide_index );
		}
	}

	/**
	* 2 - Slide Title Update
	*/

	$(document).on( 'keyup' , 'ul[id^="slide_list_"] input[id*="-title"]' , function(e){

		// "Hi Mom"
		$that = $(this);

		// Set the string value
		$val = $that.val().toString().substr( 0 , 51 );

		// Set the Title
		$string = ': ' + ( $val.length > 50 ? $val + '...' : $val );

		// Update the accordian title
		$that.closest( '.layers-accordion-item' ).find( 'span.layers-detail' ).text( $string );
	});

}); //jQuery