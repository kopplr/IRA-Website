<?php

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
    wp_register_script('yearpost', get_template_directory_uri() . '/js/yearpost.js', array('jquery'), NULL, true);
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

// Register 'glossary' post type
function glossary_post_type() {

   // Labels
	$labels = array(
		'name' => _x("Glossary", "post type general name"),
		'singular_name' => _x("Glossary", "post type singular name"),
		'menu_name' => 'Glossary Items',
		'add_new' => _x("Add New", "glossary item"),
		'add_new_item' => __("Add New Glossary Item"),
		'edit_item' => __("Edit Glossary Item"),
		'new_item' => __("New Glossary Item"),
		'view_item' => __("View Glossary Item"),
		'search_items' => __("Search Glossary Items"),
		'not_found' =>  __("No Glossary Items Found"),
		'not_found_in_trash' => __("No Glossary Items Found in Trash"),
		'parent_item_colon' => ''
	);

	// Register post type
	register_post_type('glossary' , array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/favicon.png',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
	) );
}
add_action( 'init', 'glossary_post_type', 0 );

function alphaindex_alpha_tax() {
	register_taxonomy( 'alpha',array (
		0 => 'glossary',
	),
	array( 'hierarchical' => false,
		'label' => 'Alpha',
		'show_ui' => false,
		'query_var' => true,
		'show_admin_column' => false,
	) );
}
add_action('init', 'alphaindex_alpha_tax');



function alphaindex_save_alpha( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	return;
	//only run for glossary items
	$slug = 'glossary';
	$letter = '';
	// If this isn't a 'glossary' post, don't update it.
	if ( isset( $_POST['post_type'] ) && ( $slug != $_POST['post_type'] ) )
	return;
	// Check permissions
	if ( !current_user_can( 'edit_post', $post_id ) )
	return;
	// OK, we're authenticated: we need to find and save the data
	$taxonomy = 'alpha';
	if ( isset( $_POST['post_type'] ) ) {
		// Get the title of the post
		$title = strtolower( $_POST['post_title'] );

		// The next few lines remove A, An, or The from the start of the title
		$splitTitle = explode(" ", $title);
		$blacklist = array("an","the");
		$splitTitle[0] = str_replace($blacklist,"",strtolower($splitTitle[0]));
		$title = implode(" ", $splitTitle);

		// Get the first letter of the title
		$letter = substr( $title, 0, 1 );

		// Set to 0-9 if it's a number
		if ( is_numeric( $letter ) ) {
			$letter = '0-9';
		}
	}
	//set term as first letter of post title, lower case
	wp_set_post_terms( $post_id, $letter, $taxonomy );

    //delete the transient that is storing the alphabet letters
    delete_transient( 'kia_archive_alphabet');
}
add_action( 'save_post', 'alphaindex_save_alpha' );

// Register 'external_organization' post type
function external_organization_post_type() {

   // Labels
	$labels = array(
		'name' => _x("Organization", "post type general name"),
		'singular_name' => _x("Organization", "post type singular name"),
		'menu_name' => 'External Organizations',
		'add_new' => _x("Add New", "external organization"),
		'add_new_item' => __("Add New External Organization"),
		'edit_item' => __("Edit External Organization"),
		'new_item' => __("New External Organization"),
		'view_item' => __("View External Organization"),
		'search_items' => __("Search External Organizations"),
		'not_found' =>  __("No External Organizations Found"),
		'not_found_in_trash' => __("No External Organizations Found in Trash"),
		'parent_item_colon' => ''
	);

	// Register post type
	register_post_type('external' , array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => false,
		'menu_icon' => get_stylesheet_directory_uri() . '/images/favicon.png',
		'rewrite' => false,
		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
	) );
}
add_action( 'init', 'external_organization_post_type', 0 );

