<?php
/**
 * Plugin Name: Lightbox Widget
 * Description: Demonstrate how to add live-previewability to Widget Customizer for JS-powered widgets
 * Author: Weston Ruter, X-Team
 * Author URI: http://x-team.com/profile/weston-ruter/
 */
class Lightbox_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'lightbox',
			__( 'Lightbox', 'lightbox-widget' ),
			array(
				'description' => __( 'Displays a button which opens a lightbox to show the supplied content.', 'lightbox-widget' ),
				/**
				 * Opt-in widget for Widget Customizer live previews via postMessage
				 * transport. This indicates that live previews are supported.
				 */
				'customizer_support' => true,
			)
		);
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_script( 'colorbox', '//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.3/jquery.colorbox-min.js', array( 'jquery' ), false );
			wp_enqueue_style( 'colorbox', '//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.3/example1/colorbox.css', array(), false );
		} );
		/**
		 * Alternative method to the customizer_support widget option above to
		 * opt-in to customizer support.
		 */
		// add_filter( 'customizer_widget_live_previewable_lightbox', '__return_true' );
		/**
		 * Prepare to add support for the widget to be live-previewable
		 */
		add_action( 'wp_footer', array( $this, 'add_widget_behaviors' ) );
	}
	/**
	 * Inject the JavaScript for initializing the widget and re-initializing it
	 * when the widget is updated. Here the JS is rendered out to the page, but
	 * normally should be enqueued in a separate file.
	 * @action wp_footer
	 */
	public function add_widget_behaviors() {
		wp_print_scripts( array( 'jquery' ) )
		?>
		<script>
		jQuery( function ( $ ) {
			/**
			 * Set up the button to be able to open the lightbox. This is just
			 * for a simple example for demonstration purposes. A smarter
			 * widget would rely on event delegation to not have to re-bind the
			 * event handlers whenever the widget is updated.
			 * @param widget_el
			 */
			var initialize_widget = function ( widget_el ) {
				$( widget_el ).find( 'button' ).click( function (e) {
					e.stopPropagation();
					$.colorbox( {
						html: $( this ).data( 'content' ),
						width: '50%'
					} );
				} );
			};
			/**
			 * Initialize widgets upon DOM ready
			 */
			$( '.widget_lightbox' ).each( function () {
				initialize_widget( this );
			} );
			/**
			 * Now, if we're also in the customizer preview, add support for
			 * Widget Customizer to re-initialize widget when it is updated.
			 */
			if ( typeof wp !== 'undefined' && typeof wp.customize !== 'undefined' ) {
				wp.customize.bind( 'widget-updated', function ( widget_id ) {
					// We only care about the lightbox widget being updated here
					if ( ! /^lightbox-\d+/.test( widget_id ) ) {
						return;
					}
					// Re-initialize the widget
					var widget_el = $( '#' + widget_id );
					initialize_widget( widget_el );
					// Update the lightbox content if the lightbox is currently shown
					if ( $( '#colorbox' ).is( ':visible' ) ) {
						widget_el.find( 'button' ).click();
					}
				} );
			}
		} );
		</script>
		<?php
	}
	/**
	 * Convenience method so we don't have to check isset() to prevent array index not defined notices
	 * @param array $instance
	 * @return array
	 */
	public function instance_with_defaults( array $instance ) {
		return array_merge(
			array(
				'title' => __( 'Lightbox Widget', 'lightbox-widget' ),
				'content' => __( '(Empty)', 'lightbox-widget' ),
			),
			array_filter( $instance )
		);
	}
	/**
	 * @param array $instance
	 * @return void
	 */
	public function form( $instance ) {
		$instance = $this->instance_with_defaults( $instance );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'lightbox-widget' ) ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"  name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance["title"] ) ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php esc_html_e( 'Content:', 'lightbox-widget' ) ?></label><br>
			<textarea id="<?php echo $this->get_field_id( 'content' ); ?>"  name="<?php echo $this->get_field_name( 'content' ); ?>"><?php echo esc_textarea( $instance["content"] ) ?></textarea>
		</p>
		<?php
	}
	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$instance = $this->instance_with_defaults( $instance );
		extract( $args );
		echo $before_widget;
		echo $before_title;
		echo apply_filters( 'widget_title', $instance['title'] );
		echo $after_title;
		$content = apply_filters( 'the_content', $instance['content'] );
		?>
		<p>
			<button type="button" type="button" data-content="<?php echo esc_attr( $content ) ?>"><?php esc_html_e( 'Open Lightbox', 'lightbox-widget' ) ?></button>
		</p>
		<?php
		echo $after_widget;
	}
}
add_action( 'widgets_init', function () {
	register_widget( 'Lightbox_Widget' );
} );
