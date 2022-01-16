<?php if(function_exists('CMB2_Bootstrap_290')){
    $blogstar_audio = get_post_meta(get_the_id(), '_audio', true);
};?>
  
  <article class="masonry__brick entry format-audio" data-aos="fade-up">

        <div class="entry__thumb">
            <a href="single-audio.html" class="entry__thumb-link">
                <?php the_post_thumbnail('large');?>
            </a>
            <div class="audio-wrap">
                <audio id="player" src="<?php echo esc_url($blogstar_audio);?>" width="100%" height="42" controls="controls"></audio>
            </div>
        </div>

        <?php get_template_part('template-parts/common');?>

    </article> <!-- end article -->