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


    <div class="hero d-flex w-100 h-100 mx-auto flex-column pb-5">
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
        </header>
        <?php $learning_track = $args['learning_track']; ?>
        <div class="banner container">
            <div class="row mt-3 justify-content-center align-content-center">
                <div class="col-md-8 col-xl-8 col-xxl-6">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('course-list'); ?>">Courses</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $learning_track['contentItem']['title']; ?></li>
                        </ol>
                    </nav>
                    <h2 class="mb-3"><?php echo $learning_track['contentItem']['title']; ?></h2>
                    <?php 
                        $description = '';
                        if(isset($learning_track['contentItem']['description']) && $learning_track['contentItem']['description']!='')
                            $description = limit_desc($learning_track['contentItem']['description'],150);
                    ?>
                    <p class="lead mb-3"><?php echo $description; ?></p>
                    <ul class="list-unstyled">
                        <li>Instructor: <span><?php echo $learning_track['learning_track_mapping']['instructor']; ?></span></li>
                        <li>Created by: <a href="<?php echo site_url(); ?>">Veolia Academy</a></li>
                        <?php
                                    $date = date_create($learning_track['contentItem']['addedDate']);
                                    $date = date_format($date, "m/d/Y");
                                    ?>
                        <li><span class="pe-3"><i class="far fa-calendar-exclamation pe-1"></i> Last updated <?php echo $date; ?></span></li>
                    </ul>
                </div>
                <div class="col-md-4 col-xl-4 col-xxl-3">
                    <div class="card"> <img alt="Learning Path Image" src="<?php echo $learning_track['learning_track_mapping']['image_url']; ?>" class="card-img-top img-fluid">
                        <div class="card-footer">
                            <p>Obtain or renew your <?php echo $learning_track['contentItem']['title']; ?> certification</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    function limit_desc($string, $limit)
	{
        if(is_array($string))
           return '';
		$string = strip_tags($string);
		if (strlen($string) > $limit) {

			// truncate string
			$stringCut = substr($string, 0, $limit);
			$endPoint = strrpos($stringCut, ' ');

			//if the string doesn't contain any space then it will cut without word basis.
			$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
			$string .= '';
		}
		return $string;
	}
    ?>