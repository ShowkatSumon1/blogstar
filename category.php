<?php get_header();?>
    
    <!-- s-content
    ================================================== -->
    <section class="s-content">
        
        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1><?php _e('Category', 'blogstar')?>: <?php single_cat_title(); ?></h1>

                <p class="lead">
                    <?php echo category_description();?>
                </p>
            </div>
        </div>

        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>

                <?php if(!have_posts()) : ?>
                    <h3 class="text-center">Sorry, No post available</h3>
                <?php endif;?>

                <?php while(have_posts()) : the_post();?>
                    <?php get_template_part('template-parts/content',get_post_format()); ?>
                <?php endwhile;?>

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->
        
        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                    <?php echo blogstar_pagination();?>
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->

    <?php get_footer();?>