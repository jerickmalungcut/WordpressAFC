<?php if ( have_posts() ) : ?>
    <div class="container mx-auto my-8">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="post mb-6">


                <h1 class="text-4xl font-bold text-blue-400">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h1>

                <?php echo get_the_date('d/m/Y h:i:s'); ?>

                <div class="text-gray-700">
                    <?php the_content(); ?>
                </div>

                <!-- the_author() this will output the admin but if you want to post the name you can do below -->
                Posted by
                <?php
                    $fname = get_the_author_meta('first_name');
                    $lname = get_the_author_meta('last_name');
                    echo $fname . ' ' . $lname;
                ?>

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

            </div>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="container mx-auto my-8">
        <p class="text-gray-700">No posts found.</p>
    </div>
<?php endif; ?>