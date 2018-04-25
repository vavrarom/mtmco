<?php

class Hp_Video_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    static $instance;

    function __construct() {
        parent::__construct(
                'video_section', // Base ID
                __('Video Section', 'one-page'), // Name
                array('description' => __('Homepage Video Section', 'one-page'),) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
//        if (!Hp_Video_Widget::$instance) {
//            Hp_Video_Widget::$instance = true;
//        }
//        // abort silently for the second instance of the widget
//        else {
//            return;
//        }
        get_template_part('templates/homepage', 'videos');
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
}

// class Hp_Video_Widget
// register Hp_Video_Widget widget
function register_videos_section() {
    register_widget('Hp_Video_Widget');
}

add_action('widgets_init', 'register_videos_section');