function external_cats_tax() {
	register_taxonomy( 'ext_cats', array (
		0 => 'external',
	),
	array( 'hierarchical' => true,
		'label' => 'External Organization Categories',
		'query_var' => true,
          'rewrite' => true,
          'show_admin_column' => true
	) );
}
add_action('init', 'external_cats_tax');

function IRAWebsite_resources() {



    wp_register_style('animate-css', get_template_directory_uri() . '/css/animate.min.css', array(), '3.5.0');
    wp_enqueue_style('animate-css');

    wp_register_style('mcmaster-brand', get_template_directory_uri() . '/css/mcmaster-brand.css', array(), '1.0');
    wp_enqueue_style('mcmaster-brand');

    wp_register_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0');
    wp_enqueue_style('font-awesome');

    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), '1.0');

    wp_enqueue_script('roboto-google-font', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js');

//     wp_enqueue_script('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700');

    wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.12.0.min.js', array(), '1.12.0', true);


    wp_enqueue_script('javascript', get_template_directory_uri() . '/js/all_javascript.js', array('jquery'), '1.0');

    wp_enqueue_script('javascript', get_template_directory_uri() . '/js/slider.js', array('jquery'), '1.0');

    wp_register_style('outdatedbrowser-css', get_template_directory_uri() . '/css/outdatedbrowser.min.css', array(), '1.1.3');
    wp_enqueue_style('outdatedbrowser-css');

    wp_enqueue_script('outdatedbrowser-js', get_template_directory_uri() . '/js/outdatedbrowser.min.js', array(), '1.1.3');

    //if (is_front_page()){

        wp_enqueue_script('d3', '//d3js.org/d3.v3.min.js', array(), '3');
        wp_enqueue_script('d3-legend', get_template_directory_uri() . '/js/d3-legend.min.js', array(), '1.0');

    wp_register_style('flexslider-css', get_template_directory_uri() . '/css/flexslider.css', array(), '1.8');
        wp_enqueue_style('flexslider-css');

    wp_enqueue_script('flexslider-js', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), '1.8');



 //   if(!is_front_page()) {
        wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '2.2.2', 'true');

        wp_enqueue_script('maps-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBLyeSD8mwqsDddMpRSknH1P5ycTgJg_-M', array(), '1.0.0');
 //   }
}

add_action('wp_enqueue_scripts', 'IRAWebsite_resources');




// Navigation Menus
register_nav_menus(array(
    'primary' => __( 'Primary Menu'),
    'primary-right' => __( 'Primary Right Menu'),
    'footer' => __( 'Footer Menu'),
    'sidebar' => __( 'Sidebar Menu'),
    'home-page' => __( 'Home Page Menu'),

));

//Find top level category
function pa_category_top_parent_id ($catid) {
    while ($catid) {
        $cat = get_category($catid);
        $catid = $cat->category_parent;
        // get the object for the catid $catid = $cat->category_parent;
        // assign parent ID (if exists) to $catid
        // the while loop will continue whilst there is a $catid
        // when there is no longer a parent $catid will be NULL so we can assign our $catParent
        $catParent = $cat->cat_ID;
        $catParentName = get_cat_name($catParent);
    }
    return $catParentName;
}

// Order posts by last name
function posts_orderby_lastname ($orderby_statement)
{
  $orderby_statement = "RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1) ASC";
    return $orderby_statement;
}

// Custom nav walker
class Nav_Footer_Walker extends Walker_Nav_Menu {
    public static $counter = 0;
	function start_lvl( &$output, $depth, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent\n";
	}

	function end_lvl( &$output, $depth, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent\n";
	}

	function start_el( &$output, $item, $depth, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $icons = $classes[0];
        $classes = array_splice($classes, 1); // Remove first class (the icon class)

		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="home-column ' . esc_attr( $class_names ) . '"' : '';



		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '';
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $id . $class_names . $attributes .'><div>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '<i class="fa ' . $icons . '" aria-hidden="true"></i>';
		$item_output .= '</div></a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	function end_el( &$output, $item, $depth, $args = array() ) {
		$output .= "\n";
	}
}

