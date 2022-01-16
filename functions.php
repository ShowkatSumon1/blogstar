<?php

/////// theme basic
function blogstar_theme_setup(){
    load_theme_textdomain('blogstar' , get_template_directory().'/lang');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('custom-logo');
    add_theme_support( 'html5', array('search-form' ));
    add_theme_support('post-formats' , array('audio' , 'video', 'quote', 'link', 'image', 'gallery'));
    add_image_size('blogstar-medium' , 400, 400, true);

    ///////// menu
    register_nav_menus(array(
        'main-menu'     => __('Main Menu' , 'blogstar'),
        'footer-left'   => __('Footer Left' , 'blogstar'),
        'footer-middle' => __('Footer Middle' , 'blogstar'),
        'footer-right'  => __('Footer Right' , 'blogstar'),
    ));
}
add_action('after_setup_theme', 'blogstar_theme_setup');

////////// scripts calling

function blogstar_scripts_call(){
    /////////// stylesheet
    wp_enqueue_style('fontawesome' , get_theme_file_uri('/assets/css/font-awesome/css/font-awesome.min.css'));
    wp_enqueue_style('fonts-css' , get_theme_file_uri('/assets/css/fonts.css'));
    wp_enqueue_style('base-css' , get_theme_file_uri('/assets/css/base.css'));
    wp_enqueue_style('vendor-css' , get_theme_file_uri('/assets/css/vendor.css'));
    wp_enqueue_style('main-css' , get_theme_file_uri('/assets/css/main.css'));

    wp_enqueue_style('blogstar-main' , get_stylesheet_uri());

    //////////////scripts
    wp_enqueue_script('modernizr-js' , get_theme_file_uri('/assets/js/modernizr.js'), array('jquery') , '' , false);
    wp_enqueue_script('pace-js' , get_theme_file_uri('/assets/js/pace.min.js'), array('jquery') , '' , false);
    wp_enqueue_script('plugins-js' , get_theme_file_uri('/assets/js/plugins.js'), array('jquery') , '' , true);
    wp_enqueue_script('main-js' , get_theme_file_uri('/assets/js/main.js'), array('jquery') , '' , true);

    wp_enqueue_script('custom-js' , get_theme_file_uri('/assets/js/custom.js'), array('jquery', 'main-js') , '' , true);
}
add_action('wp_enqueue_scripts' , 'blogstar_scripts_call');

////////////// TGm

if(file_exists(get_theme_file_path().'/library/tgm.php')){
    require_once(get_theme_file_path('/library/tgm.php'));
}

function blogstar_pagination(){
    global $wp_query;
    $links = paginate_links(array(
        'current'  => max(1, get_query_var('paged')),
        'total'    => $wp_query->max_num_pages,
        'type'     => 'list',
        'mid_size' => 3,
    ));
    $links = str_replace('page-numbers' , 'pgn__num' , $links);
    $links = str_replace('next' , 'pgn__next' , $links);
    $links = str_replace('prev' , 'pgn__prev' , $links);
    $links = str_replace("<ul class='pgn__num'>" , "<ul>" , $links);
    return $links;
}

/////// category description auto p remove

remove_action('term_description' , 'wpautop');

////////////// sidebar register

function blogstar_sidebar(){
    register_sidebar(array(
        'name'           => __('Footer Widget', 'blogstar'),
        'id'             => "footer-widget",
        'description'    => 'Add footer sidebar content',
        'before_title'   => '<h3">',
        'after_title'    => "</h3>",
        'before_widget'  => '<div>',
        'after_widget'   => '</div>',
    ));
    register_sidebar(array(
        'name'           => __('Footer Right', 'blogstar'),
        'id'             => "footer-right",
        'description'    => 'Add footer right sidebar content',
        'before_title'   => '<h4">',
        'after_title'    => "</h4>",
        'before_widget'  => '<div>',
        'after_widget'   => '</div>',
    ));
}
add_action('widgets_init', 'blogstar_sidebar');

///////////// Search Form Same markup

function blogstar_search_form(){

    $home = home_url('/');
    $label = __('Search for:' , 'blogstar');
    $value = __('Search' , 'blogstar');
    ob_start(); ?>
        <form role="search" method="get" class="header__search-form" action="<?php $home;?>">
            <label>
                <span class="hide-content"><?php $label;?></span>
                <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="<?php $label;?>" autocomplete="off">
            </label>
            <input type="submit" class="search-submit" value="<?php $value;?>">

            <?php if(is_post_type_archive('book')){ ?>
                <input type="hidden" name="post_type" value="book">
            <?php }else{ ?>
                <input type="hidden" name="post_type" value="post">
            <?php }?>
            
        </form>
    <?php return ob_get_clean();;
}
add_filter('get_search_form' , 'blogstar_search_form');


////////////////////// CMB2

if(class_exists('CMB2_Bootstrap_290')){
    require_once(get_theme_file_path('/cmb2.php'));
}

function blogstar_backend_scripts($hook){
    if($hook == 'post.php'){
        wp_enqueue_script('backend-scripts' , get_theme_file_uri('/assets/js/scripts.js'));
    }
}
add_action('admin_enqueue_scripts', 'blogstar_backend_scripts');

////////////////// Custom Post Type URL manage_

function blogstar_ctp_url($post_link, $id){
	$post = get_post($id);
	if(is_object($post) && 'cast' == get_post_type($id)){
		$parent_post_id = get_field('movie');
		$parent_post = get_post($parent_post_id);
		if($parent_post){
			$post_link = str_replace('%movie%', $parent_post->post_name, $post_link);
		}
	}
    if(is_object($post) && 'movie' == get_post_type($post)){
        $genre = wp_get_post_terms($post->ID, 'genre');
        if(is_array($genre) && count($genre) > 0){
            $slug = $genre[0]-> slug;
            $post_link = str_replace('%genre%' , $slug, $post_link);
        }else{
            $slug = 'generic';
            $post_link = str_replace('%genre%' , $slug, $post_link);
        }
    }
	return $post_link;
}
add_filter('post_type_link', 'blogstar_ctp_url', 1, 2);

////////// tag list own filter

function blogstar_tag_title_change($title){
    if(is_post_type_archive('movie') || is_tax('genre') || is_singular('movie')){
        $title = __('Genre', 'blogstar');
    }
    return $title;
}
add_filter('blogstar_tag_title', 'blogstar_tag_title_change');

function blogstar_taglist_change($tags){
    if(is_post_type_archive('movie') || is_tax('genre') || is_singular('movie')){
        $tags = get_terms(array(
            'taxonomy'   => 'genre',
            'hide_empty' => true,
        ));
    }
    return $tags;
}
add_filter('blogstar_tags_list', 'blogstar_taglist_change');

