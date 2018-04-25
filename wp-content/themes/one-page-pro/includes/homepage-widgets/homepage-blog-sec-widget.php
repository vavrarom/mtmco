<?php

class Hp_Blog_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    static $instance;

    function __construct() {
        parent::__construct(
                'blogs_section', // Base ID
                __('Blog Section', 'one-page'), // Name
                array('description' => __('Homepage Blog Section', 'one-page'),) // Args
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
        update_option('blog_instance',  $args['widget_id']);
//        if (!Hp_Blog_Widget::$instance) {
//            Hp_Blog_Widget::$instance = true;
//        }
//        // abort silently for the second instance of the widget
//        else {
//            return;
//        }
        get_template_part('templates/homepage', 'blogs');
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
}

// class Foo_Widget
// register Foo_Widget widget
function register_blogs_section() {
    register_widget('Hp_Blog_Widget');
}

add_action('widgets_init', 'register_blogs_section');
