<?php

$blogstar_post = new WP_Query(array(
    'meta_key'   => '_featured',
    'meta_value' => 'on',
    'posts_per_page' => '3',
));

$post_data = array();
while($blogstar_post->have_posts()){
    $blogstar_post->the_post();
    $categories = get_the_category();
    $post_data[] = array(
        'title'     => get_the_title(),
        'permalink' => get_the_permalink(),
        'thumbnail' => get_the_post_thumbnail_url(get_the_id(), 'large'),
        'date'      => get_the_time('F d, Y'),
        'author'    => get_the_author(),
        'avatar'    => get_avatar_url(get_the_author_meta('ID')),
        'cat'       => $categories[0]->name,
    );
}

if($blogstar_post->post_count > 1) : ?>

<div class="pageheader-content row">
    <div class="col-full">

        <div class="featured">

            <div class="featured__column featured__column--big">
                <div class="entry" style="background-image:url('<?php echo $post_data[0]['thumbnail']?>');">
                    
                    <div class="entry__content">
                        <span class="entry__category"><a href="#0"><?php echo esc_html($post_data[0]['cat']);?> </a></span>

                        <h1><a href="<?php echo esc_url($post_data[0]['permalink']); ?>" title=""><?php echo esc_html($post_data[0]['title']);?></a></h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo $post_data[0]['avatar']; ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_html($post_data[0]['author']); ?></a></li>
                                <li><?php echo esc_html($post_data[0]['date']);?> </li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->
                    
                </div> <!-- end entry -->
            </div> <!-- end featured__big -->

            <?php for($a=1; $a<3; $a++) : ?>

            <div class="featured__column featured__column--small">
                
                <div class="entry" style="background-image:url('<?php echo $post_data[$a]['thumbnail']?>');">
                    
                    <div class="entry__content">
                        <span class="entry__category"><a href="#0"><?php echo esc_html($post_data[$a]['cat']);?> </a></span>

                        <h1><a href="<?php echo esc_url($post_data[$a]['permalink']); ?>" title=""><?php echo esc_html($post_data[$a]['title']);?></a></h1>

                        <div class="entry__info">
                            <a href="#0" class="entry__profile-pic">
                                <img class="avatar" src="<?php echo $post_data[$a]['avatar']; ?>" alt="">
                            </a>

                            <ul class="entry__meta">
                                <li><a href="#0"><?php echo esc_html($post_data[$a]['author']); ?></a></li>
                                <li><?php echo esc_html($post_data[$a]['date']);?> </li>
                            </ul>
                        </div>
                    </div> <!-- end entry__content -->
                    
                </div> <!-- end entry -->

            </div> <!-- end featured__small -->

            <?php endfor; ?>
        </div> <!-- end featured -->

    </div> <!-- end col-full -->
</div> <!-- end pageheader-content row -->

<?Php endif;?>