<?php 

class Layers_Design_Controller {

	/**
	* Generate Design Options
	*
	* @param    string     $type       Sidebar type, side/top
	* @param    array       $this->widget     Widget object (for name, id, etc)
	* @param    array       $instance   Widget $instance
	* @param    array       $components Array of standard components to support
	* @param    array       $custom_components Array of custom components and elements
	*/

	public function __construct( $type = 'side' , $widget = NULL, $instance = array(), $components = array( 'columns' , 'background' , 'imagealign' ) , $custom_components = array() ) {

		// Initiate Widget Inputs
		$this->form_elements = new Layers_Form_Elements();

		// If there is no widget information provided, can the operation
		if( NULL == $widget ) return;
		$this->widget = $widget;

		// Set type side | top
		$this->type = $type;

		// Set widget values as an object ( we like working with objects )
		if( empty( $instance ) ) {
			$this->values = array( 'design' => NULL );
		} elseif( isset( $instance[ 'design' ] ) ) {
			$this->values = $instance[ 'design' ];
		} else {
			$this->values = NULL;
		}

		// Setup the components for use
		$this->components = $components;
		$this->custom_components = $custom_components;

		// Setup the controls
		$this->setup_controls();

		// Fire off the design bar
		$this->render_design_bar();

	}

	public function render_design_bar() {

		$container_class = array();
		$container_class[] = 'layers-design-bar';
		$container_class[] = ( 'side' == $this->type ? 'layers-design-bar-right' : 'layers-design-bar-horizontal' );
		$container_class[] = ( 'side' == $this->type ? 'layers-pull-right' : 'layers-visuals-horizontal' );
		$container_class[] = 'layers-visuals';
		?>
		<div class="<?php echo esc_attr( implode( ' ', $container_class ) ); ?>">
			<div class="layers-visuals-title">
				<span class="icon-settings layers-small"></span>
			</div>
			<ul class="layers-design-bar-nav layers-visuals-wrapper layers-clearfix">
				<?php // Render Design Controls
				$this->render_controls(); ?>
				<?php // Show trash icon (for use when in an accordian)
//				$this->render_trash_control(); ?>
			</ul>
		</div>
	<?php }

	private function setup_controls() {

		$this->controls = array();

		foreach( (array) $this->components as $component_key => $component_value ) {

			if ( is_array( $component_value ) ) {

				// This case allows for overriding of existing Design Bar Component types, and the creating of new custom Components.
				$method = "{$component_key}_component";

				if ( method_exists( $this, $method ) ) {

					// This is the overriding existing component case.
					ob_start();
					$this->$method( $component_value );
					$this->controls[] = trim( ob_get_clean() );
				}
				else {

					// This is the creating of new custom component case.
					ob_start();
					$this->custom_component(
						$component_key, // Give the component a key (will be used as class name too)
						$component_value // Send through the inputs that will be used
					);
					$this->controls[] = trim( ob_get_clean() );
				}
			}
			elseif ( 'custom' === $component_value && !empty( $this->custom_components ) ) {

				// This case is legacy - the old method of creating custom components.
				foreach ( $this->custom_components as $key => $custom_component_args ) {

					ob_start();
					$this->custom_component(
						$key, // Give the component a key (will be used as class name too)
						$custom_component_args // Send through the inputs that will be used
					);
					$this->controls[] = trim( ob_get_clean() );
				}
			}
			elseif ( method_exists( $this, "{$component_value}_component" ) ) {

				// This is the standard method of calling a component that already exists
				$method = "{$component_value}_component";

				ob_start();
				$this->$method();
				$this->controls[] = trim( ob_get_clean() );
			}
		}

	}

	private function render_controls(){

		// If there are no controls to render, do nothing
		if( empty( $this->controls ) ) return;

		echo implode( '', $this->controls );
	}

	/**
	* Custom Compontent
	*
	* @param    string     $key        Simply the key and classname for the icon,
	* @param    array       $args       Component arguments, including the form items
	*/

