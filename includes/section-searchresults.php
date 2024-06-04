<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div>
    <!-- Import an image -->
    <?php if(has_post_thumbnail()) : ?>
        <img src="<?php the_post_thumbnail_url('blog-small'); ?>" alt="<?php the_title(); ?>" class="max-h-[500px]">
    <?php endif; ?>

    <h1 class="text-4xl font-bold text-blue-400"><?php the_title(); ?></h1>

    <p>
        <?php the_excerpt(); ?>
    </p>
    <a href="<?php the_permalink(); ?>">Read more</a>
</div>



<?php endwhile; ?> <?php else : ?> 
    No search results found.    
<?php endif; ?>