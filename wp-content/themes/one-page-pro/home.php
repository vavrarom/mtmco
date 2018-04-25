<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_header();

/**
 * Including sliders section 
 */
echo get_template_part('templates/homepage', 'sliders');
/**
 * Including sliders section 
 */
dynamic_sidebar('hp-section-sorting-widget-area');
get_footer();
