<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <?php if (is_front_page()): ?>
        <title>Accueil | <?php bloginfo( 'name' ); ?></title>
    <?php else: ?>
        <title><?php wp_title(); ?> | <?php bloginfo( 'name' ); ?></title>
    <?php endif ?>
    <link rel="shortcut icon" type="image/png" href="<?= get_stylesheet_directory_uri(); ?>/img/icons8-bulle.svg" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Navbar</a>
            <?php
            wp_nav_menu( array(
                'theme_location'    => 'menu-principal',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ) );
            ?>
        </div>
    </nav>

    <div class="bandeau">
        <img src="<?= get_template_directory_uri() ?>/img/miikka-luotio-Z8pDFNfS5xA-unsplash-1920x1280.jpg" alt="bandeau">
        <?php if (is_front_page()): ?>
            <h2>Accueil</h2>
        <?php else: ?>
            <h2><?php wp_title(); ?></h2>
        <?php endif ?>
    </div>
</header>
