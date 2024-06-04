<?php get_header(); ?>

    <div class="container">
        <h1 class="text-2xl text-slate-800 font-bold">Search Results for '<?php echo get_search_query(); ?>'</h1>
        <?php get_template_part('includes/section', 'searchresults'); ?>
        <?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
    </div>

<?php get_footer(); ?>