	public function render_control( $key = NULL, $args = array() ){

		if( empty( $args ) ) return;

		// Setup variables from $args
		$icon_css = $args[ 'icon-css' ];
		$label = $args[ 'label' ];
		$menu_wrapper_class = ( isset( $args[ 'wrapper-class' ] ) ? $args[ 'wrapper-class' ] : 'layers-pop-menu-wrapper layers-content-small' );

		// Add a fallback to the elements arguments
		$element_args = ( isset( $args[ 'elements' ] ) ? $args[ 'elements' ] : array() );

		// Return filtered element array
		$elements = apply_filters( 'layers_design_bar_' . $key . '_elements', $element_args );

		if( isset( $this->widget[ 'widget_id' ] ) ){
			$elements = apply_filters(
					'layers_design_bar_' . $key . '_' . $this->widget[ 'widget_id' ] . '_elements',
					$elements,
					$this
				);
		} ?>

		<li class="layers-design-bar-nav-item layers-visuals-item">
			<a href="" class="layers-icon-wrapper">
				<span class="<?php echo esc_attr( $icon_css ); ?>"></span>
				<span class="layers-icon-description">
					<?php echo $label; ?>
				</span>
			</a>
			<?php if( isset( $elements ) ) { ?>
				<div class="<?php echo esc_attr( $menu_wrapper_class ); ?>">
					<div class="layers-pop-menu-setting">
						<?php foreach( $elements as $key => $form_args ) { ?>
						   <?php echo $this->render_input( $form_args ); ?>
						<?php } ?>
					</div>
				</div>
			<?php } // if we have elements ?>
		</li>
	<?php }

	private function render_trash_control(){

		if( isset( $this->widget['show_trash'] ) ) { ?>
		<li class="layers-visuals-item layers-pull-right">
			<a href="" class="layers-icon-wrapper layers-icon-error">
				<span class="icon-trash" data-number="<?php echo $this->widget['number']; ?>"></span>
			</a>
		</li>
	<?php }
	}


	/**
	 * Load input HTML
	 *
	 * @param    array       $array()    Existing option array if exists (optional)
	 * @return   array       $array      Array of options, all standard DOM input options
	 */
	public function render_input( $form_args = array() ) {

		// If input-class then set it to 'class' arg that the form->input expects.
		if ( isset( $form_args['input-class'] ) ) {
			$form_args['class'] = $form_args['input-class'];
		}

		$data_show_if = array();
		if ( isset( $form_args['data']['show-if-selector'] ) ){
			$data_show_if['show-if-selector'] = 'data-show-if-selector="' . esc_attr( $form_args['data']['show-if-selector'] ) . '"';
			unset( $form_args['data']['show-if-selector'] );
		}
		if ( isset( $form_args['data']['show-if-value'] ) ) {
			$data_show_if['show-if-value'] = 'data-show-if-value="' . esc_attr( $form_args['data']['show-if-value'] ) . '"';
			unset( $form_args['data']['show-if-value'] );
		}
		if ( isset( $form_args['data']['show-if-operator'] ) ) {
			$data_show_if['show-if-operator'] = 'data-show-if-operator="' . esc_attr( $form_args['data']['show-if-operator'] ) . '"';
			unset( $form_args['data']['show-if-operator'] );
		}
		
		// Prep Class
		$class = array();
		$class[] = 'layers-form-item';
		$class[] = 'layers-' . $form_args['type'] . '-wrapper';
		$class[] = 'layers-design-bar-form-item';
		if ( isset( $form_args['class'] ) ) {
			// Grab the class if specified.
			$class[] = $form_args['class'];
			unset( $form_args['class'] );
		}
		?>
		<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>" <?php echo implode( ' ', $data_show_if ); ?> >

			<?php if ( 'checkbox' != $form_args['type'] && isset( $form_args['label'] ) && '' != $form_args['label'] ) { ?>
				<label><?php echo esc_html( $form_args['label'] ); ?></label>
			<?php } ?>

			<?php if ( isset( $form_args['wrapper'] ) ) { ?>
				<<?php echo $form_args['wrapper']; ?> <?php if ( $form_args['wrapper-class'] ) echo 'class="' . $form_args['wrapper-class'] . '"'; ?>>
			<?php } ?>

			<?php echo $this->form_elements->input( $form_args ); ?>

			<?php if ( isset( $form_args['wrapper'] ) ) { ?>
				</<?php echo $form_args['wrapper']; ?>>
			<?php } ?>

			<?php if ( isset( $form_args['description'] ) ) { ?>
				<div class="layers-form-item-description"><?php echo $form_args['description']; ?></div>
			<?php } ?>

		</div>
		<?php
	}

