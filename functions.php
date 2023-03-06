<?php

/**
 * composer
 */

// chargement de l'autoloading de composer
require get_template_directory().'/vendor/autoload.php';

/**
 * sécurité
 */

// désactive l'édition de fichier dans l'admin
define( 'DISALLOW_FILE_EDIT', true );

/**
 * localisation
 */

// choix du fuseau horaire
date_default_timezone_set( 'Europe/Paris' );
// choix du réglage régional
setlocale( LC_ALL, 'fr', 'fr_FR', 'fr_FR.utf8', 'fr_FR.ISO_8859-1' );

/**
 * CSS
 */

// cette fonction se charge d'intégrer les feuilles de style du thème
function my_theme_enqueue_styles() {
    // affiche la liste des feuilles de style qui seront chargées
    // $wp_styles = wp_styles();
    // var_dump($wp_styles->queue);
    // affiche des infos détaillées sur chaque feuille de style
    // foreach( $wp_styles->queue as $handle ) {
    //     var_dump($wp_styles->registered[$handle]);
    // }

    // chargement de bootstrap via un cdn
    wp_enqueue_style( 'my-theme-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', [] );

    // // chargement d'un fichier CSS
    wp_enqueue_style( 'my-theme-main', get_stylesheet_directory_uri().'/style.css', ['my-theme-bootstrap'] );

    // chargement de bootstrap via un cdn
    // wp_enqueue_style( 'my-theme-materialize', get_stylesheet_directory_uri().'/node_modules/materialize-css/dist/css/materialize.min.css', [] );

    // chargement d'un fichier CSS
    // wp_enqueue_style( 'my-theme-main', get_stylesheet_directory_uri().'/style.css', ['my-theme-materialize'] );
}

// demande à Wordpress de lancer la fonction `my_theme_enqueue_styles` durant le démarrage de l'application
// PHP_INT_MAX est le niveau de priorité, plus ce nombre est grand et moins la priorité est élevée
// le niveau de priorité par défaut est 10
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', PHP_INT_MAX );

/**
 * JS
 */

// cette fonction se charge d'intégrer les scripts JS du thème
function my_theme_enqueue_scripts() {
    // affiche la liste des scripts qui seront chargées
    // $wp_scripts = wp_scripts();
    // var_dump($wp_scripts->queue);
    // affiche des infos détaillées sur chaque script
    // foreach( $wp_scripts->queue as $handle ) {
    //     var_dump($wp_scripts->registered[$handle]);
    // }

    // chargement de bootstrap via un cdn
    wp_enqueue_script( 'my-theme-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', [] );

    // chargement d'un fichier JS
    wp_enqueue_script( 'my-theme-main', get_stylesheet_directory_uri().'/js/main.js', ['my-theme-bootstrap'] );

    // chargement de bootstrap via un cdn
    // wp_enqueue_script( 'my-theme-materialize', get_stylesheet_directory_uri().'/node_modules/materialize-css/dist/js/materialize.min.js', [] );

    // chargement d'un fichier JS
    // wp_enqueue_script( 'my-theme-main', get_stylesheet_directory_uri().'/js/main.js', ['my-theme-materialize'] );
}

// demande à Wordpress de lancer la fonction `my_theme_enqueue_scripts` durant le démarrage de l'application
// PHP_INT_MAX est le niveau de priorité, plus ce nombre est grand et moins la priorité est élevée
// le niveau de priorité par défaut est 10
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts', PHP_INT_MAX );

/**
 * fonctionnalités du thème
 */

// activation de la fonctionnalité des balises HTML5
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
// activation de la fonctionnalité du titre du site
add_theme_support( 'title-tag' );
// activation de la fonctionnalité des vignettes
add_theme_support( 'post-thumbnails' );

/**
 * menu
 */

// chargement du walker de wp-bootstrap-navwalker
function register_navwalker(){
	require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

// déclaration des zones de menu
function my_theme_register_nav_menus() {
    register_nav_menus([
        // menu principal
        'menu-principal' => 'Menu principal',
        // menu du footer
        'menu-footer' => 'Menu footer',
    ]);
}
add_action( 'init', 'my_theme_register_nav_menus' );

// adaptation du menu pour bootstrap 5
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
    if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
        if ( array_key_exists( 'data-toggle', $atts ) ) {
            unset( $atts['data-toggle'] );
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );

/**
 * widgets
 */

// déclaration des zones de widgets
function my_theme_register_sidebars() {
    // carte
    register_sidebar(
        array(
            'id'            => 'map',
            'name'          => 'Carte',
            'description'   => "Cet encart sert à afficher une carte.",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'my_theme_register_sidebars' );
