<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>This is a Wordpress AFC Training</title>

    <?php wp_head(); ?>
</head>
<body>
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white text-2xl">
                <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
            </div>
            
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => true,
                    'menu_class' => 'flex space-x-4',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
            ?>
        </div>
    </nav>
    
