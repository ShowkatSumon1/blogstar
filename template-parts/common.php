<div class="entry__text">
            <div class="entry__header">
                
                <div class="entry__date">
                    <a href=""><?php the_time('F d, Y');?></a>
                </div>
                <h1 class="entry__title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
                
            </div>
            <div class="entry__excerpt">
                <p><?php echo wp_trim_words(get_the_content(), 30);?></p>
            </div>
            <div class="entry__meta">
                <span class="entry__meta-links">
                    <?php echo get_the_category_list(' ');?>
                </span>
            </div>
        </div>