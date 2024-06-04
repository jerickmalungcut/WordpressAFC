<?php if ( have_posts() ) : ?>
    <div class="container mx-auto my-8">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="post mb-6">


                <h1 class="text-4xl font-bold text-blue-400">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h1>

                <div class="text-gray-700">
                    <?php the_content(); ?>
                </div>


                <!-- This will show the tags -->
                <p>Tags:
                <?php 
                    $tags = get_the_tags();
                    if ($tags && is_array($tags)) {
                        foreach($tags as $tag) {
                            echo '<a href="' . esc_url( get_tag_link($tag->term_id) ) . '" class="text-blue-500">' . 
                            esc_html($tag->name) . '</a> ';
                        }
                    } else {
                        echo 'No tags';
                    }
                ?>
                </p>

                <!-- This will show the category -->
                <?php
                    $categories = get_the_category();
                    foreach($categories as $cat) : ?>

                        <a href="<?php echo get_category_link($cat->term_id); ?>">
                            <?php echo $cat->name; ?>
                        </a>
                        
                        
                    <?php endforeach; ?>

                <!-- This is the comment template -->
                <?php comments_template(); ?>

            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="container mx-auto my-8">
        <p class="text-gray-700">No posts found.</p>
    </div>
<?php endif; ?>