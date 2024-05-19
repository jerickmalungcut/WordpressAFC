<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<div>
    <h1 class="text-4xl font-bold text-blue-400"><?php the_title(); ?></h1>

    <p>
        <?php the_excerpt(); ?>
    </p>
    <a href="<?php the_permalink(); ?>">Read more</a>
</div>



<?php endwhile; else : endif; ?>