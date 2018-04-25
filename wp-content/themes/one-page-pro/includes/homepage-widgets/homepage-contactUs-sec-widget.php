<?php


class Hp_ContactUs_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    static $instance;

    function __construct() {
        parent::__construct(
                'contactus_section', // Base ID
                __('Contact Us Section', 'one-page'), // Name
                array('description' => __('Homepage Contact Us Section', 'one-page'),) // Args
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
//        if (!Hp_ContactUs_Widget::$instance) {
//            Hp_ContactUs_Widget::$instance = true;
//        }
//        // abort silently for the second instance of the widget
//        else {
//            return;
//        }
        get_template_part('templates/homepage', 'contactUs');
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
function register_contactUs_section() {
    register_widget('Hp_ContactUs_Widget');
}

add_action('widgets_init', 'register_contactUs_section');
