    <article class="masonry__brick entry format-gallery" data-aos="fade-up">
        
        <div class="entry__thumb slider">
            <div class="slider__slides">
                <?php $galleries = get_post_meta(get_the_id(),'_gallery-images', true); 
                    foreach($galleries as $gallery => $imgs) :
                    $img = wp_get_attachment_image_src($gallery);
                ?>
                <div class="slider__slide">
                    <img src="<?php echo $img[0];?>" alt=""> 
                </div>
                <?php endforeach;?>
            </div>
        </div>

        <?php get_template_part('template-parts/common');?>

    </article> <!-- end article -->