<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if (is_singular() && pings_open(get_queried_object())) : ?>
            <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body id="page-top" <?php body_class('index'); ?>>
        <?php
        if (onepage_get_option('onepage_theme_layout', 'fullwidth') == 'boxed'):
            echo "<div class='box_container'>";
        endif;
        ?>

        <!-- Header Content -->
        <div class="header">
            <div class="header-container">
                <div class="toggle_strip"></div>
                <div id="home" class="top_strip">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="top_left_contact">
                                    <span class="glyphicon <?php echo wp_kses_post(onepage_get_option('onepage_top_call_us_icon', 'fa fa-phone')); ?>"></span>
                                    <p><?php echo wp_kses_post(onepage_get_option('onepage_top_call_us', __('Call us on 44 7700 900693', 'one-page'))); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="social_icon_wrapper">
                                    <ul>
                                        <?php if (onepage_get_option('onepage_fb_link') != '') { ?>
                                            <li>
                                                <a class="fb" href="<?php echo esc_url(onepage_get_option('onepage_fb_link')); ?>" title="FaceBook" target="_blank"><i class="fa fa-fw fa-facebook"></i></a>
                                            </li>
                                            <?php
                                        }
                                        if (onepage_get_option('onepage_tw_link') != '') {
                                            ?>
                                            <li>
                                                <a class="tw" href="<?php echo esc_url(onepage_get_option('onepage_tw_link')); ?>" title="Twitter"><i class="fa fa-fw fa-twitter" target="_blank"></i></a>
                                            </li>
                                            <?php
                                        }
                                        if (onepage_get_option('onepage_g_plus_link') != '') {
                                            ?>
                                            <li>
                                                <a class="gp" href="<?php echo esc_url(onepage_get_option('onepage_g_plus_link')); ?>" title="Google Plus"><i class="fa fa-fw fa-google-plus" target="_blank"></i></a>
                                            </li>
                                            <?php
                                        }
                                        if (onepage_get_option('onepage_rss_link') != '') {
                                            ?>
                                            <li>
                                                <a class="rss" href="<?php echo esc_url(onepage_get_option('onepage_rss_link')); ?>" title="RSS"><i class="fa fa-fw fa-rss" target="_blank"></i></a>
                                            </li>
                                            <?php
                                        }
                                        if (onepage_get_option('onepage_pinterest_link') != '') {
                                            ?>
                                            <li>
                                                <a class="pn" href="<?php echo esc_url(onepage_get_option('onepage_pinterest_link')); ?>" title="Pinterest"><i class="fa fa-pinterest-p" target="_blank"></i></a>
                                            </li>
                                            <?php
                                        }
                                        if (esc_url(onepage_get_option('onepage_ln_link') != '')) {
                                            ?>
                                            <li>
                                                <a class="ln" href="<?php echo esc_url(onepage_get_option('onepage_ln_link')); ?>" title="LinkedIn"><i class="fa fa-fw fa-linkedin" target="_blank"></i></a>
                                            </li>
                                            <?php
                                        }
                                        if (onepage_get_option('onepage_header_social_icon_shortcode') != ''):
                                            echo do_shortcode(onepage_get_option('onepage_header_social_icon_shortcode'));
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix top"></div>
                <!-- Navigation -->
                <nav class="navbar navbar-default main-menu">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="logo">
                                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">                                <?php
                                        $logo_text = wp_kses_post(onepage_get_option('onepage_display_header_text', false));
                                        if ($logo_text == true) {
                                            ?>
                                            <h1 class='logo_text'><?php wp_kses_post(bloginfo('name')); ?></h1>
                                            <?php
                                            $description = get_bloginfo('description');
                                            if ($description) {
                                                echo '<p class="site-description">' . wp_kses_post($description) . '</p>';
                                            }
                                        } else {
                                            echo "<img src='" . esc_url(onepage_get_option('onepage_header_logo_img', ONEPAGE_DIR_URI . 'assets/images/site_logo.png')) . "' alt='logo' />";
                                        }
                                        ?></a>
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                </div>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="col-md-8">
                                <div class="menu_wrapper">
                                    <div id="MainNav">
                                        <div id="menu" class="menu-menu-1-container">
                                            <div class="collapse navbar-collapse nav-menu" id="bs-example-navbar-collapse-1">
                                                <?php
                                                if (is_front_page()) {
                                                    onepage_front_nav();
                                                } else {
                                                    onepage_subpage_menu_nav();
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </div>
        </div>
        <!-- /Header Content -->

