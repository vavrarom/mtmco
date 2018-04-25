<?php

if (!class_exists('Layers_Content_Widget')) {

    class Layers_Content_Widget extends Layers_Widget {

        /**
         *  Widget construction
         */
        function Layers_Content_Widget() {

            /**
             * Widget variables
             *
             * @param  	string    		$widget_title    	Widget title
             * @param  	string    		$widget_id    		Widget slug for use as an ID/classname
             * @param  	string    		$post_type    		(optional) Post type for use in widget options
             * @param  	string    		$taxonomy    		(optional) Taxonomy slug for use as an ID/classname
             * @param  	array 			$checkboxes    	(optional) Array of checkbox names to be saved in this widget. Don't forget these please!
             */
            $this->widget_title = __('Homepage Custom Section', 'one-page');
            $this->widget_id = 'custom_section';
            $this->post_type = '';
            $this->taxonomy = '';
            $this->checkboxes = array();

            /* Widget settings. */
            $widget_ops = array(
                'classname' => 'obox-layers-' . $this->widget_id . '-widget',
                'description' => __('This widget is used to display your ', 'one-page') . $this->widget_title . '.',
            );

            /* Widget control settings. */
            $control_ops = array(
                'width' => LAYERS_WIDGET_WIDTH_LARGE,
                'height' => NULL,
                'id_base' => LAYERS_THEME_SLUG . '-widget-' . $this->widget_id,
            );

            /* Create the widget. */
            parent::__construct(
                    LAYERS_THEME_SLUG . '-widget-' . $this->widget_id, $this->widget_title, $widget_ops, $control_ops
            );
            /* Setup Widget Repeater Defaults */
            $this->register_repeater_defaults('column', 1, array(
                'section_heading' => __('Section heading', 'one-page'),
                'section_sub_heading' => __('Section sub-heading', 'one-page'),
//           
                'section_content' => __('Write content here...', 'one-page'),
                'section_editable' => true,
//                'width' => '12',
                'design' => array(
                    'imagealign' => 'image-top',
                    'background' => NULL,
                    'show_trash' => FALSE,
                    'fonts' => array(
                        'heading-color' => '#6D6C6C',
                        'Sub-heading-color' => '#272727'
                    ),
                ),
            ));
        }

        /**
         *  Widget front end display
         */
        function widget($args, $instance) {
            global $wp_customize;

            $this->backup_inline_css();

            // Turn $args array into variables.
            extract($args);

            // $instance Defaults
            $instance_defaults = $this->defaults;

            // If we have information in this widget, then ignore the defaults
            if (!empty($instance))
                $instance_defaults = array();

            // Parse $instance
            $widget = wp_parse_args($instance, $instance_defaults);

            // Enqueue Masonry if need be
            if ('list-masonry' == $this->check_and_return($widget, 'design', 'liststyle'))
                $this->enqueue_masonry();

            // Set the background styling
            if (!empty($widget['design']['background']))
                $this->inline_css .= layers_inline_styles('#' . $widget_id, 'background', array('background' => $widget['design']['background']));
             if (!empty($widget['design']['Sub-heading-color']['color']))
                $this->inline_css .= layers_inline_styles('#' . $widget_id, 'color', array('selectors' => array('p.section_main_desc'), 'color' => $widget['design']['Sub-heading-color']['color']));
            

            /**
             * Generate the widget container class
             */
            $widget_container_class = array();
            $widget_container_class[] = 'widget';
            $widget_container_class[] = 'layers-content-widget';
            $widget_container_class[] = 'row';
            $widget_container_class[] = 'content-vertical-massive';
            $widget_container_class[] = $this->check_and_return($widget, 'design', 'advanced', 'customclass'); // Apply custom class from design-bar's advanced control.
            $widget_container_class[] = $this->get_widget_spacing_class($widget);
            $widget_container_class = implode(' ', apply_filters('layers_content_widget_container_class', $widget_container_class));
            ?>
            <?php echo $this->custom_anchor($widget); ?>
            <?php do_action('layers_before_content_widget_inner', $this, $widget); ?>
            <?php
            if (!empty($widget['columns'])) {
                // Set total width
                $total_width = 0;
                ?>
                <?php
                foreach (explode(',', $widget['column_ids']) as $column_key) {

                    // Make sure we've got a column going on here
                    if (!isset($widget['columns'][$column_key]))
                        continue;

                    // Setup the relevant slide
                    $item = $widget['columns'][$column_key];
                    // Set the background styling
                    if (!empty($item['design']['background']))
                        $this->inline_css .= layers_inline_styles('#' . $widget_id . '-' . $column_key, 'background', array('background' => $item['design']['background']));
                   if (!empty($item['design']['sec_head_col']))
                        $this->inline_css .= layers_inline_styles('#' . $widget_id . '-' . $column_key, 'color', array('selectors' => array('h2.section_main_head'), 'color' => $item['design']['sec_head_col']['color']));
                    if (!empty($item['design']['sec_sub_head_col']))
                        $this->inline_css .= layers_inline_styles('#' . $widget_id . '-' . $column_key, 'color', array('selectors' => array('p.section_main_desc'), 'color' => $item['design']['sec_sub_head_col']['color']));
                    if (!empty($item['design']['content_col']))
                        $this->inline_css .= layers_inline_styles('#' . $widget_id . '-' . $column_key, 'color', array('selectors' => array('div.section_content','div.section_content p'), 'color' => $item['design']['content_col']['color']));
                
                    $bg_color = $item['design']['background']['color'];
//                    $custom_style = "style ='padding: 55px 0 65px 0;margin-top: 0; '";
                    $section_hr = "style ='width: 23%;height: 3px;margin-left: auto;margin-right: auto;border: none;background-color:" . section_strip_color($bg_color) . ";'";
                    ?>

                    <section id="<?php echo $column_key; ?>">
                        <div  id="<?php echo esc_attr($widget_id . '-' . $column_key); ?>" class="section_div">
                            <div class="container">
                                <div class="row <?php echo $this->get_widget_layout_class($widget); ?>">
                                    <div class="col-lg-12 text-center">
                                        <?php if ($this->check_and_return($item, 'section_heading')) { ?>
                                            <h2 class="section_main_head">
                                                <?php echo $item['section_heading']; ?>
                                            </h2>
                                        <?php } ?>
                                        <hr class="section_sep" <?php echo $section_hr; ?>>
                                        <?php if ($this->check_and_return($item, 'section_sub_heading')) { ?>
                                            <p class="section_main_desc">
                                                <?php echo $item['section_sub_heading']; ?>
                                            </p>
                                        <?php } ?>
                                        <?php if ($this->check_and_return($item, 'section_content')) { ?>
                                            <div class="section_content"><?php layers_the_content($item['section_content']); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                }
            }

            do_action('layers_after_content_widget_inner', $this, $widget);

            // Print the Inline Styles for this Widget
            $this->print_inline_css();

            if ('list-masonry' == $this->check_and_return($widget, 'design', 'liststyle')) {
                ?>
                <script>
                    jQuery(function ($) {
                        layers_masonry_settings[ '<?php echo $widget_id; ?>' ] = [{
                                itemSelector: '.layers-masonry-column',
                                layoutMode: 'masonry',
                                gutter: <?php echo ( isset($widget['design']['gutter']) ? 20 : 0 ); ?>
                            }];

                        $('#<?php echo $widget_id; ?>').find('.list-masonry').layers_masonry(layers_masonry_settings[ '<?php echo $widget_id; ?>' ][0]);
                    });
                </script>
            <?php } // masonry trigger    ?>

            </section>
            <?php
            // Apply the advanced widget styling
            $this->apply_widget_advanced_styling($widget_id, $widget);
        }

        /**
         *  Widget update
         */
        function update($new_instance, $old_instance) {
            if (isset($this->checkboxes)) {
                foreach ($this->checkboxes as $cb) {
                    if (isset($old_instance[$cb])) {
                        $old_instance[$cb] = strip_tags($new_instance[$cb]);
                    }
                } // foreach checkboxes
            } // if checkboxes
            return $new_instance;
        }

        /**
         *  Widget form
         *
         * We use regular HTML here, it makes reading the widget much easier than if we used just php to echo all the HTML out.
         *
         */
        function form($instance) {

            // $instance Defaults
            $instance_defaults = $this->defaults;

            // If we have information in this widget, then ignore the defaults
            if (!empty($instance))
                $instance_defaults = array();

            // Parse $instance
            $widget = wp_parse_args($instance, $instance_defaults);
            ?>
            <div class="layers-container-large" id="layers-column-widget-<?php echo $this->number; ?>">

                <?php
                $this->form_elements()->header(array(
                    'title' => 'Homepage Section Sorting',
                    'icon_class' => 'text'
                ));
                ?>

                <section class="layers-accordion-section layers-content">
                    <div class="layers-form-item">
                        <?php $this->repeater('column', $widget); ?>
                    </div>
                </section>

            </div>

            <?php
        }

        function column_item($item_guid, $widget) {
            ?>
            <li class="layers-accordion-item <?php echo (isset($widget['section_editable']) && $widget['section_editable'] == true) ? 'layers-accordion-edit' : ''; ?>" data-guid="<?php echo esc_attr($item_guid); ?>">
                <a class="layers-accordion-title">
                    <span>
                        <?php _e('Column', 'one-page'); ?><span class="layers-detail"><?php echo ( isset($widget['section_heading']) ? ': ' . $widget['section_heading'] : NULL ); ?></span>
                    </span>
                </a>
                <section class="layers-accordion-section layers-content">
                    <?php
                    $this->design_bar(
                            'top', // CSS Class Name
                            array(// Widget Object
                        'name' => $this->get_layers_field_name('design'),
                        'id' => $this->get_layers_field_id('design'),
                        'widget_id' => $this->widget_id . '_item',
                        'number' => $this->number,
                        'show_trash' => FALSE,
                            ), $widget, // Widget Values
                            apply_filters('layers_column_widget_column_design_bar_components', array(// Components
                        'background',
                        'fonts',
//                        'featuredimage',
//                        'imagealign',
//                        'width' => array(
//                            'icon-css' => 'icon-columns',
//                            'label' => 'Column Width',
//                            'elements' => array(
//                                'layout' => array(
//                                    'type' => 'select',
//                                    'label' => __('', 'one-page'),
//                                    'name' => $this->get_layers_field_name('width'),
//                                    'id' => $this->get_layers_field_id('width'),
//                                    'value' => ( isset($widget['width']) ) ? $widget['width'] : NULL,
//                                    'options' => array(
//                                        '1' => __('1 of 12 columns', 'one-page'),
//                                        '2' => __('2 of 12 columns', 'one-page'),
//                                        '3' => __('3 of 12 columns', 'one-page'),
//                                        '4' => __('4 of 12 columns', 'one-page'),
//                                        '5' => __('5 of 12 columns', 'one-page'),
//                                        '6' => __('6 of 12 columns', 'one-page'),
//                                        '7' => __('7 of 12 columns', 'one-page'),
//                                        '8' => __('8 of 12 columns', 'one-page'),
//                                        '9' => __('9 of 12 columns', 'one-page'),
//                                        '10' => __('10 of 12 columns', 'one-page'),
//                                        '11' => __('11 of 12 columns', 'one-page'),
//                                        '12' => __('12 of 12 columns', 'one-page')
//                                    )
//                                )
//                            )
//                        ),
//                        'advanced' => array(
//                            'elements' => array(
//                                'customclass'
//                            ),
//                            'elements_combine' => 'replace',
//                        ),
                            ))
                    );
                    ?>
                    <div class="layers-row">
                        <p class="layers-form-item">
                            <label for="<?php echo $this->get_layers_field_id('section_heading'); ?>"><?php _e('Section Heading', 'one-page'); ?></label>
                            <?php
                            echo $this->form_elements()->input(
                                    array(
                                        'type' => 'text',
                                        'name' => $this->get_layers_field_name('section_heading'),
                                        'id' => $this->get_layers_field_id('section_heading'),
                                        'placeholder' => __('Enter title here', 'one-page'),
                                        'value' => ( isset($widget['section_heading']) ) ? $widget['section_heading'] : NULL,
                                        'class' => 'layers-text'
                                    )
                            );
                            ?>
                        </p>
                        <p class="layers-form-item">
                            <label for="<?php echo $this->get_layers_field_id('section_sub_heading'); ?>"><?php _e('Section Sub-heading', 'one-page'); ?></label>
                            <?php
                            echo $this->form_elements()->input(
                                    array(
                                        'type' => 'text',
                                        'name' => $this->get_layers_field_name('section_sub_heading'),
                                        'id' => $this->get_layers_field_id('section_sub_heading'),
                                        'placeholder' => __('Enter title here', 'one-page'),
                                        'value' => ( isset($widget['section_sub_heading']) ) ? $widget['section_sub_heading'] : NULL,
                                        'class' => 'layers-text'
                                    )
                            );
                            ?>
                        </p>
                        <p class="layers-form-item">
                            <label for="<?php echo $this->get_layers_field_id('section_content'); ?>"><?php _e('Section Content', 'one-page'); ?></label>
                            <?php
                            echo $this->form_elements()->input(
                                    array(
                                        'type' => 'rte',
                                        'name' => $this->get_layers_field_name('section_content'),
                                        'id' => $this->get_layers_field_id('section_content'),
                                        'placeholder' => __('Section content', 'one-page'),
                                        'value' => ( isset($widget['section_content']) ) ? $widget['section_content'] : NULL,
                                        'class' => 'layers-form-item layers-textarea',
                                        'rows' => 6
                                    )
                            );
                            ?>
                        </p>

                        <?php
                        // Fix widget's that were created before dynamic linking structure.
                        $widget = $this->convert_legacy_widget_links($widget, 'button');
                        ?>
                    </div>
                </section>
            </li>
            <?php
        }

    }

    // Class
    // Add our function to the widgets_init hook.
    register_widget("Layers_Content_Widget");
}