<?php
function school_register_custom_post_types() {
    // register students post type
    $labels = array(
        'name' => _x('Students', 'post type general name'),
        'singular_name' => _x('Student', 'post type singular name'),
        'menu_name' => _x('Students', 'admin menu'),
        'name_admin_bar' => _x('Student', 'add new on admin bar'),
        'add_new' => _x('Add New', 'student'),
        'add_new_item' => __('Add New Student'),
        'new_item' => __('New Student'),
        'edit_item' => __('Edit Student'),
        'view_item' => __('View Student'),
        'all_items' => __('All Students'),
        'search_items' => __('Search Students'),
        'parent_item_colon' => __('Parent Students:'),
        'not_found' => __('No students found.'),
        'not_found_in_trash' => __('No students found in Trash.'),
        'archives' => __('Student Archives'),
        'insert_into_item' => __('Insert into student'),
        'uploaded_to_this_item' => __('Uploaded to this student'),
        'filter_item_list' => __('Filter students list'),
        'items_list_navigation' => __('Students list navigation'),
        'items_list' => __('Students list'),
        'featured_image' => __('Student featured image'),
        'set_featured_image' => __('Set student featured image'),
        'remove_featured_image' => __('Remove student featured image'),
        'use_featured_image' => __('Use as featured image'),
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'students'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-archive',
        'supports' => array('title', 'thumbnail', 'editor'),
        'template'           => array(
            array( 'core/paragraph', array(
                'placeholder' => 'Write a short biography...',
            ) ),
            array( 'core/button', array(
                'placeholder' => 'Link to portfolio',
                'text' => 'View Portfolio',
                'url' => ''
            ) ),
        ),
        'template_lock' => 'all', // Prevents adding, removing, or moving blocks
    );
    
    register_post_type('fwd-student', $args);
}
add_action( 'init', 'school_register_custom_post_types' );

// Define labels for the Staff post type
$staff_labels = array(
    'name' => _x('Staff', 'post type general name'),
    'singular_name' => _x('Staff Member', 'post type singular name'),
    'menu_name' => _x('Staff', 'admin menu'),
    'name_admin_bar' => _x('Staff Member', 'add new on admin bar'),
    'add_new' => _x('Add New', 'staff member'),
    'add_new_item' => __('Add New Staff Member'),
    'new_item' => __('New Staff Member'),
    'edit_item' => __('Edit Staff Member'),
    'view_item' => __('View Staff Member'),
    'all_items' => __('All Staff Members'),
    'search_items' => __('Search Staff Members'),
    'parent_item_colon' => __('Parent Staff Members:'),
    'not_found' => __('No staff members found.'),
    'not_found_in_trash' => __('No staff members found in Trash.'),
);

// Define arguments for the Staff post type
$staff_args = array(
    'labels' => $staff_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'staff'),
    'capability_type' => 'post',
    'has_archive' => false,
    'hierarchical' => false,
    'menu_position' => 7,
    'menu_icon' => 'dashicons-groups',
    'supports' => array('title', 'editor', 'thumbnail'),
    'template' => array(array('core/image'), array('core/paragraph')),
);

// Register the Staff post type
register_post_type('fwd-staff', $staff_args);

function school_register_taxonomies() {
    // register taxonomy for students cpt
    $labels = array(
        'name' => _x('Departments', 'taxonomy general name'),
        'singular_name' => _x('Department', 'taxonomy singular name'),
        'search_items' => __('Search Departments'),
        'all_items' => __('All Departments'),
        'parent_item' => __('Parent Department'),
        'parent_item_colon' => __('Parent Department:'),
        'edit_item' => __('Edit Department'),
        'update_item' => __('Update Department'),
        'add_new_item' => __('Add New Department'),
        'new_item_name' => __('New Department Name'),
        'menu_name' => __('Departments'),
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'department'),
    );
    
    register_taxonomy('fwd-department', array('fwd-staff'), $args);

    // register taxonomy for student CPT called roles
    $labels = array(
        'name' => _x('Role', 'taxonomy general name'),
        'singular_name' => _x('Role', 'taxonomy singular name'),
        'search_items' => __('Search Role'),
        'all_items' => __('All Role'),
        'parent_item' => __('Parent Role'),
        'parent_item_colon' => __('Parent Role:'),
        'edit_item' => __('Edit Role'),
        'update_item' => __('Update Role'),
        'add_new_item' => __('Add New Role'),
        'new_item_name' => __('New Role Name'),
        'menu_name' => __('Role'),
    );
    
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'role'),
    );
    
    register_taxonomy('fwd-role', array('fwd-student'), $args);
    

}

add_action( 'init', 'school_register_taxonomies' );

// this flushes the permalinks when switching themes
function school_rewrite_flush() {
    school_register_custom_post_types();
    
    school_register_taxonomies();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'fwd_rewrite_flush' );