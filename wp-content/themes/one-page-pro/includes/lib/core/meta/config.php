<?php 

class Layers_Meta_Config {

	public function meta_data(){

		// Post Meta
		$custom_meta['post'] = array(
			'title' => LAYERS_THEME_TITLE . __( ': Options' , 'one-page' ),
			'description' => __( '' , 'one-page' ), // @TODO
			'position' => 'normal',
			'custom-meta' => array(
				'media' => array(
					'title' => __( 'Rich Media' , 'one-page' ),
					'elements' => array(
						'video-url' => array(
							'label' => __( 'Video URL' , 'one-page' ),
							'description' => __( 'For use with <a href="' . esc_url( 'http://codex.wordpress.org/' ) . 'Embeds" target="_blank">oEmbed</a> supported media' , 'one-page' ),
							'type' => 'text',
						)
					)
				)
			)
		);

		// Page Meta we just emulate the post meta
		$custom_meta['page'] = $custom_meta['post'];

		return apply_filters( 'layers_custom_meta', $custom_meta );
	}
}