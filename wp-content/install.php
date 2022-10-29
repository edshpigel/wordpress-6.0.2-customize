<?php

function wp_install_defaults()
{
    global $wpdb;

    // vars for default install  
    $theme_name = 'theme';

    // Default category
    $cat_name = $wpdb->escape(__('Uncategorized'));
    $cat_slug = sanitize_title(_c('Uncategorized|Default category slug'));
    // Delete zero post and pages
    $wpdb->query("INSERT INTO $wpdb->terms (name, slug, term_group) VALUES ('$cat_name', '$cat_slug', '0')");
    $wpdb->query("INSERT INTO $wpdb->term_taxonomy (term_id, taxonomy, description, parent, count) VALUES ('1', 'category', '', '0', '1')");

    // update theme site
    update_option('template', $theme_name);
    update_option('stylesheet', $theme_name);

    // activate plugins
    activate_plugin('advanced-custom-fields-pro/acf.php');
    activate_plugin('acf-extended-pro/acf-extended.php');
    activate_plugin('classic-editor/classic-editor.php');
}
