<?php
if (class_exists('WP_Customize_Control')) {

    /**
     * Sortable multi check boxes custom control.
     * @since 1.0
     * @author inkthemes.com
     * @copyright Copyright (c) 2015, inkthemes.com
     */
    class Inkthemes_Customize_Control_Sortable_Checkboxes extends WP_Customize_Control {

        /**
         * Control Type
         */
        public $type = 'ink-multicheck-sortable';

        /**
         * Render Settings
         */
        public function render_content() {

            /* if no choices, bail. */
            if (empty($this->choices)) {
                return;
            }
            if (!empty($this->label)) {
                ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php
            } // add label if needed.

            if (!empty($this->description)) {
                ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
                <?php
            } // add desc if needed.
            /* Data */
            $values = explode(',', $this->value());
            $choices = $this->choices;

            /* If values exist, use it. */
            $options = array();
            if ($values) {

                /* get individual item */
                foreach ($values as $value) {

                    /* separate item with option */
                    $value = explode(':', $value);

                    /* build the array. remove options not listed on choices. */
                    if (array_key_exists($value[0], $choices)) {
                        $options[$value[0]] = $value[1] ? '1' : '0';
                    }
                }
            }
            /* if there's new options (not saved yet), add it in the end. */
            foreach ($choices as $key => $val) {

                /* if not exist, add it in the end. */
                if (!array_key_exists($key, $options)) {
                    $options[$key] = '0'; // use zero to deactivate as default for new items.
                }
            }
            ?>

            <ul class="ink-multicheck-sortable-list">

                <?php foreach ($options as $key => $value) { ?>

                    <li>
                        <label>
                            <input name="<?php echo esc_attr($key); ?>" class="ink-multicheck-sortable-item" type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked($value); ?> />
                            <?php echo esc_html($choices[$key]); ?>
                        </label>
                        <i class="dashicons dashicons-menu ink-multicheck-sortable-handle"></i>
                    </li>

                <?php } // end choices.      ?>

                <li class="ink-hideme">
                    <input type="hidden" class="ink-multicheck-sortable" <?php $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>" />
                </li>

            </ul><!-- .ink-multicheck-sortable-list -->


            <?php
        }

    }

    class Inkthemes_Customize_Alpha_Color_Control extends WP_Customize_Control {

        /**
         * Official control name.
         */
        public $type = 'alpha-color';

        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         */
        public $palette;

        /**
         * Add support for showing the opacity value on the slider handle.
         */
        public $show_opacity;

        /**
         * Enqueue scripts and styles.
         *
         * Ideally these would get registered and given proper paths before this control object
         * gets initialized, then we could simply enqueue them here, but for completeness as a
         * stand alone class we'll register and enqueue them here.
         */
        public function enqueue() {
            wp_enqueue_script(
                    'one-page-alpha-color-picker', get_stylesheet_directory_uri() . '/assets/js/onepage_color_control.js', array('jquery', 'wp-color-picker'), '', true
            );
            wp_enqueue_style(
                    'one-page-alpha-color-picker', get_stylesheet_directory_uri() . '/assets/css/customizer.css', array('wp-color-picker'), ''
            );
        }

        /**
         * Render the control.
         */
        public function render_content() {

            // Process the palette
            if (is_array($this->palette)) {
                $palette = implode('|', $this->palette);
            } else {
                // Default to true. 
                $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }
            // Support passing show_opacity as string or boolean. Default to true.
            $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
            // Begin the output.
            ?>
            <label>
                <?php
                // Output the label and description if they were passed in.
                if (isset($this->label) && '' !== $this->label) {
                    echo '<span class="customize-control-title">' . sanitize_text_field($this->label) . '</span>';
                }
                if (isset($this->description) && '' !== $this->description) {
                    echo '<span class="description customize-control-description">' . sanitize_text_field($this->description) . '</span>';
                }
                ?>
                <input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr($palette); ?>" data-default-color="<?php echo esc_attr($this->settings['default']->default); ?>" <?php $this->link(); ?>  />
            </label>
            <?php
        }

    }

    /**
     * Controller to select Icons 
     */
    class Icon_Selection_Control extends WP_Customize_Control {

        /**
         * Control Type
         */
        public $type = 'ink_icon';
        public $fa_icons = array(
            'fa-glass' => array('name' => 'fa-glass'),
            'fa-music' => array('name' => 'fa-music'),
            'fa-search' => array('name' => 'fa-search'),
            'fa-envelope-o' => array('name' => 'fa-envelope-o'),
            'fa-heart' => array('name' => 'fa-heart'),
            'fa-star' => array('name' => 'fa-star'),
            'fa-star-o' => array('name' => 'fa-star-o'),
            'fa-user' => array('name' => 'fa-user'),
            'fa-film' => array('name' => 'fa-film'),
            'fa-th-large' => array('name' => 'fa-th-large'),
            'fa-th' => array('name' => 'fa-th'),
            'fa-th-list' => array('name' => 'fa-th-list'),
            'fa-check' => array('name' => 'fa-check'),
            'fa-close' => array('name' => 'fa-close'),
            'fa-search-plus' => array('name' => 'fa-search-plus'),
            'fa-search-minus' => array('name' => 'fa-search-minus'),
            'fa-power-off' => array('name' => 'fa-power-off	'),
            'fa-signal' => array('name' => 'fa-signal'),
            'fa-gear' => array('name' => 'fa-gear'),
            'fa-trash-o' => array('name' => 'fa-trash-o'),
            'fa-home' => array('name' => 'fa-home'),
            'fa-file-o' => array('name' => 'fa-file-o'),
            'fa-clock-o' => array('name' => 'fa-clock-o'),
            'fa-road' => array('name' => 'fa-road'),
            'fa-download' => array('name' => 'fa-arrow-circle-o-down'),
            'fa-arrow-circle-o-up' => array('name' => 'fa-arrow-circle-o-up'),
            'fa-inbox' => array('name' => 'fa-inbox'),
            'fa-play-circle-o' => array('name' => 'fa-play-circle-o'),
            'fa-rotate-right' => array('name' => 'fa-rotate-right'),
            'fa-refresh' => array('name' => 'fa-refresh'),
            'fa-list-alt' => array('name' => 'fa-list-alt'),
            'fa-lock' => array('name' => 'fa-lock'),
            'fa-flag' => array('name' => 'fa-flag'),
            'fa-headphones' => array('name' => 'fa-headphones'),
            'fa-volume-off' => array('name' => 'fa-volume-off'),
            'fa-volume-down' => array('name' => 'fa-volume-down'),
            'fa-volume-up' => array('name' => 'fa-volume-up'),
            'fa-qrcode' => array('name' => 'fa-qrcode'),
            'fa-barcode' => array('name' => 'fa-barcode'),
            'fa-tag' => array('name' => 'fa-tag'),
            'fa-tags' => array('name' => 'fa-tags'),
            'fa-book' => array('name' => 'fa-book'),
            'fa-bookmark' => array('name' => 'fa-bookmark'),
            'fa-print' => array('name' => 'fa-print'),
            'fa-camera' => array('name' => 'fa-camera'),
            'fa-font' => array('name' => 'fa-font'),
            'fa-bold' => array('name' => 'fa-bold'),
            'fa-italic' => array('name' => 'fa-italic'),
            'fa-text-height' => array('name' => 'fa-text-height'),
            'fa-text-width' => array('name' => 'fa-text-width'),
            'fa-align-left' => array('name' => 'fa-align-left'),
            'fa-align-center' => array('name' => 'fa-align-center'),
            'fa-align-right' => array('name' => 'fa-align-right'),
            'fa-align-justify' => array('name' => 'fa-align-justify'),
            'fa-list' => array('name' => 'fa-list'),
            'fa-outdent' => array('name' => 'fa-outdent'),
            'fa-indent' => array('name' => 'fa-indent'),
            'fa-video-camera' => array('name' => 'fa-video-camera'),
            'fa-photo' => array('name' => 'fa-photo'),
            'fa-pencil' => array('name' => 'fa-pencil'),
            'fa-map-marker' => array('name' => 'fa-map-marker'),
            'fa-adjust' => array('name' => 'fa-adjust'),
            'fa-tint' => array('name' => 'fa-tint'),
            'fa-edit' => array('name' => 'fa-edit'),
            'fa-share-square-o' => array('name' => 'fa-share-square-o'),
            'fa-check-square-o' => array('name' => 'fa-check-square-o'),
            'fa-arrows' => array('name' => 'fa-arrows'),
            'fa-step-backward' => array('name' => 'fa-step-backward'),
            'fa-fast-backward' => array('name' => 'fa-fast-backward'),
            'fa-backward' => array('name' => 'fa-backward'),
            'fa-play' => array('name' => 'fa-play'),
            'fa-pause' => array('name' => 'fa-pause'),
            'fa-stop' => array('name' => 'fa-stop'),
            'fa-forward' => array('name' => 'fa-forward'),
            'fa-fast-forward' => array('name' => 'fa-fast-forward'),
            'fa-step-forward' => array('name' => 'fa-step-forward'),
            'fa-eject' => array('name' => 'fa-eject'),
            'fa-chevron-left' => array('name' => 'fa-chevron-left'),
            'fa-chevron-right' => array('name' => 'fa-chevron-right'),
            'fa-plus-circle' => array('name' => 'fa-plus-circle'),
            'fa-minus-circle' => array('name' => 'fa-minus-circle'),
            'fa-times-circle' => array('name' => 'fa-times-circle'),
            'fa-check-circle' => array('name' => 'fa-check-circle'),
            'fa-question-circle' => array('name' => 'fa-question-circle'),
            'fa-info-circle' => array('name' => 'fa-info-circle'),
            'fa-crosshairs' => array('name' => 'fa-crosshairs'),
            'fa-times-circle-o' => array('name' => 'fa-times-circle-o'),
            'fa-check-circle-o' => array('name' => 'fa-check-circle-o'),
            'fa-ban' => array('name' => 'fa-ban'),
            'fa-arrow-left' => array('name' => 'fa-arrow-left'),
            'fa-arrow-right' => array('name' => 'fa-arrow-right'),
            'fa-arrow-up' => array('name' => 'fa-arrow-up'),
            'fa-arrow-down' => array('name' => 'fa-arrow-down'),
            'fa-share' => array('name' => 'fa-share'),
            'fa-expand' => array('name' => 'fa-expand'),
            'fa-compress' => array('name' => 'fa-compress'),
            'fa-plus' => array('name' => 'fa-plus'),
            'fa-minus' => array('name' => 'fa-minus'),
            'fa-asterisk' => array('name' => 'fa-asterisk'),
            'fa-exclamation-circle' => array('name' => 'fa-exclamation-circle'),
            'fa-gift' => array('name' => 'fa-gift'),
            'fa-leaf' => array('name' => 'fa-leaf'),
            'fa-fire' => array('name' => 'fa-fire'),
            'fa-eye' => array('name' => 'fa-eye'),
            'fa-eye-slash' => array('name' => 'fa-eye-slash'),
            'fa-warning' => array('name' => 'fa-warning'),
            'fa-plane' => array('name' => 'fa-plane'),
            'fa-calendar' => array('name' => 'fa-calendar'),
            'fa-random' => array('name' => 'fa-random'),
            'fa-comment' => array('name' => 'fa-comment'),
            'fa-magnet' => array('name' => 'fa-magnet'),
            'fa-chevron-up' => array('name' => 'fa-chevron-up'),
            'fa-chevron-down' => array('name' => 'fa-chevron-down'),
            'fa-retweet' => array('name' => 'fa-retweet'),
            'fa-shopping-cart' => array('name' => 'fa-shopping-cart'),
            'fa-folder' => array('name' => 'fa-folder'),
            'fa-folder-open' => array('name' => 'fa-folder-open'),
            'fa-arrows-v' => array('name' => 'fa-arrows-v'),
            'fa-arrows-h' => array('name' => 'fa-arrows-h'),
            'fa-bar-chart' => array('name' => 'fa-bar-chart'),
            'fa-twitter-square' => array('name' => 'fa-twitter-square'),
            'fa-facebook-square' => array('name' => 'fa-facebook-square'),
            'fa-camera-retro' => array('name' => 'fa-camera-retro'),
            'fa-key' => array('name' => 'fa-key'),
            'fa-gears' => array('name' => 'fa-gears'),
            'fa-comments' => array('name' => 'fa-comments'),
            'fa-thumbs-o-up' => array('name' => 'fa-thumbs-o-up'),
            'fa-thumbs-o-down' => array('name' => 'fa-thumbs-o-down'),
            'fa-star-half' => array('name' => 'fa-star-half'),
            'fa-heart-o' => array('name' => 'fa-heart-o'),
            'fa-sign-out' => array('name' => 'fa-sign-out'),
            'fa-linkedin-square' => array('name' => 'fa-linkedin-square'),
            'fa-thumb-tack' => array('name' => 'fa-thumb-tack'),
            'fa-external-link' => array('name' => 'fa-external-link'),
            'fa-sign-in' => array('name' => 'fa-sign-in'),
            'fa-trophy' => array('name' => 'fa-trophy'),
            'fa-github-square' => array('name' => 'fa-github-square'),
            'fa-upload' => array('name' => 'fa-upload'),
            'fa-lemon-o' => array('name' => 'fa-lemon-o'),
            'fa-phone' => array('name' => 'fa-phone'),
            'fa-square-o' => array('name' => 'fa-square-o'),
            'fa-bookmark-o' => array('name' => 'fa-bookmark-o'),
            'fa-phone-square' => array('name' => 'fa-phone-square'),
            'fa-twitter' => array('name' => 'fa-twitter'),
            'fa-facebook' => array('name' => 'fa-facebook'),
            'fa-github' => array('name' => 'fa-github'),
            'fa-unlock' => array('name' => 'fa-unlock'),
            'fa-credit-card' => array('name' => 'fa-credit-card'),
            'fa-rss' => array('name' => 'fa-rss'),
            'fa-hdd-o' => array('name' => 'fa-hdd-o'),
            'fa-bullhorn' => array('name' => 'fa-bullhorn'),
            'fa-bell' => array('name' => 'fa-bell'),
            'fa-certificate' => array('name' => 'fa-certificate'),
            'fa-hand-o-right' => array('name' => 'fa-hand-o-right'),
            'fa-hand-o-left' => array('name' => 'fa-hand-o-left'),
            'fa-hand-o-up' => array('name' => 'fa-hand-o-up'),
            'fa-hand-o-down' => array('name' => 'fa-hand-o-down'),
            'fa-arrow-circle-left' => array('name' => 'fa-arrow-circle-left'),
            'fa-arrow-circle-right' => array('name' => 'fa-arrow-circle-right'),
            'fa-arrow-circle-up' => array('name' => 'fa-arrow-circle-up'),
            'fa-arrow-circle-down' => array('name' => 'fa-arrow-circle-down'),
            'fa-globe' => array('name' => 'fa-globe'),
            'fa-wrench' => array('name' => 'fa-wrench'),
            'fa-tasks' => array('name' => 'fa-tasks'),
            'fa-filter' => array('name' => 'fa-filter'),
            'fa-briefcase' => array('name' => 'fa-briefcase'),
            'fa-arrows-alt' => array('name' => 'fa-arrows-alt'),
            'fa-users' => array('name' => 'fa-users'),
            'fa-link' => array('name' => 'fa-link'),
            'fa-cloud' => array('name' => 'fa-cloud'),
            'fa-flask' => array('name' => 'fa-flask'),
            'fa-cut' => array('name' => 'fa-cut'),
            'fa-copy' => array('name' => 'fa-copy'),
            'fa-paperclip' => array('name' => 'fa-paperclip'),
            'fa-save' => array('name' => 'fa-save'),
            'fa-square' => array('name' => 'fa-square'),
            'fa-navicon' => array('name' => 'fa-navicon'),
            'fa-list-ul' => array('name' => 'fa-list-ul'),
            'fa-list-ol' => array('name' => 'fa-list-ol'),
            'fa-strikethrough' => array('name' => 'fa-strikethrough'),
            'fa-underline' => array('name' => 'fa-underline'),
            'fa-table' => array('name' => 'fa-table'),
            'fa-magic' => array('name' => 'fa-magic'),
            'fa-truck' => array('name' => 'fa-truck'),
            'fa-pinterest' => array('name' => 'fa-pinterest'),
            'fa-pinterest-square' => array('name' => 'fa-pinterest-square'),
            'fa-google-plus-square' => array('name' => 'fa-google-plus-square'),
            'fa-google-plus' => array('name' => 'fa-google-plus'),
            'fa-money' => array('name' => 'fa-money'),
            'fa-caret-down' => array('name' => 'fa-caret-down'),
            'fa-caret-up' => array('name' => 'fa-caret-up'),
            'fa-caret-left' => array('name' => 'fa-caret-left'),
            'fa-caret-right' => array('name' => 'fa-caret-right'),
            'fa-columns' => array('name' => 'fa-columns'),
            'fa-sort' => array('name' => 'fa-sort'),
            'fa-sort-desc' => array('name' => 'fa-sort-desc'),
            'fa-sort-asc' => array('name' => 'fa-sort-asc'),
            'fa-envelope' => array('name' => 'fa-envelope'),
            'fa-linkedin' => array('name' => 'fa-linkedin'),
            'fa-undo' => array('name' => 'fa-undo'),
            'fa-legal' => array('name' => 'fa-legal'),
            'fa-dashboard' => array('name' => 'fa-dashboard'),
            'fa-comment-o' => array('name' => 'fa-comment-o'),
            'fa-comments-o' => array('name' => 'fa-comments-o'),
            'fa-flash' => array('name' => 'fa-flash'),
            'fa-sitemap' => array('name' => 'fa-sitemap'),
            'fa-umbrella' => array('name' => 'fa-umbrella'),
            'fa-paste' => array('name' => 'fa-paste'),
            'fa-lightbulb-o' => array('name' => 'fa-lightbulb-o'),
            'fa-exchange' => array('name' => 'fa-exchange'),
            'fa-cloud-download' => array('name' => 'fa-cloud-download'),
            'fa-cloud-upload' => array('name' => 'fa-cloud-upload'),
            'fa-user-md' => array('name' => 'fa-user-md'),
            'fa-stethoscope' => array('name' => 'fa-stethoscope'),
            'fa-suitcase' => array('name' => 'fa-suitcase'),
            'fa-bell-o' => array('name' => 'fa-bell-o'),
            'fa-coffee' => array('name' => 'fa-coffee'),
            'fa-cutlery' => array('name' => 'fa-cutlery'),
            'fa-file-text-o' => array('name' => 'fa-file-text-o'),
            'fa-building-o' => array('name' => 'fa-building-o'),
            'fa-hospital-o' => array('name' => 'fa-hospital-o'),
            'fa-ambulance' => array('name' => 'fa-ambulance'),
            'fa-medkit' => array('name' => 'fa-medkit'),
            'fa-fighter-jet' => array('name' => 'fa-fighter-jet'),
            'fa-beer' => array('name' => 'fa-beer'),
            'fa-h-square' => array('name' => 'fa-h-square'),
            'fa-plus-square' => array('name' => 'fa-plus-square'),
            'fa-angle-double-left' => array('name' => 'fa-angle-double-left'),
            'fa-angle-double-right' => array('name' => 'fa-angle-double-right'),
            'fa-angle-double-up' => array('name' => 'fa-angle-double-up'),
            'fa-angle-double-down' => array('name' => 'fa-angle-double-down'),
            'fa-angle-left' => array('name' => 'fa-angle-left'),
            'fa-angle-right' => array('name' => 'fa-angle-right'),
            'fa-angle-up' => array('name' => 'fa-angle-up'),
            'fa-angle-down' => array('name' => 'fa-angle-down'),
            'fa-desktop' => array('name' => 'fa-desktop'),
            'fa-laptop' => array('name' => 'fa-laptop'),
            'fa-tablet' => array('name' => 'fa-tablet'),
            'fa-mobile' => array('name' => 'fa-mobile'),
            'fa-circle-o' => array('name' => 'fa-circle-o'),
            'fa-quote-left' => array('name' => 'fa-quote-left'),
            'fa-quote-right' => array('name' => 'fa-quote-right'),
            'fa-spinner' => array('name' => 'fa-spinner'),
            'fa-circle' => array('name' => 'fa-circle'),
            'fa-reply' => array('name' => 'fa-reply'),
            'fa-github-alt' => array('name' => 'fa-github-alt'),
            'fa-folder-o' => array('name' => 'fa-folder-o'),
            'fa-folder-open-o' => array('name' => 'fa-folder-open-o'),
            'fa-smile-o' => array('name' => 'fa-smile-o'),
            'fa-frown-o' => array('name' => 'fa-frown-o'),
            'fa-meh-o' => array('name' => 'fa-meh-o'),
            'fa-gamepad' => array('name' => 'fa-gamepad'),
            'fa-keyboard-o' => array('name' => 'fa-keyboard-o'),
            'fa-flag-o' => array('name' => 'fa-flag-o'),
            'fa-flag-checkered' => array('name' => 'fa-flag-checkered'),
            'fa-terminal' => array('name' => 'fa-terminal'),
            'fa-code' => array('name' => 'fa-code'),
            'fa-reply-all' => array('name' => 'fa-reply-all'),
            'fa-star-half-full' => array('name' => 'fa-star-half-full'),
            'fa-location-arrow' => array('name' => 'fa-location-arrow'),
            'fa-crop' => array('name' => 'fa-crop'),
            'fa-code-fork' => array('name' => 'fa-code-fork'),
            'fa-unlink' => array('name' => 'fa-unlink'),
            'fa-question' => array('name' => 'fa-question'),
            'fa-info' => array('name' => 'fa-info'),
            'fa-exclamation' => array('name' => 'fa-exclamation'),
            'fa-superscript' => array('name' => 'fa-superscript'),
            'fa-subscript' => array('name' => 'fa-subscript'),
            'fa-eraser' => array('name' => 'fa-eraser'),
            'fa-puzzle-piece' => array('name' => 'fa-puzzle-piece'),
            'fa-microphone' => array('name' => 'fa-microphone'),
            'fa-microphone-slash' => array('name' => 'fa-microphone-slash'),
            'fa-shield' => array('name' => 'fa-shield'),
            'fa-calendar-o' => array('name' => 'fa-calendar-o'),
            'fa-fire-extinguisher' => array('name' => 'fa-fire-extinguisher'),
            'fa-rocket' => array('name' => 'fa-rocket'),
            'fa-maxcdn' => array('name' => 'fa-maxcdn'),
            'fa-chevron-circle-left' => array('name' => 'fa-chevron-circle-left'),
            'fa-chevron-circle-right' => array('name' => 'fa-chevron-circle-right'),
            'fa-chevron-circle-up' => array('name' => 'fa-chevron-circle-up'),
            'fa-chevron-circle-down' => array('name' => 'fa-chevron-circle-down'),
            'fa-html5' => array('name' => 'fa-html5'),
            'fa-css3' => array('name' => 'fa-css3'),
            'fa-anchor' => array('name' => 'fa-anchor'),
            'fa-unlock-alt' => array('name' => 'fa-unlock-alt'),
            'fa-bullseye' => array('name' => 'fa-bullseye'),
            'fa-ellipsis-h' => array('name' => 'fa-ellipsis-h'),
            'fa-ellipsis-v' => array('name' => 'fa-ellipsis-v'),
            'fa-rss-square' => array('name' => 'fa-rss-square'),
            'fa-play-circle' => array('name' => 'fa-play-circle'),
            'fa-ticket' => array('name' => 'fa-ticket'),
            'fa-minus-square' => array('name' => 'fa-minus-square'),
            'fa-minus-square-o' => array('name' => 'fa-minus-square-o'),
            'fa-level-up' => array('name' => 'fa-level-up'),
            'fa-level-down' => array('name' => 'fa-level-down'),
            'fa-check-square' => array('name' => 'fa-check-square'),
            'fa-pencil-square' => array('name' => 'fa-pencil-square'),
            'fa-external-link-square' => array('name' => 'fa-external-link-square'),
            'fa-share-square' => array('name' => 'fa-share-square'),
            'fa-compass' => array('name' => 'fa-compass'),
            'fa-toggle-down' => array('name' => 'fa-toggle-down'),
            'fa-toggle-up' => array('name' => 'fa-toggle-up'),
            'fa-toggle-right' => array('name' => 'fa-toggle-right'),
            'fa-euro' => array('name' => 'fa-euro'),
            'fa-gbp' => array('name' => 'fa-gbp'),
            'fa-dollar' => array('name' => 'fa-dollar'),
            'fa-rupee' => array('name' => 'fa-rupee'),
            'fa-yen' => array('name' => 'fa-yen'),
            'fa-rub' => array('name' => 'fa-rub'),
            'fa-won' => array('name' => 'fa-won'),
            'fa-bitcoin' => array('name' => 'fa-bitcoin'),
            'fa-file' => array('name' => 'fa-file'),
            'fa-file-text' => array('name' => 'fa-file-text'),
            'fa-sort-alpha-asc' => array('name' => 'fa-sort-alpha-asc'),
            'fa-sort-alpha-desc' => array('name' => 'fa-sort-alpha-desc'),
            'fa-sort-amount-asc' => array('name' => 'fa-sort-amount-asc'),
            'fa-sort-amount-desc' => array('name' => 'fa-sort-amount-desc'),
            'fa-sort-numeric-asc' => array('name' => 'fa-sort-numeric-asc'),
            'fa-sort-numeric-desc' => array('name' => 'fa-sort-numeric-desc'),
            'fa-thumbs-up' => array('name' => 'fa-thumbs-up'),
            'fa-thumbs-down' => array('name' => 'fa-thumbs-down'),
            'fa-youtube-square' => array('name' => 'fa-youtube-square'),
            'fa-youtube' => array('name' => 'fa-youtube'),
            'fa-xing' => array('name' => 'fa-xing'),
            'fa-xing-square' => array('name' => 'fa-xing-square'),
            'fa-youtube-play' => array('name' => 'fa-youtube-play'),
            'fa-dropbox' => array('name' => 'fa-dropbox'),
            'fa-stack-overflow' => array('name' => 'fa-stack-overflow'),
            'fa-instagram' => array('name' => 'fa-instagram'),
            'fa-flickr' => array('name' => 'fa-flickr'),
            'fa-adn' => array('name' => 'fa-adn'),
            'fa-bitbucket' => array('name' => 'fa-bitbucket'),
            'fa-bitbucket-square' => array('name' => 'fa-bitbucket-square'),
            'fa-tumblr' => array('name' => 'fa-tumblr'),
            'fa-tumblr-square' => array('name' => 'fa-tumblr-square'),
            'fa-long-arrow-down' => array('name' => 'fa-long-arrow-down'),
            'fa-long-arrow-up' => array('name' => 'fa-long-arrow-up'),
            'fa-long-arrow-left' => array('name' => 'fa-long-arrow-left'),
            'fa-long-arrow-right' => array('name' => 'fa-long-arrow-right'),
            'fa-apple' => array('name' => 'fa-apple'),
            'fa-windows' => array('name' => 'fa-windows'),
            'fa-android' => array('name' => 'fa-android'),
            'fa-linux' => array('name' => 'fa-linux'),
            'fa-dribbble' => array('name' => 'fa-dribbble'),
            'fa-skype' => array('name' => 'fa-skype'),
            'fa-foursquare' => array('name' => 'fa-foursquare'),
            'fa-trello' => array('name' => 'fa-trello'),
            'fa-female' => array('name' => 'fa-female'),
            'fa-male' => array('name' => 'fa-male'),
            'fa-gratipay' => array('name' => 'fa-gratipay'),
            'fa-sun-o' => array('name' => 'fa-sun-o'),
            'fa-moon-o' => array('name' => 'fa-moon-o'),
            'fa-archive' => array('name' => 'fa-archive'),
            'fa-bug' => array('name' => 'fa-bug'),
            'fa-vk' => array('name' => 'fa-vk'),
            'fa-weibo' => array('name' => 'fa-weibo'),
            'fa-renren' => array('name' => 'fa-renren'),
            'fa-pagelines' => array('name' => 'fa-pagelines'),
            'fa-stack-exchange' => array('name' => 'fa-stack-exchange'),
            'fa-arrow-circle-o-right' => array('name' => 'fa-arrow-circle-o-right'),
            'fa-arrow-circle-o-left' => array('name' => 'fa-arrow-circle-o-left'),
            'fa-toggle-left' => array('name' => 'fa-toggle-left'),
            'fa-dot-circle-o' => array('name' => 'fa-dot-circle-o'),
            'fa-wheelchair' => array('name' => 'fa-wheelchair'),
            'fa-vimeo-square' => array('name' => 'fa-vimeo-square'),
            'fa-try' => array('name' => 'fa-try'),
            'fa-plus-square-o' => array('name' => 'fa-plus-square-o'),
            'fa-space-shuttle' => array('name' => 'fa-space-shuttle'),
            'fa-slack' => array('name' => 'fa-slack'),
            'fa-envelope-square' => array('name' => 'fa-envelope-square'),
            'fa-wordpress' => array('name' => 'fa-wordpress'),
            'fa-openid' => array('name' => 'fa-openid'),
            'fa-institution' => array('name' => 'fa-institution'),
            'fa-graduation-cap' => array('name' => 'fa-graduation-cap'),
            'fa-yahoo' => array('name' => 'fa-yahoo'),
            'fa-google' => array('name' => 'fa-google'),
            'fa-reddit' => array('name' => 'fa-reddit'),
            'fa-reddit-square' => array('name' => 'fa-reddit-square'),
            'fa-stumbleupon-circle' => array('name' => 'fa-stumbleupon-circle'),
            'fa-stumbleupon' => array('name' => 'fa-stumbleupon'),
            'fa-delicious' => array('name' => 'fa-delicious'),
            'fa-digg' => array('name' => 'fa-digg'),
            'fa-pied-piper' => array('name' => 'fa-pied-piper'),
            'fa-pied-piper-alt' => array('name' => 'fa-pied-piper-alt'),
            'fa-drupal' => array('name' => 'fa-drupal'),
            'fa-joomla' => array('name' => 'fa-joomla'),
            'fa-language' => array('name' => 'fa-language'),
            'fa-fax' => array('name' => 'fa-fax'),
            'fa-building' => array('name' => 'fa-building'),
            'fa-child' => array('name' => 'fa-child'),
            'fa-paw' => array('name' => 'fa-paw'),
            'fa-spoon' => array('name' => 'fa-spoon'),
            'fa-cube' => array('name' => 'fa-cube'),
            'fa-cubes' => array('name' => 'fa-cubes'),
            'fa-behance' => array('name' => 'fa-behance'),
            'fa-behance-square' => array('name' => 'fa-behance-square'),
            'fa-steam' => array('name' => 'fa-steam'),
            'fa-steam-square' => array('name' => 'fa-steam-square'),
            'fa-recycle' => array('name' => 'fa-recycle'),
            'fa-car' => array('name' => 'fa-car'),
            'fa-cab' => array('name' => 'fa-cab'),
            'fa-tree' => array('name' => 'fa-tree'),
            'fa-spotify' => array('name' => 'fa-spotify'),
            'fa-deviantart' => array('name' => 'fa-deviantart'),
            'fa-soundcloud' => array('name' => 'fa-soundcloud'),
            'fa-database' => array('name' => 'fa-database'),
            'fa-file-pdf-o' => array('name' => 'fa-file-pdf-o'),
            'fa-file-word-o' => array('name' => 'fa-file-word-o'),
            'fa-file-excel-o' => array('name' => 'fa-file-excel-o'),
            'fa-file-powerpoint-o' => array('name' => 'fa-file-powerpoint-o'),
            'fa-file-image-o' => array('name' => 'fa-file-image-o'),
            'fa-file-archive-o' => array('name' => 'fa-file-archive-o'),
            'fa-file-audio-o' => array('name' => 'fa-file-audio-o'),
            'fa-file-video-o' => array('name' => 'fa-file-video-o'),
            'fa-file-code-o' => array('name' => 'fa-file-code-o'),
            'fa-vine' => array('name' => 'fa-vine'),
            'fa-codepen' => array('name' => 'fa-codepen'),
            'fa-jsfiddle' => array('name' => 'fa-jsfiddle'),
            'fa-support' => array('name' => 'fa-support'),
            'fa-circle-o-notch' => array('name' => 'fa-circle-o-notch'),
            'fa-rebel' => array('name' => 'fa-rebel'),
            'fa-ge' => array('name' => 'fa-ge'),
            'fa-git-square' => array('name' => 'fa-git-square'),
            'fa-git' => array('name' => 'fa-git'),
            'fa-hacker-news' => array('name' => 'fa-hacker-news'),
            'fa-tencent-weibo' => array('name' => 'fa-tencent-weibo'),
            'fa-qq' => array('name' => 'fa-qq'),
            'fa-wechat' => array('name' => 'fa-wechat'),
            'fa-send' => array('name' => 'fa-send'),
            'fa-send-o' => array('name' => 'fa-send-o'),
            'fa-history' => array('name' => 'fa-history'),
            'fa-circle-thin' => array('name' => 'fa-circle-thin'),
            'fa-header' => array('name' => 'fa-header'),
            'fa-paragraph' => array('name' => 'fa-paragraph'),
            'fa-sliders' => array('name' => 'fa-sliders'),
            'fa-share-alt' => array('name' => 'fa-share-alt'),
            'fa-share-alt-square' => array('name' => 'fa-share-alt-square'),
            'fa-bomb' => array('name' => 'fa-bomb'),
            'fa-futbol-o' => array('name' => 'fa-futbol-o'),
            'fa-tty' => array('name' => 'fa-tty'),
            'fa-binoculars' => array('name' => 'fa-binoculars'),
            'fa-plug' => array('name' => 'fa-plug'),
            'fa-slideshare' => array('name' => 'fa-slideshare'),
            'fa-twitch' => array('name' => 'fa-twitch'),
            'fa-yelp' => array('name' => 'fa-yelp'),
            'fa-newspaper-o' => array('name' => 'fa-newspaper-o'),
            'fa-wifi' => array('name' => 'fa-wifi'),
            'fa-calculator' => array('name' => 'fa-calculator'),
            'fa-paypal' => array('name' => 'fa-paypal'),
            'fa-google-wallet' => array('name' => 'fa-google-wallet'),
            'fa-cc-visa' => array('name' => 'fa-cc-visa'),
            'fa-cc-mastercard' => array('name' => 'fa-cc-mastercard'),
            'fa-cc-discover' => array('name' => 'fa-cc-discover'),
            'fa-cc-amex' => array('name' => 'fa-cc-amex'),
            'fa-cc-paypal' => array('name' => 'fa-cc-paypal'),
            'fa-cc-stripe' => array('name' => 'fa-cc-stripe'),
            'fa-bell-slash' => array('name' => 'fa-bell-slash'),
            'fa-bell-slash-o' => array('name' => 'fa-bell-slash-o'),
            'fa-trash' => array('name' => 'fa-trash'),
            'fa-copyright' => array('name' => 'fa-copyright'),
            'fa-at' => array('name' => 'fa-at'),
            'fa-eyedropper' => array('name' => 'fa-eyedropper'),
            'fa-paint-brush' => array('name' => 'fa-paint-brush'),
            'fa-birthday-cake' => array('name' => 'fa-birthday-cake'),
            'fa-area-chart' => array('name' => 'fa-area-chart'),
            'fa-pie-chart' => array('name' => 'fa-pie-chart'),
            'fa-line-chart' => array('name' => 'fa-line-chart'),
            'fa-lastfm' => array('name' => 'fa-lastfm'),
            'fa-lastfm-square' => array('name' => 'fa-lastfm-square'),
            'fa-toggle-off' => array('name' => 'fa-toggle-off'),
            'fa-toggle-on' => array('name' => 'fa-toggle-on'),
            'fa-bicycle' => array('name' => 'fa-bicycle'),
            'fa-bus' => array('name' => 'fa-bus'),
            'fa-ioxhost' => array('name' => 'fa-ioxhost'),
            'fa-angellist' => array('name' => 'fa-angellist'),
            'fa-cc' => array('name' => 'fa-cc'),
            'fa-sheqel' => array('name' => 'fa-sheqel'),
            'fa-meanpath' => array('name' => 'fa-meanpath'),
            'fa-buysellads' => array('name' => 'fa-buysellads'),
            'fa-connectdevelop' => array('name' => 'fa-connectdevelop'),
            'fa-dashcube' => array('name' => 'fa-dashcube'),
            'fa-forumbee' => array('name' => 'fa-forumbee'),
            'fa-leanpub' => array('name' => 'fa-leanpub'),
            'fa-sellsy' => array('name' => 'fa-sellsy'),
            'fa-shirtsinbulk' => array('name' => 'fa-shirtsinbulk'),
            'fa-simplybuilt' => array('name' => 'fa-simplybuilt'),
            'fa-skyatlas' => array('name' => 'fa-skyatlas'),
            'fa-cart-plus' => array('name' => 'fa-cart-plus'),
            'fa-cart-arrow-down' => array('name' => 'fa-cart-arrow-down'),
            'fa-diamond' => array('name' => 'fa-diamond'),
            'fa-ship' => array('name' => 'fa-ship'),
            'fa-user-secret' => array('name' => 'fa-user-secret'),
            'fa-motorcycle' => array('name' => 'fa-motorcycle'),
            'fa-street-view' => array('name' => 'fa-street-view'),
            'fa-heartbeat' => array('name' => 'fa-heartbeat'),
            'fa-venus' => array('name' => 'fa-venus'),
            'fa-mars' => array('name' => 'fa-mars'),
            'fa-mercury' => array('name' => 'fa-mercury'),
            'fa-intersex' => array('name' => 'fa-intersex'),
            'fa-transgender-alt' => array('name' => 'fa-transgender-alt'),
            'fa-venus-double' => array('name' => 'fa-venus-double'),
            'fa-mars-double' => array('name' => 'fa-mars-double'),
            'fa-venus-mars' => array('name' => 'fa-venus-mars'),
            'fa-mars-stroke' => array('name' => 'fa-mars-stroke'),
            'fa-mars-stroke-v' => array('name' => 'fa-mars-stroke-v'),
            'fa-mars-stroke-h' => array('name' => 'fa-mars-stroke-h'),
            'fa-neuter' => array('name' => 'fa-neuter'),
            'fa-genderless' => array('name' => 'fa-genderless'),
            'fa-facebook-official' => array('name' => 'fa-facebook-official'),
            'fa-pinterest-p' => array('name' => 'fa-pinterest-p'),
            'fa-whatsapp' => array('name' => 'fa-whatsapp'),
            'fa-server' => array('name' => 'fa-server'),
            'fa-user-plus' => array('name' => 'fa-user-plus'),
            'fa-user-times' => array('name' => 'fa-user-times'),
            'fa-hotel' => array('name' => 'fa-hotel'),
            'fa-viacoin' => array('name' => 'fa-viacoin'),
            'fa-train' => array('name' => 'fa-train'),
            'fa-subway' => array('name' => 'fa-subway'),
            'fa-medium' => array('name' => 'fa-medium'),
            'fa-yc' => array('name' => 'fa-yc'),
            'fa-optin-monster' => array('name' => 'fa-optin-monster'),
            'fa-opencart' => array('name' => 'fa-opencart'),
            'fa-expeditedssl' => array('name' => 'fa-expeditedssl'),
            'fa-battery-full' => array('name' => 'fa-battery-full'),
            'fa-battery-three-quarters' => array('name' => 'fa-battery-three-quarters'),
            'fa-battery-half' => array('name' => 'fa-battery-half'),
            'fa-battery-quarter' => array('name' => 'fa-battery-quarter'),
            'fa-battery-empty' => array('name' => 'fa-battery-empty'),
            'fa-mouse-pointer' => array('name' => 'fa-mouse-pointer'),
            'fa-i-cursor' => array('name' => 'fa-i-cursor'),
            'fa-object-group' => array('name' => 'fa-object-group'),
            'fa-object-ungroup' => array('name' => 'fa-object-ungroup'),
            'fa-sticky-note' => array('name' => 'fa-sticky-note'),
            'fa-sticky-note-o' => array('name' => 'fa-sticky-note-o'),
            'fa-cc-jcb' => array('name' => 'fa-cc-jcb'),
            'fa-cc-diners-club' => array('name' => 'fa-cc-diners-club'),
            'fa-clone' => array('name' => 'fa-clone'),
            'fa-balance-scale' => array('name' => 'fa-balance-scale'),
            'fa-hourglass-o' => array('name' => 'fa-hourglass-o'),
            'fa-hourglass-start' => array('name' => 'fa-hourglass-start'),
            'fa-hourglass-half' => array('name' => 'fa-hourglass-half'),
            'fa-hourglass-end' => array('name' => 'fa-hourglass-end'),
            'fa-hourglass' => array('name' => 'fa-hourglass'),
            'fa-hand-stop-o' => array('name' => 'fa-hand-stop-o'),
            'fa-hand-scissors-o' => array('name' => 'fa-hand-scissors-o'),
            'fa-hand-lizard-o' => array('name' => 'fa-hand-lizard-o'),
            'fa-hand-spock-o' => array('name' => 'fa-hand-spock-o'),
            'fa-hand-pointer-o' => array('name' => 'fa-hand-pointer-o'),
            'fa-hand-peace-o' => array('name' => 'fa-hand-peace-o'),
            'fa-trademark' => array('name' => 'fa-trademark'),
            'fa-registered' => array('name' => 'fa-registered'),
            'fa-creative-commons' => array('name' => 'fa-creative-commons'),
            'fa-gg' => array('name' => 'fa-gg'),
            'fa-gg-circle' => array('name' => 'fa-gg-circle'),
            'fa-tripadvisor' => array('name' => 'fa-tripadvisor'),
            'fa-odnoklassniki' => array('name' => 'fa-odnoklassniki'),
            'fa-odnoklassniki-square' => array('name' => 'fa-odnoklassniki-square'),
            'fa-get-pocket' => array('name' => 'fa-get-pocket'),
            'fa-wikipedia-w' => array('name' => 'fa-wikipedia-w'),
            'fa-safari' => array('name' => 'fa-safari'),
            'fa-chrome' => array('name' => 'fa-chrome'),
            'fa-firefox' => array('name' => 'fa-firefox'),
            'fa-opera' => array('name' => 'fa-opera'),
            'fa-internet-explorer' => array('name' => 'fa-internet-explorer'),
            'fa-tv' => array('name' => 'fa-tv'),
            'fa-contao' => array('name' => 'fa-contao'),
            'fa-500px' => array('name' => 'fa-500px'),
            'fa-amazon' => array('name' => 'fa-amazon'),
            'fa-calendar-plus-o' => array('name' => 'fa-calendar-plus-o'),
            'fa-calendar-minus-o' => array('name' => 'fa-calendar-minus-o'),
            'fa-calendar-times-o' => array('name' => 'fa-calendar-times-o'),
            'fa-calendar-check-o' => array('name' => 'fa-calendar-check-o'),
            'fa-industry' => array('name' => 'fa-industry'),
            'fa-map-pin' => array('name' => 'fa-map-pin'),
            'fa-map-signs' => array('name' => 'fa-map-signs'),
            'fa-map-o' => array('name' => 'fa-map-o'),
            'fa-map' => array('name' => 'fa-map'),
            'fa-commenting' => array('name' => 'fa-commenting'),
            'fa-commenting-o' => array('name' => 'fa-commenting-o'),
            'fa-houzz' => array('name' => 'fa-houzz'),
            'fa-vimeo' => array('name' => 'fa-vimeo'),
            'fa-black-tie' => array('name' => 'fa-black-tie'),
            'fa-fonticons' => array('name' => 'fa-fonticons'),
            'fa-reddit-alien' => array('name' => 'fa-reddit-alien'),
            'fa-edge' => array('name' => 'fa-edge'),
            'fa-credit-card-alt' => array('name' => 'fa-credit-card-alt'),
            'fa-codiepie' => array('name' => 'fa-codiepie'),
            'fa-modx' => array('name' => 'fa-modx'),
            'fa-fort-awesome' => array('name' => 'fa-fort-awesome'),
            'fa-usb' => array('name' => 'fa-usb'),
            'fa-product-hunt' => array('name' => 'fa-product-hunt'),
            'fa-mixcloud' => array('name' => 'fa-mixcloud'),
            'fa-scribd' => array('name' => 'fa-scribd'),
            'fa-pause-circle' => array('name' => 'fa-pause-circle'),
            'fa-pause-circle-o' => array('name' => 'fa-pause-circle-o'),
            'fa-stop-circle' => array('name' => 'fa-stop-circle'),
            'fa-stop-circle-o' => array('name' => 'fa-stop-circle-o'),
            'fa-shopping-bag' => array('name' => 'fa-shopping-bag'),
            'fa-shopping-basket' => array('name' => 'fa-shopping-basket'),
            'fa-hashtag' => array('name' => 'fa-hashtag'),
            'fa-bluetooth' => array('name' => 'fa-bluetooth'),
            'fa-bluetooth-b' => array('name' => 'fa-bluetooth-b'),
            'fa-percent' => array('name' => 'fa-percent'));

        /**
         * Enqueue scripts and styles.
         *
         * Ideally these would get registered and given proper paths before this control object
         * gets initialized, then we could simply enqueue them here, but for completeness as a
         * stand alone class we'll register and enqueue them here.
         */
        public function enqueue() {
            wp_enqueue_style('one-page-font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.css');
            wp_enqueue_style('one-page-glyphicons', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
            wp_enqueue_script('one-page-glyphicons-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.js');
            wp_enqueue_script('one-page-customizer-js', get_stylesheet_directory_uri() . '/assets/js/customizer.js');
        }

        /**
         * Render Settings
         */
        public function render_content() {
            ?>
            <label>
                <?php
                // Output the label and description if they were passed in.
                if (isset($this->label) && '' !== $this->label) {
                    echo '<span class="customize-control-title">' . sanitize_text_field($this->label) . '</span>';
                }
                if (isset($this->description) && '' !== $this->description) {
                    echo '<span class="description customize-control-description">' . sanitize_text_field($this->description) . '</span>';
                }
                ?>
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="IconMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <li class="active active_icon"><i class="<?php echo $this->value(); ?> fa-2x"></i></li>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu icon_pool" aria-labelledby="IconMenu">
                        <?php foreach ($this->fa_icons as $key => $value) { ?>
                            <li><i class="fa <?php echo wp_kses_post($value['name']); ?>"></i></li>
                        <?php }
                        ?>
                        <li class="ink-hideme">
                            <input class="selected_icon"  type="hidden" <?php $this->link(); ?> value="<?php echo $this->value(); ?>" /> 
                        </li>
                    </ul>

                </div>
            </label>

            <?php
        }

    }

    /**
     * Controller to editor 
     */
    class Custom_Section_Editor extends WP_Customize_Control {

        public $type = 'custom_sec_editor';

        /**
         * @return string
         */
        public function filter_editor_setting_link($output) {
            return preg_replace('/<textarea/', '<textarea ' . $this->get_link(), $output, 1);
        }
        

        /**
         * Render the control.
         */
        public function render_content() {
            ?>
            <label>
                <?php
                // Output the label and description if they were passed in.
                if (isset($this->label) && '' !== $this->label) {
                    echo '<span class="customize-control-title">' . sanitize_text_field($this->label) . '</span>';
                }
                if (isset($this->description) && '' !== $this->description) {
                    echo '<span class="description customize-control-description">' . sanitize_text_field($this->description) . '</span>';
                }
                ?>
                <div class="cc_editor">
                    <?php
//                        $settings = array(
//                            'textarea_name' => $this->id,
////                            'teeny' => true,
//                        );
                    $settings = array(
                        'textarea_name' => $this->id,
                        'media_buttons' => true,
                        'tinymce' => true,
                        'teeny' => true,
                        'quicktags' => true,
                        'drag_drop_upload' => true
                    );
                    add_filter('the_editor', array($this, 'filter_editor_setting_link'));
                    wp_editor(html_entity_decode(wp_kses_post($this->value())), $this->id, $settings);
                    do_action('admin_footer');
                    do_action('admin_print_footer_scripts');
                    ?>
                </div>
            </label>
            <?php
        }

    }

}

/**
 * Services
 * list of available sharing services
 */
function onepage_sections() {

    $sections = array();

    $sections['service_section'] = array(
        'id' => 'service_section',
        'label' => __('Service Section', 'one-page'),
        'callback' => 'onepage_service_section',
    );

    $sections['blog_section'] = array(
        'id' => 'blog_section',
        'label' => __('Blog Section', 'one-page'),
        'callback' => 'onepage_blog_section',
    );

    $sections['gallery_section'] = array(
        'id' => 'gallery_section',
        'label' => __('Video Section', 'one-page'),
        'callback' => 'onepage_video_section',
    );

    $sections['portfolio_section'] = array(
        'id' => 'portfolio_section',
        'label' => __('Portfolio Section', 'one-page'),
        'callback' => 'onepage_portfolio_section',
    );

    $sections['testimonial_section'] = array(
        'id' => 'testimonial_section',
        'label' => __('Testimonials Section', 'one-page'),
        'callback' => 'onepage_testimonial_section',
    );

    $sections['price_section'] = array(
        'id' => 'price_section',
        'label' => __('Price Section', 'one-page'),
        'callback' => 'onepage_price_section',
    );

    $sections['team_section'] = array(
        'id' => 'team_section',
        'label' => __('Team Section', 'one-page'),
        'callback' => 'onepage_team_section',
    );

    $sections['contact_section'] = array(
        'id' => 'contact_section',
        'label' => __('Contact Us Section', 'one-page'),
        'callback' => 'onepage_contact_section',
    );

    return apply_filters('onepage_sections', $sections);
}

/**
 * Utility: Default Services to use in customizer default value
 * @return string
 */
function onepage_sections_default() {
    $default = array();
    $sections = onepage_sections();
    foreach ($sections as $section) {
        $default[] = $section['id'] . ':1'; /* activate all as default. */
    }
    return apply_filters('onepage_sections_default', implode(',', $default));
}

/**
 * Share Template Tags
 * the final function with the conditional.
 */
function onepage_section_show() {

    /* Get the options */
    $option = get_option('onepage_options');

    /* Check Services */
    $sections = onepage_sections_default();
    if (isset($option['onepage_sort'])) {
        $sections = $option['onepage_sort'];
    }
    if (!$sections)
        return;

    /* render button */
    return apply_filters('onepage_section_show', onepage_get_section($sections));
}

/**
 * Return Share buttons HTML based on Options
 * @param $options string formatted active services
 */
function onepage_get_section($options) {

    /* bail if empty. */
    if (!$options)
        return;

    /* available services */
    $sections = onepage_sections();

    /* var. */
    $buttons = array();

    /* make array */
    $options = explode(',', $options);

    /* loop load */
    foreach ($options as $option) {
        $option = explode(':', $option);
        if (isset($option[0]) && isset($option[1]) && array_key_exists($option[0], $sections) && '1' == $option[1]) {
            $buttons[] = $option[0];
        }
    }

    /* bail if not found. */
    if (!$buttons)
        return;
    foreach ($buttons as $button) {
        $fn_callback = $sections[$button]['callback'];
        if (function_exists($fn_callback)) {
            call_user_func($fn_callback);
        }
    }
}

function onepage_service_section() {
    get_template_part('templates/homepage', 'services');
}

function onepage_blog_section() {
    get_template_part('templates/homepage', 'blogs');
}

function onepage_video_section() {
    get_template_part('templates/homepage', 'videos');
}

function onepage_testimonial_section() {
    get_template_part('templates/homepage', 'testimonials');
}

function onepage_portfolio_section() {
    get_template_part('templates/homepage', 'hexGallery');
}

function onepage_price_section() {
    get_template_part('templates/homepage', 'pricing');
}

function onepage_team_section() {
    get_template_part('templates/homepage', 'teams');
}

function onepage_contact_section() {
    get_template_part('templates/homepage', 'contactUs');
}
