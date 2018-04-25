<!-- Footer -->
<?php
if (onepage_get_option('footer_sidebar_section_OnOff', 'off') == 'on'):

    if (is_active_sidebar('first-footer-widget-area') || is_active_sidebar('second-footer-widget-area') || is_active_sidebar('third-footer-widget-area') || is_active_sidebar('fourth-footer-widget-area')) :
        ?>
        <div class="footer_wrapper">
            <div class="footer" <?php echo "style='background-color:" . onepage_get_option('onepage_footer_sidebar_bg_color', '#111') . "'"; ?>>
                <div class="container">
                    <div class="row">
                        <?php
                        /* A sidebar in the footer? Yep. You can can customize
                         * your footer with four columns of widgets.
                         */
                        get_sidebar('footer');
                        ?>
                    </div>
                </div>
            </div>
            <?php
        endif;
    endif;
    if (onepage_get_option('footer_bottom_section_OnOff', 'on') == 'on'):
        ?>
        <!--</div>-->
        <div class="bottom_footer" <?php echo "style='background-color:" . onepage_get_option('onepage_footer_bg_color', '#0d141b') . "'"; ?>>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="<?php echo onepage_get_option('onepage_footer_logo_img', ONEPAGE_DIR_URI . 'assets/images/site_logo.png'); ?>" alt='footer logo' />
                        <?php if (onepage_get_option('footer_social_icon_OnOff', 'on') == 'on'): ?>
                            <ul class="footer_social">
                                <?php if (onepage_get_option('onepage_fb_link') != '') { ?>
                                    <li>
                                        <a class="fb animated bounce" href="<?php echo esc_url(onepage_get_option('onepage_fb_link')); ?>" title="FaceBook" style="animation-delay: .2s" target="_blank"><i class="fa fa-fw fa-facebook"></i></a>
                                    </li>
                                    <?php
                                }
                                if (onepage_get_option('onepage_tw_link') != '') {
                                    ?>
                                    <li>
                                        <a class="tw animated bounce" href="<?php echo esc_url(onepage_get_option('onepage_tw_link')); ?>" title="Twitter" style="animation-delay: .4s" target="_blank"><i class="fa fa-fw fa-twitter"></i></a>
                                    </li>
                                    <?php
                                }
                                if (onepage_get_option('onepage_g_plus_link') != '') {
                                    ?>
                                    <li>
                                        <a class="gp animated bounce" href="<?php echo esc_url(onepage_get_option('onepage_g_plus_link')); ?>" title="Google Plus" style="animation-delay: .6s" target="_blank"><i class="fa fa-fw fa-google-plus"></i></a>
                                    </li>
                                    <?php
                                }
                                if (onepage_get_option('onepage_rss_link') != '') {
                                    ?>
                                    <li>
                                        <a class="rss animated bounce" href="<?php echo esc_url(onepage_get_option('onepage_rss_link')); ?>" title="RSS" style="animation-delay: .8s" target="_blank"><i class="fa fa-fw fa-rss"></i></a>
                                    </li>
                                    <?php
                                }
                                if (onepage_get_option('onepage_pinterest_link') != '') {
                                    ?>
                                    <li>
                                        <a class="pn animated bounce" href="<?php echo esc_url(onepage_get_option('onepage_pinterest_link')); ?>" title="Pinterest" style="animation-delay: 1s" target="_blank"><i class="fa fa-pinterest-p"></i></a>
                                    </li>
                                    <?php
                                }
                                if (onepage_get_option('onepage_ln_link') != '') {
                                    ?>
                                    <li>
                                        <a class="ln animated bounce" href="<?php echo esc_url(onepage_get_option('onepage_ln_link')); ?>" title="LinkedIn" style="animation-delay: 1.2s" target="_blank"><i class="fa fa-fw fa-linkedin"></i></a>
                                    </li>
                                    <?php
                                }
                                if (onepage_get_option('onepage_footer_social_icon_shortcode') != ''):
                                    echo do_shortcode(onepage_get_option('onepage_footer_social_icon_shortcode'));
                                endif;
                                ?>
                            </ul>
                        <?php endif; ?>
                        <p><?php echo wp_kses_post(onepage_get_option('onepage_footer_copyright_text', 'Copyright &copy; InkThemes.com')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#0" class="cd-top"><span class="glyphicon glyphicon-chevron-up"></span></a>
        <?php
    endif;
    wp_footer();
    ?>
    <?php
    if (onepage_get_option('onepage_theme_layout', 'fullwidth') == 'boxed'):
        echo "</div>";
    endif;
    ?>

</body>
</html>