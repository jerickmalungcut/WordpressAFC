<?php get_header(); ?>

<div class="container">
    <?php get_template_part('includes/section', 'archive'); ?>

    <!-- Pagination -->
    <!-- previous_posts_link();
    next_posts_link(); -->
    <?php 
        global $wp_query;

        $big = 99999999; //need an unlikely integer

        echo paginate_links( array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages
        ));
    ?>
</div>

<?php get_footer(); ?>

