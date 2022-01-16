

    <!-- s-extra
    ================================================== -->
    <section class="s-extra">

        <div class="row top">

            <div class="col-eight md-six tab-full popular">
                <h3><?php _e('Popular Posts' , 'blogstar');?></h3>
                <div class="block-1-2 block-m-full popular__posts">

                    <?php 
                        $blogstar_popular = new Wp_Query(array(
                            'posts_per_page'     => 6,
                            'orderby'            => 'comments_count',
                            'ignore_sticky_posts' => 1,
                        ));

                    while($blogstar_popular->have_posts()) : $blogstar_popular->the_post();?>
                    
                    <article class="col-block popular__post">
                        <a href="<?php the_permalink();?>" class="popular__thumb">
                            <?php the_post_thumbnail();?>
                        </a>
                        <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                        <section class="popular__meta">
                                <span class="popular__author"><span><?php _e('By', 'blogstar');?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"> <?php the_author();?></a></span>
                            <span class="popular__date"><span><?php _e('on', 'blogstar');?></span> <time datetime="2017-12-19"><?php the_time('M d, Y');?></time></span>
                        </section>
                    </article>
                    <?php endwhile;
                    wp_reset_query();?>
                </div> <!-- end popular_posts -->
            </div> <!-- end popular -->
            
            <div class="col-four md-six tab-full about">
                <?php if(is_active_sidebar('footer-widget')){
                    dynamic_sidebar('footer-widget');
                }?>

                <ul class="about__social">
                    <li>
                        <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#0"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    </li>
                </ul> <!-- end header__social -->
            </div> <!-- end about -->

        </div> <!-- end row -->

        <div class="row bottom tags-wrap">
            <div class="col-full tags">
                <?php
                    $tag_title = apply_filters('blogstar_tag_title', __('Tags', 'blogstar'));
                    $tags_list = apply_filters('blogstar_tags_list', get_tags());
                ?>
                <h3>
                    <?php echo esc_html($tag_title);?>
                </h3>

                <div class="tagcloud">
                    <?php foreach($tags_list as $tag) : ?>
                        <a href="<?php echo get_term_link($tag->term_id); ?>"><?php echo $tag->name;?></a>
                    <?php endforeach; ?>
                </div> <!-- end tagcloud -->
            </div> <!-- end tags -->
        </div> <!-- end tags-wrap -->

    </section> <!-- end s-extra -->


    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">
            <div class="row">
                
                <div class="col-two md-four mob-full s-footer__sitelinks">
                        
                    <h4><?php _e('Quick Links', 'blogstar');?></h4>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer-left',
                        'menu_class'     => 's-footer__linklist',
                        'container'      => '',
                    ));?>

                </div> <!-- end s-footer__sitelinks -->

                <div class="col-two md-four mob-full s-footer__archives">
                        
                    <h4><?php _e('Archives', 'blogstar');?></h4>

                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer-middle',
                        'menu_class'     => 's-footer__linklist',
                        'container'      => '',
                    ));?>

                </div> <!-- end s-footer__archives -->

                <div class="col-two md-four mob-full s-footer__social">
                        
                    <h4><?php _e('Social', 'blogstar');?></h4>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'footer-right',
                        'menu_class'     => 's-footer__linklist',
                        'container'      => '',
                    ));?>

                </div> <!-- end s-footer__social -->

                <div class="col-five md-full end s-footer__subscribe">
                        
                    <?php if(is_active_sidebar('footer-right')){
                        dynamic_sidebar('footer-right');
                    }?>

                    <div class="subscribe-form">
                        <form id="mc-form" class="group" novalidate="true">

                            <input type="email" value="" name="EMAIL" class="email" id="mc-email" placeholder="Email Address" required="">
                
                            <input type="submit" name="subscribe" value="Send">
                
                            <label for="mc-email" class="subscribe-message"></label>
                
                        </form>
                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">
                <div class="col-full">
                    <div class="s-footer__copyright">
                        <span>© Copyright Philosophy 2018</span> 
                        <span>Site Template by <a href="https://colorlib.com/">Colorlib</a> Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a></span>
                    </div>

                    <div class="go-top">
                        <a class="smoothscroll" title="Back to Top" href="#top"></a>
                    </div>
                </div>
            </div>
        </div> <!-- end s-footer__bottom -->

    </footer> <!-- end s-footer -->


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>


    <!-- Java Script
    ================================================== -->

    <?php wp_footer();?>

</body>

</html>