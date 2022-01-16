<?php if(function_exists('CMB2_Bootstrap_290')){
    $blogstar_video = get_post_meta(get_the_id(), '_video', true);
};?>

<article class="masonry__brick entry format-video" data-aos="fade-up">  
        
        <div class="entry__thumb video-image">
            <a href="<?php echo esc_url($blogstar_video);?>" data-lity>
                <?php the_post_thumbnail('large');?>
            </a>
        </div>

        <?php get_template_part('template-parts/common');?>

    </article> <!-- end article -->