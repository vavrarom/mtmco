<?php
/**
 * The functions.php for a theme, adding theme support for widget-customizer,
 * and registering a sidebar whose widgets maintain equal heights even when
 * widgets in the sidebar are updated via Customizer. This is for demonstration
 * purposes, and normally JS wouldn't be embedded in PHP.
 * @see http://wordpress.org/plugins/widget-customizer/
 */
/**
 * Without this, all changes to sidebars and widgets in the customizer cause a
 * full refresh of the preview. By opting-in to widget-customizer support, the
 * Widget Customizer plugin then knows that the theme is prepared for updating
 * the sidebars and widgets via the postMessage transport, dynamically updating
 * the elements via the DOM and not doing a full refresh.
 */
add_theme_support( 'widget-customizer' );
/**
 * Register a new sidebar which has dynamic layout
 */
register_sidebar( array(
	'name' => __( 'Equal Heights' ),
	'id' => 'equal-heights',
) );
/**
 * Note: This is not necessary because the 'widget-customizer' theme support by
 * default makes all sidebars live-previewable; if you need to prevent an entire
 * sidebar from being live-previewed (i.e. postMessage update transport), then
 * you can have this filter __return_false
 */
// add_filter( 'customizer_sidebar_widgets_live_previewable_masonry-layout', '__return_true' );
/**
 * Render a sidebar in the footer which we'll use to contain widgets that get
 * equal heights applied to them at initialization.
 */
add_action( 'wp_footer', function () {
	?>
	<?php if ( is_active_sidebar( 'equal-heights' ) ): ?>
		<div id="equal-heights" class="sidebar">
			<?php dynamic_sidebar( 'equal-heights' ); ?>
		</div>
	<?php endif; ?>
	<?php
} );
/**
 * Inject the JavaScript which runs the equal-heights logic on the sidebar,
 * and which will re-equalize the sidebar when it is updated.
 */
add_action( 'wp_footer', function () {
	wp_print_scripts( array( 'jquery' ) );
	?>
	<script>
	jQuery( function ( $ ) {
		/**
		 * Courtesy of http://jsfiddle.net/xBZjG/23/
		 */
		$.fn.equalHeights = function(base_height) {
			var itemsbatch = this;
			if (base_height === 0) {
				base_height = Math.max.apply(null, this.map(function() {
					return $(this).height();
				}).get());
			}
			itemsbatch.height(base_height);
			itemsbatch.each(function() {
				var elemToResize = this;
				$(elemToResize).find('img').load(function() {
					if (elemToResize.height > base_height) {
						itemsbatch.equalHeights(elemToResize.height);
					}
				});
			});
			return base_height;
		};
		/**
		 * Set up the button to be able to open the lightbox. This is just
		 * for a simple example for demonstration purposes. A smarter
		 * widget would rely on event delegation to not have to re-bind the
		 * event handlers whenever the widget is updated.
		 * @param widget_el
		 */
		var initialize_sidebar = function () {
			$( '#equal-heights > .widget' ).equalHeights( 0 );
		};
		// Invoke now at DOM ready
		initialize_sidebar();
		/**
		 * Now, if we're also in the customizer preview, add support for
		 * Widget Customizer to re-initialize sidebar when it is updated.
		 */
		if ( typeof wp !== 'undefined' && typeof wp.customize !== 'undefined' ) {
			wp.customize.bind( 'sidebar-updated', function ( sidebar_id ) {
				if ( 'equal-heights' === sidebar_id ) {
					initialize_sidebar();
				}
			} );
		}
	} );
	</script>
	<?php
} );
