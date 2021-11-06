<?php

if ( ! function_exists( 'models_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function models_setup() {

        add_theme_support( 'admin-bar', [ 'callback' => '__return_false' ] );

        add_theme_support( 'html5' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        add_post_type_support( 'page', 'excerpt' );

        register_nav_menus( [ 'primary_menu' => 'Primary Menu' ] );

    }
endif;
add_action( 'after_setup_theme', 'models_setup' );

function rhs_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'rhs_content_width', 640 );
}
add_action( 'after_setup_theme', 'rhs_content_width', 0 );

/**
 * Register widget area.
 */
function rhs_widgets_init() {
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Add widgets here.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'rhs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mdlua_scripts() {
    wp_enqueue_style( 'mdlua-style', get_stylesheet_uri(), array(), null );

    wp_enqueue_style( 'mdlua-css', get_template_directory_uri() . '/css/main.css', array(), '0.0.17' );

    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'mdlua-js', get_template_directory_uri() . '/js/main.js', array(), '0.0.17' );
}
add_action( 'wp_enqueue_scripts', 'mdlua_scripts' );

/**
 * Disable excess
 */
function disable_excess() {
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}
add_action('init', 'disable_excess');

/**
 * Disable Emoji
 */
function disable_emoji() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emoji_tinymce' );
}
function disable_emoji_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
add_action( 'init', 'disable_emoji' );

function new_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'catalog', 320, 420, array( 'center', 'center') );
    add_image_size( 'similar', 440, 620, array( 'center', 'center') );
    add_image_size( 'slideBig', 875, 875, array( 'center', 'top') );
    add_image_size( 'slideSmall', 250, 310, array( 'center', 'center') );
}
function new_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'catalog' => 'Размер 320x420',
        'similar' => 'Размер 440x620',
        'slideBig' => 'Размер 875x875',
        'slideSmall' => 'Размер 250x310',
    ) );
}
add_filter( 'image_size_names_choose', 'new_custom_sizes' );
