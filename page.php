<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div class="grid">
    <div class="col-end-3">
        <!-- Sidebar Widget -->
        <?php if(is_active_sidebar('page-sidebar')) : ?>
            <?php dynamic_sidebar( 'page-sidebar' ); ?>
        <?php endif; ?>
    </div>
    
    <div class="col-start-9">
        <?php the_content(); ?>
    </div>
    
</div>





<?php endwhile; else : endif; ?>

<?php get_footer(); ?>