<?php
/**
 * knight_wallace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package knight_wallace
 */

if ( ! function_exists( 'knight_wallace_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function knight_wallace_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on knight_wallace, use a find and replace
	 * to change 'knight_wallace' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'knight_wallace', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'knight_wallace' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'knight_wallace_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // knight_wallace_setup
add_action( 'after_setup_theme', 'knight_wallace_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function knight_wallace_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'knight_wallace_content_width', 640 );
}
add_action( 'after_setup_theme', 'knight_wallace_content_width', 0 );


/**
 * Add Custom Post Types
 *
 * */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'person_kw_fellow',
        array(
            'labels' => array(
                'name' => __( 'Knight-Wallace Fellows' ),
                'singular_name' => __( 'Knight-Wallace Fellow' ),
                'add_new_item' => __('Add New Knight-Wallace Fellow'),
                'new_item' => __('New Knight-Wallace Fellow'), 
                'view_item' => __('View Knight-Wallace Fellow'),
                'edit_item' => __('Edit Knight-Wallace Fellow'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array("slug" => "kw-fellow")
        )
    );
    register_post_type( 'person_livingston',
        array(
            'labels' => array(
                'name' => __( 'Livingston Award Winners and Finalists' ),
                'singular_name' => __( 'Livingston Winner or Finalist' ),
                'add_new_item' => __('Add New Livingston Winner or Finalist'),
                'new_item' => __('New Livingston Winner or Finalist'), 
                'view_item' => __('View Livingston Winner or Finalist'),
                'edit_item' => __('Edit Livingston Winner or Finalist'),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array("slug" => "livingston-award-winners-finalists")
        )
    );
}

add_action( 'add_meta_boxes', 'add_person_kw_fellow_metaboxes' );//add custom fields for person_kw_fellow type
add_action( 'add_meta_boxes', 'add_person_livingston_metaboxes' );//add custom fields for Livingston Winner or Finalist

function add_person_kw_fellow_metaboxes() {
    //each meta box is a custom field for our custom content type
    add_meta_box('kw_person_kw_fellow_first_name', 'First Name', 'kw_person_kw_fellow_first_name', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_fellow_last_name', 'Last Name', 'kw_person_kw_fellow_last_name', 'person_kw_fellow', 'normal', 'default');
}
    add_meta_box('kw_person_kw_photo', 'Photo', 'kw_person_kw_photo', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_photo_add', 'Additional Photo', 'kw_person_kw_photo_add', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_bio', 'Bio', 'kw_person_kw_bio', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_bio_private', 'Private Bio', 'kw_person_kw_bio_private', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_class_year', 'Class Year', 'kw_person_kw_class_year', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_study_pro_title', 'Study Project Title', 'kw_person_kw_study_pro_title', 'person_kw_fellow', 'normal', 'default');
    add_meta_box('kw_person_kw_current_job_title', 'Current Job Title', 'kw_person_kw_current_job_title', 'person_kw_fellow', 'normal', 'default');

function add_person_livingston_metaboxes() {
    add_meta_box('kw_person_liv_first_name', 'First Name', 'kw_person_liv_first_name', 'person_livingston', 'normal', 'default');
    add_meta_box('kw_person_liv_last_name', 'Last Name', 'kw_person_liv_last_name', 'person_livingston', 'normal', 'default');
}

//Fill Knight Wallace type custom fields with html
function kw_person_kw_fellow_first_name() {
    //pass in true for the noncename once per custom type
    generate_html_for_custom_field("kw_person_kw_fellow_first_name",true);
}

function kw_person_kw_fellow_last_name() {
    generate_html_for_custom_field("kw_person_kw_fellow_last_name");
}

//Fill Livingstion Awards type custom fields with html
function kw_person_liv_first_name() {
    //pass in true for the noncename once per custom type
    generate_html_for_custom_field("kw_person_liv_first_name",true);
}

function kw_person_liv_last_name() {
    generate_html_for_custom_field("kw_person_liv_last_name");
}

function generate_html_for_custom_field($name, $add_noncename=false){
    global $post;

    // Noncename needed to verify where the data originated
    if($add_noncename){
        //we don't need to add this hidden field every time this function is called
        echo '<input type="hidden" name="kwmeta_noncename" id="kwmeta_noncename" value="' . 
            wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    }

    // Get the location data if its already been entered
    $saved_data = get_post_meta($post->ID, "_{$name}", true);

    // Echo out the field
    echo '<input type="text" name="_'.$name.'" value="' . $saved_data  . '" class="widefat" />';
}

function kw_save_events_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['kwmeta_noncename'], plugin_basename(__FILE__) )) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    $events_meta['_kw_person_kw_fellow_first_name'] = !empty($_POST['_kw_person_kw_fellow_first_name']) ? $_POST['_kw_person_kw_fellow_first_name'] : null;
    $events_meta['_kw_person_kw_fellow_last_name'] = !empty($_POST['_kw_person_kw_fellow_last_name']) ? $_POST['_kw_person_kw_fellow_last_name'] : null;
    $events_meta['_kw_person_liv_first_name'] = !empty($_POST['_kw_person_liv_first_name']) ? $_POST['_kw_person_liv_first_name'] : null;
    $events_meta['_kw_person_liv_last_name'] = !empty($_POST['_kw_person_liv_last_name']) ? $_POST['_kw_person_liv_last_name'] : null;

    // Add values of $events_meta as custom fields
    foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}

add_action('save_post', 'kw_save_events_meta', 1, 2); // save the custom fields


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function knight_wallace_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'knight_wallace' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'knight_wallace_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function knight_wallace_scripts() {
    wp_enqueue_style( 'knight_wallace-style', get_stylesheet_uri() );

    wp_enqueue_script( 'knight_wallace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'knight_wallace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'knight_wallace_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
