<?php

/**
 * The header for Veolia Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?php bloginfo('veolia'); ?></title>
    <?php wp_head(); ?>
    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
    <link rel="manifest" href="img/favicons/site.webmanifest">
    <link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg" color="#cc2229">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    
</head>

<body>


    <div class="hero d-flex w-100 h-100 mx-auto flex-column pb-5" id="veolia_header_banner_wrapper" <?php if (get_current_slug() == '') { ?> style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/assets/images/cover-001.webp'); ?>');background-repeat: no-repeat;background-position:top center;background-size:cover; background-attachment:fixed" <?php } else {
                                                                                                                                                                                                                                                                                                                                                echo '';
                                                                                                                                                                                                                                                                                                                                            } ?>>
        <header class="">
            <div class="top-nav py-2">
                <div class="container">
                    <div class="d-flex flex-wrap justify-content-end">

                        <div class="veolia-primary-menu">
                            <?php wp_nav_menu(array('menu_class' => 'nav nav-pills align-items-center', 'container' => 'ul', 'theme_location' => 'primaryVeoliaHeaderMenu')); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tile-nav">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-start justify-content-center justify-content-lg-start">
                    <?php                                                                                                                                                                                                                                                                                                                                            
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $image = wp_get_attachment_image_src($custom_logo_id, 'full'); ?>
                        <a href="<?= esc_url(home_url()); ?>" class="navbar-brand d-flex align-items-center me-lg-auto"> <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo-tab-bg.png'); ?>" alt="" />
                        <img src="<?php echo isset($image[0]) ? $image[0] : esc_url(get_template_directory_uri() . '/assets/images/logo-tab.svg'); ?>" class="header-logo" alt="" /> </a>
                        <?php // theme_prefix_the_custom_logo(); ?>  
                        <?php // theme_prefix_the_custom_logo(); ?>  
                                                                                                                                                                                                                                                                                                                                    
                        <ul class="nav col-12 col-lg-auto py-2 my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a href="<?= esc_url(home_url()); ?>" class="nav-link <?= get_current_slug() == '' ? 'active' : ''; ?> "> <i class="fal fa-home"></i> Home </a>
                            </li>
                            <li>
                                <a href="<?= esc_url(home_url() . '/course-list'); ?>" class="nav-link <?= get_current_slug() == 'course-list' ? 'active' : ''; ?> "> <i class="fal fa-chalkboard-teacher"></i> Find a Course </a>
                            </li>
                            <li>
                                <a href="<?= esc_url(home_url() . '/course-approvals'); ?>" class="nav-link <?= get_current_slug() == 'course-approvals' ? 'active' : ''; ?>"> <i class="fal fa-check-circle"></i> Check My State </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php // get_search_form(true); ?>
        </header>
        <div class="banner container">
            <div class="row mt-4">
                <div class="col-md-10 col-xl-8 col-xxl-6">
                    <h1 class="mb-4">Payment Status</h1>
                  
                    <p class="lead mb-4"><?php try{ echo CFS()->get( 'short_description' ); }catch (Error $e) {} ?></p>
                </div>
            </div>
        </div>
    </div>
    