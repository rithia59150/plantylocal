<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra Child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_ASTRA_CHILD_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_ASTRA_CHILD_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

// Fonction pour ajouter le lien "Admin" dans le menu pour les utilisateurs connectés
function add_admin_link_to_menu( $items, $args ) {
    // Vérifiez si l'utilisateur est connecté
    if ( is_user_logged_in() && ($args->theme_location == 'primary' || $args->theme_location == 'mobile_menu') ) {
        // Créez le lien "Admin"
        $admin_link = '<li class="menu-item"><a href="' . admin_url() . '">Admin</a></li>';
        
        // Positionner le lien "Admin" entre "Nous rencontrer" et "Commander"
        $menu_items = explode('</li>', $items);
        $new_items = [];
        $admin_added = false;
        
        foreach ($menu_items as $index => $menu_item) {
            // Ajouter chaque élément au tableau des nouveaux éléments
            $new_items[] = $menu_item;
            // Ajouter le lien "Admin" après le lien "Nous rencontrer"
            if (strpos($menu_item, 'Nous rencontrer') !== false && !$admin_added) {
                $new_items[] = $admin_link;
                $admin_added = true;
            }
        }
        
        // Reconstituer les éléments du menu
        $items = implode('</li>', $new_items);
    }
    
    return $items;
}
add_filter( 'wp_nav_menu_items', 'add_admin_link_to_menu', 10, 2 );












