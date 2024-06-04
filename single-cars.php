
<?php get_header(); ?>
<div class="container">
    <!-- Import an image -->
    <?php if(has_post_thumbnail()) : ?>
        <img src="<?php the_post_thumbnail_url('blog-large'); ?>" alt="<?php the_title(); ?>" class="max-h-[500px]">
    <?php endif; ?>

    <?php get_template_part('includes/section', 'cars'); ?>

    <!-- To show the pagination -->
    <?php wp_link_pages(); ?>

    <!-- Custom Fields (you need to install Advanced Custom Fields Plugin for this) -->
    <div class="flex flex-col">
        <p>
            Color: <?php the_field('color') ?>
        </p>
        
        <p>
            Registration: <?php the_field('registration'); ?>
        </p>

        <p>
            Features: <?php the_field('features'); ?>
        </p>

        <p>
            <!-- This is set as image url in Advance Custom Fields -->
            Gallery:
            <?php if( get_field('gallery') ): ?>
                <img src="<?php the_field('gallery'); ?>" />
            <?php endif; ?>
            
        </p>

        <p>
            <?php get_template_part('includes/form', 'enquiry'); ?>
        </p>


        
    </div>
    
</div>
<?php get_footer(); ?>



<!-- Custom Fields -->
<!-- <div class="flex flex-col">
        <p>
            Color: ?php echo get_post_meta($post->ID, 'Color', true); ?>
        </p>
        
        <p>
             To check if there are registration -->
            <!-- ?php if(get_post_meta($post->ID, 'Registration', true)): ?>

            Registration: ?php echo get_post_meta($post->ID, 'Registration', true); ?>
        </p>
         -->
<!-- 
        ?php endif; ?>
    </div> --> -->