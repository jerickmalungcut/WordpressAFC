<!-- get_header('secondary');  -->
<?php get_header(); ?>
<div class="container">
    <h1 class="text-red-500 text-5xl"><?php the_title(); ?></h1>
    <?php get_template_part('includes/section', 'content'); ?>
    
</div>
<?php get_footer(); ?>