	/**
	 * Layout Options
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function layout_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'layout';

		// Setup icon CSS
		$defaults['icon-css'] = ( isset( $this->values['layout'] ) && NULL != $this->values ? 'icon-' . $this->values['layout'] : 'icon-layout-fullwidth' );

		// Add a Label
		$defaults['label'] = __( 'Layout', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-small';

		// Add elements
		$defaults['elements'] = array(
			'layout' => array(
				'type' => 'select-icons',
				'name' => $this->get_layers_field_name( 'layout' ),
				'id' => $this->get_layers_field_id( 'layout' ),
				'value' => ( isset( $this->values['layout'] ) ) ? $this->values['layout'] : NULL,
				'options' => array(
					'layout-boxed' => __( 'Boxed', 'one-page' ),
					'layout-fullwidth' => __( 'Full Width', 'one-page' )
				)
			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_layout_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * List Style - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function liststyle_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'liststyle';

		// Setup icon CSS
		$defaults['icon-css'] = ( isset( $this->values['liststyle'] ) && NULL != $this->values ? 'icon-' . $this->values['liststyle'] : 'icon-list-masonry' );

		// Add a Label
		$defaults['label'] = __( 'List Style', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-small';

		// Add elements
		$defaults['elements'] = array(
			'liststyle' => array(
				'type' => 'select-icons',
				'name' => $this->get_layers_field_name( 'liststyle' ),
				'id' => $this->get_layers_field_id( 'liststyle' ),
				'value' => ( isset( $this->values['liststyle'] ) ) ? $this->values['liststyle'] : NULL,
				'options' => array(
					'list-grid' => __( 'Grid', 'one-page' ),
					'list-list' => __( 'List', 'one-page' ),
					'list-masonry' => __( 'Masonry', 'one-page' )
				)
			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_liststyle_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Columns - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function columns_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'columns';

		// Setup icon CSS
		$defaults['icon-css'] = 'icon-columns';

		// Add a Label
		$defaults['label'] = __( 'Columns', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-content-small';

		// Add elements
		$defaults['elements'] = array(
			'columns' => array(
				'type' => 'select',
				'label' => __( 'Columns', 'one-page' ),
				'name' => $this->get_layers_field_name( 'columns' ),
				'id' => $this->get_layers_field_id( 'columns' ),
				'value' => ( isset( $this->values['columns'] ) ) ? $this->values['columns'] : NULL,
				'options' => array(
					'1' => __( '1 Column', 'one-page' ),
					'2' => __( '2 Columns', 'one-page' ),
					'3' => __( '3 Columns', 'one-page' ),
					'4' => __( '4 Columns', 'one-page' ),
					'6' => __( '6 Columns', 'one-page' )
				)
			),
			'color' => array(
				'type' => 'color',
				'label' => __( 'Background Color', 'one-page' ),
				'name' => $this->get_layers_field_name( 'column-background-color' ),
				'id' => $this->get_layers_field_id( 'columns-background-color' ),
				'value' => ( isset( $this->values['column-background-color'] ) ) ? $this->values['column-background-color'] : NULL
			),
			'gutter' => array(
				'type' => 'checkbox',
				'label' => __( 'Gutter', 'one-page' ),
				'name' => $this->get_layers_field_name( 'gutter' ),
				'id' => $this->get_layers_field_id( 'gutter' ),
				'value' => ( isset( $this->values['gutter'] ) ) ? $this->values['gutter'] : NULL
			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_columns_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Text Align - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function textalign_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'textalign';

		// Setup icon CSS
		$defaults['icon-css'] = ( isset( $this->values['textalign'] ) && NULL != $this->values ? 'icon-' . $this->values['textalign'] : 'icon-text-center' );

		// Add a Label
		$defaults['label'] = __( 'Text Align', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-content-small';

		// Add elements
		$defaults['elements'] = array(
			'textalign' => array(
				'type' => 'select-icons',
				'name' => $this->get_layers_field_name( 'textalign' ),
				'id' => $this->get_layers_field_id( 'textalign' ),
				'value' => ( isset( $this->values['textalign'] ) ) ? $this->values['textalign'] : NULL,
				'options' => array(
					'text-left' => __( 'Left', 'one-page' ),
					'text-center' => __( 'Center', 'one-page' ),
					'text-right' => __( 'Right', 'one-page' ),
					'text-justify' => __( 'Justify', 'one-page' )
				)
			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_textalign_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Image Align - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function imagealign_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'imagealign';

		// Setup icon CSS
		$defaults['icon-css'] = ( isset( $this->values['imagealign'] ) && NULL != $this->values ? 'icon-' . $this->values['imagealign'] : 'icon-image-left' );

		// Add a Label
		$defaults['label'] = __( 'Image Align', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-small';

		// Add elements
		$defaults['elements'] = array(
			'imagealign' => array(
				'type' => 'select-icons',
				'name' => $this->get_layers_field_name( 'imagealign' ),
				'id' => $this->get_layers_field_id( 'imagealign' ),
				'value' => ( isset( $this->values['imagealign'] ) ) ? $this->values['imagealign'] : NULL,
				'options' => array(
					'image-left' => __( 'Left', 'one-page' ),
					'image-right' => __( 'Right', 'one-page' ),
					'image-top' => __( 'Top', 'one-page' )
				)
			),
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_imagealign_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Featured Image - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function featuredimage_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'featuredimage';

		// Setup icon CSS
		$defaults['icon-css'] = 'icon-featured-image';

		// Add a Label
		$defaults['label'] = __( 'Featured Image', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-content-small';

		// Add elements
		$defaults['elements'] = array(
			'featuredimage' => array(
				'type' => 'image',
				'label' => __( 'Featured Image', 'one-page' ),
				'name' => $this->get_layers_field_name( 'featuredimage' ),
				'id' => $this->get_layers_field_id( 'featuredimage' ),
				'value' => ( isset( $this->values['featuredimage'] ) ) ? $this->values['featuredimage'] : NULL
			),
			'featuredvideo' => array(
				'type' => 'text',
				'label' => __( 'Video URL (oEmbed)', 'one-page' ),
				'name' => $this->get_layers_field_name( 'featuredvideo' ),
				'id' => $this->get_layers_field_id( 'featuredvideo' ),
				'value' => ( isset( $this->values['featuredvideo'] ) ) ? $this->values['featuredvideo'] : NULL
			),
			'imageratios' => array(
				'type' => 'select-icons',
				'name' => $this->get_layers_field_name( 'imageratios' ),
				'id' => $this->get_layers_field_id( 'imageratios' ),
				'value' => ( isset( $this->values['imageratios'] ) ) ? $this->values['imageratios'] : NULL,
				'options' => array(
					'image-portrait' => __( 'Portrait', 'one-page' ),
					'image-landscape' => __( 'Landscape', 'one-page' ),
					'image-square' => __( 'Square', 'one-page' ),
					'image-no-crop' => __( 'None', 'one-page' ),
					'image-round' => __( 'Round', 'one-page' ),
				),
				'wrapper' => 'div',
				'wrapper-class' => 'layers-icon-group layers-icon-group-outline'
			),
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_featuredimage_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Image Size - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function imageratios_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'imageratios';

		// Setup icon CSS
		$defaults['icon-css'] = ( isset( $this->values['imageratios'] ) && NULL != $this->values ? 'icon-' . $this->values['imageratios'] : 'icon-image-size' );

		// Add a Label
		$defaults['label'] = __( 'Image Ratio', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-small';

		// Add elements
		$defaults['elements'] = array(
			'imageratio' => array(
				'type' => 'select-icons',
				'name' => $this->get_layers_field_name( 'imageratios' ),
				'id' => $this->get_layers_field_id( 'imageratios' ),
				'value' => ( isset( $this->values['imageratios'] ) ) ? $this->values['imageratios'] : NULL,
				'options' => array(
					'image-portrait' => __( 'Portrait', 'one-page' ),
					'image-landscape' => __( 'Landscape', 'one-page' ),
					'image-square' => __( 'Square', 'one-page' ),
					'image-no-crop' => __( 'None', 'one-page' ),
					'image-round' => __( 'Round', 'one-page' )
				)
			),
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_imageratios_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Fonts - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function fonts_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'fonts';

		// Setup icon CSS
		$defaults['icon-css'] = 'fa fa-paint-brush';

		// Add a Label
		$defaults['label'] = __( 'Color Settings', 'one-page' );

		// Add a Wrapper Class
		$defaults['wrapper-class'] = 'layers-pop-menu-wrapper layers-animate layers-content-small';

		// Add elements
		$defaults['elements'] = array(
			'fonts-heading-color' => array(
				'type' => 'color',
				'label' => __( 'Heading Color', 'one-page' ),
				'name' => $this->get_layers_field_name( 'sec_head_col', 'color' ),
				'id' => $this->get_layers_field_id( 'sec_head_col', 'color' ),
				'value' => ( isset( $this->values['sec_head_col']['color'] ) ) ? $this->values['sec_head_col']['color'] : NULL
			),
			'fonts-Sub-heading-color' => array(
				'type' => 'color',
				'label' => __( 'Sub-Heading Color', 'one-page' ),
				'name' => $this->get_layers_field_name( 'sec_sub_head_col', 'color' ),
				'id' => $this->get_layers_field_id( 'sec_sub_head_col', 'color' ),
				'value' => ( isset( $this->values['sec_sub_head_col']['color'] ) ) ? $this->values['sec_sub_head_col']['color'] : NULL
			),
			'fonts-content-color' => array(
				'type' => 'color',
				'label' => __( 'Text Color', 'one-page' ),
				'name' => $this->get_layers_field_name( 'content_col', 'color' ),
				'id' => $this->get_layers_field_id( 'content_col', 'color' ),
				'value' => ( isset( $this->values['content_col']['color'] ) ) ? $this->values['content_col']['color'] : NULL
			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_font_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Background - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function background_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'background';

		// Setup icon CSS
		$defaults['icon-css'] = 'icon-photo';

		// Add a Label
		$defaults['label'] = __( 'Background', 'one-page' );

		// Add elements
		$defaults['elements'] = array(
			'background-color' => array(
				'type' => 'color',
				'label' => __( 'Background Color', 'one-page' ),
				'name' => $this->get_layers_field_name( 'background', 'color' ),
				'id' => $this->get_layers_field_id( 'background', 'color' ),
				'value' => ( isset( $this->values['background']['color'] ) ) ? $this->values['background']['color'] : NULL
			),
//			'background-image' => array(
//				'type' => 'image',
//				'label' => __( 'Background Image', 'one-page' ),
//				'button_label' => __( 'Choose Image', 'one-page' ),
//				'name' => $this->get_layers_field_name( 'background', 'image' ),
//				'id' => $this->get_layers_field_id( 'background', 'image' ),
//				'value' => ( isset( $this->values['background']['image'] ) ) ? $this->values['background']['image'] : NULL
//			),
//			'background-repeat' => array(
//				'type' => 'select',
//				'label' => __( 'Background Repeat', 'one-page' ),
//				'name' => $this->get_layers_field_name( 'background', 'repeat' ),
//				'id' => $this->get_layers_field_id( 'background', 'repeat' ),
//				'value' => ( isset( $this->values['background']['repeat'] ) ) ? $this->values['background']['repeat'] : NULL,
//				'options' => array(
//					'no-repeat' => __( 'No Repeat', 'one-page' ),
//					'repeat' => __( 'Repeat', 'one-page' ),
//					'repeat-x' => __( 'Repeat Horizontal', 'one-page' ),
//					'repeat-y' => __( 'Repeat Vertical', 'one-page' )
//				)
//			),
//			'background-position' => array(
//				'type' => 'select',
//				'label' => __( 'Background Position', 'one-page' ),
//				'name' => $this->get_layers_field_name( 'background', 'position' ),
//				'id' => $this->get_layers_field_id( 'background', 'position' ),
//				'value' => ( isset( $this->values['background']['position'] ) ) ? $this->values['background']['position'] : NULL,
//				'options' => array(
//					'center' => __( 'Center', 'one-page' ),
//					'top' => __( 'Top', 'one-page' ),
//					'bottom' => __( 'Bottom', 'one-page' ),
//					'left' => __( 'Left', 'one-page' ),
//					'right' => __( 'Right', 'one-page' )
//				)
//			),
//			'background-stretch' => array(
//				'type' => 'checkbox',
//				'label' => __( 'Stretch', 'one-page' ),
//				'name' => $this->get_layers_field_name( 'background', 'stretch' ),
//				'id' => $this->get_layers_field_id( 'background', 'stretch' ),
//				'value' => ( isset( $this->values['background']['stretch'] ) ) ? $this->values['background']['stretch'] : NULL
//			),
//			'background-darken' => array(
//				'type' => 'checkbox',
//				'label' => __( 'Darken', 'one-page' ),
//				'name' => $this->get_layers_field_name( 'background', 'darken' ),
//				'id' => $this->get_layers_field_id( 'background', 'darken' ),
//				'value' => ( isset( $this->values['background']['darken'] ) ) ? $this->values['background']['darken'] : NULL
//			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_background_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Call To Action Customization - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function buttons_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'buttons';

		// Setup icon CSS
		$defaults['icon-css'] = 'icon-call-to-action';

		// Add a Label
		$defaults['label'] = __( 'Buttons', 'one-page' );

		// Add elements
		$defaults['elements'] = array(

			// New
			'buttons-size' => array(
				'type' => 'select',
				'label' => __( 'Size', 'one-page' ),
				'name' => $this->get_layers_field_name( 'buttons', 'buttons-size' ),
				'id' => $this->get_layers_field_id( 'buttons', 'buttons-size' ),
				'value' => ( isset( $this->values['buttons']['buttons-size'] ) ) ? $this->values['buttons']['buttons-size'] : NULL,
				'options' => array(
					'small' => __( 'Small', 'one-page' ),
					'medium' => __( 'Medium', 'one-page' ),
					'large' => __( 'Large', 'one-page' )
				)
			),

			// Only this one used to be here.
			'buttons-background-color' => array(
				'type' => 'color',
				'label' => __( 'Background Color', 'one-page' ),
				'name' => $this->get_layers_field_name( 'buttons', 'background-color' ),
				'id' => $this->get_layers_field_id( 'buttons', 'background-color' ),
				'value' => ( isset( $this->values['buttons']['background-color'] ) ) ? $this->values['buttons']['background-color'] : NULL
			),

		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_button_colors_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}
	/**
	 * Advanced - Static Option
	 *
	 * @param    array       $args       Additional arguments to pass to this function
	 */
	public function advanced_component( $args = array() ) {

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Set a key for this input
		$key = 'advanced';

		// Setup icon CSS
		$defaults['icon-css'] = 'icon-settings';

		// Add a Label
		$defaults['label'] = __( 'Advanced', 'one-page' );

		// Add elements
		$defaults['elements'] = array(
			'customclass' => array(
				'type' => 'text',
				'label' => __( 'Custom Class(es)', 'one-page' ),
				'name' => $this->get_layers_field_name( 'advanced', 'customclass' ),
				'id' => $this->get_layers_field_id( 'advanced', 'customclass' ),
				'value' => ( isset( $this->values['advanced']['customclass'] ) ) ? $this->values['advanced']['customclass'] : NULL,
				'placeholder' => 'example-class'
			),
			'customcss' => array(
				'type' => 'textarea',
				'label' => __( 'Custom CSS', 'one-page' ),
				'name' => $this->get_layers_field_name( 'advanced', 'customcss' ),
				'id' => $this->get_layers_field_id( 'advanced', 'customcss' ),
				'value' => ( isset( $this->values['advanced']['customcss'] ) ) ? $this->values['advanced']['customcss'] : NULL,
				'placeholder' => ".classname { color: #333; }"
			),
			'padding' => array(
				'type' => 'trbl-fields',
				'label' => __( 'Padding (px)', 'one-page' ),
				'name' => $this->get_layers_field_name( 'advanced', 'padding' ),
				'id' => $this->get_layers_field_id( 'advanced', 'padding' ),
				'value' => ( isset( $this->values['advanced']['padding'] ) ) ? $this->values['advanced']['padding'] : NULL
			),
			'margin' => array(
				'type' => 'trbl-fields',
				'label' => __( 'Margin (px)', 'one-page' ),
				'name' => $this->get_layers_field_name( 'advanced', 'margin' ),
				'id' => $this->get_layers_field_id( 'advanced', 'margin' ),
				'value' => ( isset( $this->values['advanced']['margin'] ) ) ? $this->values['advanced']['margin'] : NULL
			),
			'anchor' => array(
				'type' => 'text',
				'label' => __( 'Custom Anchor', 'one-page' ),
				'name' => $this->get_layers_field_name( 'advanced', 'anchor' ) ,
				'id' => $this->get_layers_field_id( 'advanced', 'anchor' ) ,
				'value' => ( isset( $this->values['advanced']['anchor'] ) ) ? $this->values['advanced']['anchor'] : NULL
			),
			'widget-id' => array(
				'type' => 'text',
				'label' => __( 'Widget ID', 'one-page' ),
				'disabled' => FALSE,
				'value' => '#'  . str_replace( 'widget-layers', 'one-page', str_ireplace( '-design' , '', $this->widget['id'] ) )
			)
		);

		$args = $this->merge_component( $defaults, $args );

		$this->render_control( $key, apply_filters( 'layerswp_advanced_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Custom Compontent
	 *
	 * @param    string     $key        Simply the key and classname for the icon,
	 * @param    array       $args       Component arguments, including the form items
	 */
	public function custom_component( $key = NULL, $args = array() ) {

		if ( empty( $args ) )
			return;

		// If there is no widget information provided, can the operation
		if ( NULL == $this->widget )
			return;

		// Render Control
		$this->render_control( $key, apply_filters( 'layerswp_custom_component_args', $args, $key, $this->type, $this->widget, $this->values ) );
	}

	/**
	 * Merge Compontent
	 */
	public function merge_component( $defaults, $args ) {

		// Grab the elements and unset them - so we can work with them individually.
		$defaults_elements = isset( $defaults['elements'] ) ? $defaults['elements'] : array() ;
		if ( isset( $defaults['elements'] ) ) unset( $defaults['elements'] );

		$args_elements = isset( $args['elements'] ) ? $args['elements'] : array() ;
		if ( isset( $args['elements'] ) ) unset( $args['elements'] );

		// New collection of elements consisting of a specific combo of the $defaults and the $args.
		$new_elements = array();

		foreach ( $args_elements as $args_key => $args_value ) {

			if ( is_string( $args_value ) && isset( $defaults_elements[ $args_value ] ) ) {

				// This case means the caller has specified a custom $args 'elements' config
				// but has only passed a ref to the input by it's 'string 'background-image'
				// allowing them to reposition the input without redefining all the settings
				// the input.
				$new_elements[ $args_value ] = $defaults_elements[ $args_value ];

				// We've got what we needed from this element so remove it from the reference array.
				if ( isset( $defaults_elements[ $args_key ] ) ) {
					unset( $defaults_elements[ $args_value ] );
				}
			}
			else if( isset( $defaults_elements[ $args_key ] ) && is_array( $defaults_elements[ $args_key ] ) && is_array( $args_elements[ $args_key ] ) ) {

				// This case means the caller intends to combine the defaults with new
				// parameters, keeping the existing fields but adding new things to it
				$new_elements[ $args_key ] =  $args_elements[ $args_key ] + $defaults_elements[ $args_key ];
			}
			else if ( is_array( $args_value ) ) {

				// This case means the caller has specified a custom $args 'elements' config
				// and has specified their own custom input field config - allowing them to
				// create a new custom field.
				$new_elements[ $args_key ] = $args_value;

				// We've got what we needed from this element so remove it from the reference array.
				if ( isset( $defaults_elements[ $args_key ] ) ) {
					unset( $defaults_elements[ $args_key ] );
				}
			}
		}

		// This handles merging the important non-elements like 'icon-css' and 'title'
		$args = array_merge( $defaults, $args );

		// Either 'replace' or 'merge' the new input - so either show only the ones you have chosen
		// or show the ones you have chosen after the defaults of the component.
		if ( isset( $args['elements_combine'] ) && 'replace' === $args['elements_combine'] ) {
			$args['elements'] = $new_elements;
		}
		else{ // 'merge' or anything else.
			$args['elements'] = array_merge( $defaults_elements, $new_elements );
		}

		return $args;
	}

	/**
	 * Widget name generation (replaces get_custom_field_id)
	 *
	 * @param    string  $field_name_1   Level 1 name
	 * @param    string  $field_name_2   Level 2 name
 	 * @param    string  $field_name_3   Level 3 name
 	 * @return   string  Name attribute
	 */
	function get_layers_field_name( $field_name_1 = '', $field_name_2 = '', $field_name_3 = '' ) {

		// If we don't have these important widget details then bail.
		if ( ! isset( $this->widget['name'] ) ) return;

		// Compile the first part.
		$string = $this->widget['name'];

		// Now add any custom strings passed as args.
		if( '' != $field_name_1 ) $string .= '[' . $field_name_1 . ']';
		if( '' != $field_name_2 ) $string .= '[' . $field_name_2 . ']';
		if( '' != $field_name_3 ) $string .= '[' . $field_name_3 . ']';

		if ( ( bool ) layers_get_theme_mod( 'dev-switch-widget-field-names' ) ) {
			$debug_string = substr( $string, ( strpos( $string, ']' ) + 1 ), strlen( $string ) );
			echo '<span class="layers-widget-defaults-debug">' . $debug_string . '</span><br />';
		}

		return $string;
	}

	/**
	 * Widget id generation (replaces get_custom_field_id)
	 *
	 * @param    string  $field_name_1   Level 1 id
	 * @param    string  $field_name_2   Level 2 id
 	 * @param    string  $field_name_3   Level 3 id
 	 * @return   string  Id attribute
	 */
	function get_layers_field_id( $field_name_1 = '', $field_name_2 = '', $field_id = '' ) {

		// If we don't have these important widget details then bail.
		if ( ! isset( $this->widget['id'] ) ) return;

		// Compile the first part.
		$string = $this->widget['id'];

		// Now add any custom strings passed as args.
		if( '' != $field_name_1 ) $string .= '-' . $field_name_1;
		if( '' != $field_name_2 ) $string .= '-' . $field_name_2;
		if( '' != $field_id ) $string .= '-' . $field_id;

		return $string;
	}

} //class Layers_Design_Controller
