
<?php get_header(); ?>
<div class="container">
    <!-- Import an image -->
    <?php if(has_post_thumbnail()) : ?>
        <img src="<?php the_post_thumbnail_url('blog-large'); ?>" alt="<?php the_title(); ?>" class="max-h-[500px]">
    <?php endif; ?>

    <?php get_template_part('includes/section', 'blogcontent'); ?>

    <!-- To show the pagination -->
    <?php wp_link_pages(); ?>
    
</div>
<?php get_footer(); ?>