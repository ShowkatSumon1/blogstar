<?php

add_action('cmb2_admin_init' , 'blogstar_cmb2_metabox');
function blogstar_cmb2_metabox(){

    //////////// For User
    $blogstar_user = new_cmb2_box(array(
        'title'        => 'User Metabox',
        'id'           => 'user-metabox',
        'object_types' => array('user')
    ));

    $blogstar_user-> add_field(array(
        'name' => 'Facebook URL',
        'id'   => '_facebook-id',
        'type' => 'text_url',
    ));
    $blogstar_user-> add_field(array(
        'name' => 'Twitter URL',
        'id'   => '_twitter-id',
        'type' => 'text_url',
    ));
    $blogstar_user-> add_field(array(
        'name' => 'Instagram URL',
        'id'   => '_instagram-id',
        'type' => 'text_url',
    ));


    ///////////// For gallery
    $blogstar_gallery = new_cmb2_box(array(
        'title'        => 'Gallery images',
        'id'           => 'gallery',
        'object_types' => array('post'),
    ));

    $blogstar_gallery-> add_field(array(
        'name'  => 'Add your images',
        'id'    => '_gallery-images',
        'type'  => 'file_list',
    ));

    ///////////// For Audio
    $blogstar_audio = new_cmb2_box(array(
        'title'        => 'Audio URL',
        'id'           => 'audio',
        'object_types' => array('post'),
    ));

    $blogstar_audio-> add_field(array(
        'name'  => 'Add your audio URL here',
        'id'    => '_audio',
        'type'  => 'text_url',
    ));

    ///////////// For Video
    $blogstar_video = new_cmb2_box(array(
        'title'        => 'Video URL',
        'id'           => 'video',
        'object_types' => array('post'),
    ));

    $blogstar_video-> add_field(array(
        'name'  => 'Add your video URL here',
        'id'    => '_video',
        'type'  => 'text_url',
    ));

    ///////////// For Featured
    $blogstar_featured = new_cmb2_box(array(
        'title'        => 'Featured Posts',
        'id'           => 'featured',
        'object_types' => array('post'),
    ));

    $blogstar_featured-> add_field(array(
        'name'  => 'Featured post',
        'id'    => '_featured',
        'type'  => 'checkbox',
    ));
}

////////////////// Attach POst Options

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb2_attached_posts_field_metaboxes_example() {
    $post_id = 0;
    if(isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])){
        $post_id = empty($_REQUEST['post_ID']) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

	$example_meta = new_cmb2_box( array(
		'id'           => 'cmb2_attached_posts_field',
		'title'        => __( 'Attached Posts', 'blogstar' ),
		'object_types' => array( 'movie' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => false, // Show field names on the left
	) );

	$example_meta->add_field( array(
		'name'    => __( 'Attached Posts', 'blogstar' ),
		'desc'    => __( 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'blogstar' ),
		'id'      => 'attached_cmb2_attached_posts',
		'type'    => 'custom_attached_posts',
		'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
		'options' => array(
			'show_thumbnails' => true, // Show thumbnails on the left
			'filter_boxes'    => true, // Show a text box for filtering the results
			'query_args'      => array(
				'posts_per_page' => 10,
				'post_type'      => 'cast',
				'meta_key'      => 'movie',
				'meta_value'          => $post_id,
			), // override the get_posts args
		),
	) );

}
add_action( 'cmb2_init', 'cmb2_attached_posts_field_metaboxes_example' );


////////////// POst search options

function cmb2_post_search_ajax_metaboxes_example() {
	
	$example_meta = new_cmb2_box( array(
		'id'           => 'cmb2_post_search_ajax_field',
		'title'        => __( 'Related Posts', 'cmb2' ),
		'object_types' => array( 'cast' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
	) );
	
	$example_meta->add_field( array(
		'name'      	=> __( 'Example Single', 'cmb2' ),
		'id'        	=> 'relation',
		'type'      	=> 'post_search_ajax',
		'desc'			=> __( '(Start typing post title)', 'cmb2' ),
		// Optional :
		'limit'      	=> 1, 		// Limit selection to X items only (default 1)
		'sortable' 	 	=> false, 	// Allow selected items to be sortable (default false)
		'query_args'	=> array(
			'post_type'			=> array( 'movie' ),
			'post_status'		=> array( 'publish' ),
			'posts_per_page'	=> -1
		)
	) );
	
}
add_action( 'cmb2_init', 'cmb2_post_search_ajax_metaboxes_example' );
