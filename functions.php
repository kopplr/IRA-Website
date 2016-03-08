<?php
require_once('custom_nav.php');
require_once('custom_nav_2.php');

add_action('wp_ajax_filter_year_post', 'filter_year_post');
add_action('wp_ajax_nopriv_filter_year_post', 'filter_year_post');
add_action('wp_enqueue_scripts', 'year_posts_scripts');

function filter_year_post() {
    global $wpdb;
    error_reporting(0);
    if ( !wp_verify_nonce( $_POST['nonce'], 'yearpost')) {
      die();
   }

    $post = get_post($_POST['postid']);
    $post->url = wp_get_attachment_url($post->ID);
    $post->year = $post->post_title;
    $post->has_excel = false; // Default is that year does not have any excel files associated with it

    $title_exists = $wpdb->get_results( // looks for other attachments with same name (ie. excel files)
        $wpdb->prepare(
            "SELECT ID FROM wp_posts
            WHERE post_title = %s
            AND post_type = 'attachment'", $post->year
        )
    );

    foreach ($title_exists as $title_exist){ // checks to see if the file is an excel file and then adds an icon
        $attachmentPathExcel = wp_get_attachment_url($title_exist->ID);
        if (wp_check_filetype($attachmentPathExcel)['ext'] == 'xlsx'|| wp_check_filetype($attachmentPathExcel)['ext'] == 'xls') {
            $post->has_excel = true;
            $post->excel_url = $attachmentPathExcel;
        }
    }


    if ( empty($post) || ! is_object($post) ) die();
    header('Cache-Control: no-cache, must-revalidate');
    header('Content-type: application/json');
    echo json_encode($post);
    die();

}

function year_posts_scripts() {
    wp_register_script('yearpost', get_template_directory_uri() . '/yearpost.js', array('jquery'), NULL, true);
    $url = admin_url('admin-ajax.php');
    $nonce = wp_create_nonce('yearpost');
    wp_localize_script('yearpost', 'yearpost_vars', array('ajaxurl' => $url, 'nonce' => $nonce));
    wp_enqueue_script('yearpost');
}

// Register 'team' post type
function team_post_type() {

   // Labels
	$labels = array(
		'name' => _x("Team", "post type general name"),
		'singular_name' => _x("Team", "post type singular name"),
		'menu_name' => 'Team Profiles',
		'add_new' => _x("Add New", "team item"),
		'add_new_item' => __("Add New Profile"),
		'edit_item' => __("Edit Profile"),
		'new_item' => __("New Profile"),
		'view_item' => __("View Profile"),
		'search_items' => __("Search Profiles"),
		'not_found' =>  __("No Profiles Found"),
		'not_found_in_trash' => __("No Profiles Found in Trash"),
		'parent_item_colon' => ''
	);

	// Register post type
	register_post_type('team' , array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/favicon.png',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
	) );
}
add_action( 'init', 'team_post_type', 0 );

function IRAWebsite_resources() {

    wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.0');

    wp_register_style('animate-css', get_stylesheet_directory_uri() . '/animate.min.css', array(), '3.5.0');
    wp_enqueue_style('animate-css');

    wp_register_style('mcmaster-brand', get_stylesheet_directory_uri() . '/mcmaster-brand.css', array(), '1.0');
    wp_enqueue_style('mcmaster-brand');

    wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0');
    wp_enqueue_style('font-awesome');

    wp_enqueue_script('roboto-google-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700');

    wp_enqueue_script('jquery', get_template_directory_uri() . '/jquery-1.12.0.min.js', array(), '1.12.0', true);
    wp_enqueue_script('test-isotope', get_template_directory_uri() . '/js/test_isotope.js', array('jquery'), '1.0');

    wp_enqueue_script('isotope', get_template_directory_uri() . '/isotope.pkgd.min.js', array(), '2.2.2', 'true');

    wp_enqueue_script('maps-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBLyeSD8mwqsDddMpRSknH1P5ycTgJg_-M', array(), '1.0.0');
}

add_action('wp_enqueue_scripts', 'IRAWebsite_resources');

// Navigation Menus
register_nav_menus(array(
    'primary' => __( 'Primary Menu'),
    'footer' => __( 'Footer Menu'),
    'sidebar' => __( 'Sidebar Menu'),
    'home-page' => __( 'Home Page Menu'),

));
