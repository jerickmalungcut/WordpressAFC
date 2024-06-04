<?php

// Styling Components

function load_css() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');

    wp_enqueue_style('tailwindcss', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'load_css');

// Script Components

function load_js() {

    wp_enqueue_script('jquery'); //Because JQuery is already installed automatically on Wordpress

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery',false, true);
    wp_enqueue_script('bootstrap');
}

add_action('wp_enqueue_scripts', 'load_js');

//Theme Options

//Add the menus on dashboard
add_theme_support('menus');

//Add featured image on dashboard
add_theme_support('post-thumbnails');

//Add widgets
add_theme_support('widgets');


// Navigation Links

function my_theme_setup() {
    //Register Navmenus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mytheme'),
        'mobile-menu' => __('Mobile Menu', 'mytheme'),
    ));
}

add_action('after_setup_theme', 'my_theme_setup');

//Include Navwalker

require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';


// Register Sidebar
function my_sidebars() {
    register_sidebar (
        array(
            'name' => 'Page Sidebar',
            'id'    => 'page-sidebar',
            'before_title' => '<h4 class="">',
            'after_title'   =>  '</h4>'
        )
    );

    register_sidebar (
        array(
            'name' => 'Blog Sidebar',
            'id'    => 'blog-sidebar',
            'before_title' => '<h4 class="">',
            'after_title'   =>  '</h4>'
        )
    );
}

add_action('widgets_init', 'my_sidebars');


//Custom image sliders
add_image_size('blog-large', 800, 400, true);
add_image_size('blog-small', 300, 200, true);


//Comment Section Template

function custom_comments($comment, $args, $depth) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>

    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('border-b border-gray-300 mb-4 pb-4'); ?>>
        <div class="flex items-start">
            <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size'], '', '', ['class' => 'mr-4 rounded-full']); ?>

            <div class="comment-body">
                <div class="comment-meta text-gray-600 mb-2">
                    <span class="comment-author font-bold"><?php echo get_comment_author_link(); ?></span>
                    <span class="comment-date text-sm"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?></span>
                </div>

                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation text-red-500"><?php _e('Your comment is awaiting moderation.'); ?></p>
                <?php endif; ?>

                <div class="comment-content text-gray-800 mb-2"><?php comment_text(); ?></div>

                <div class="comment-actions text-sm">
                    <?php comment_reply_link(array_merge($args, array(
                        'add_below' => 'comment',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        'reply_text' => __('Reply', 'textdomain'),
                        'class' => 'text-blue-500 hover:text-blue-700'
                    ))); ?>
                    <?php edit_comment_link(__('Edit', 'textdomain'), ' | ', '', '', 'text-blue-500 hover:text-blue-700'); ?>
                </div>
            </div>
        </div>
    <?php
}



function mytheme_enqueue_styles() {
    wp_enqueue_style('tailwindcss', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    wp_enqueue_style('main-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_styles');


//Custom Types

function my_first_post_type() {
    $args = array(
        'labels' => array(
            'name'  =>  'Cars',
            'singular_name' => 'Car',
        ),
        'hierarchical' => true, //This will let you choose if you want to display the name or not
        'menu_icon' =>  'dashicons-car', //Search Wordpress Dashicons
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        // 'rewrite' => array('slug' => 'my-cars')
    );
    register_post_type('cars', $args);
}

add_action('init', 'my_first_post_type');


function my_first_taxonomy() {
    $args = array(
        'labels'    =>  array(
            'name'  => 'Brands',
            'singular_name' =>  'Brand',
        ),
        'public'    =>  true,
        'hierarchical'  => false,
    );

    register_taxonomy('brands', array('cars' ), $args);
    
}

add_action('init', 'my_first_taxonomy');


// Form

add_action('wp_ajax_enquiry', 'inquiry_form');
add_action('wp_ajax_nopriv_enquiry', 'inquiry_form');

function inquiry_form() {

    if(!wp_verify_nonce($_POST['nonce'],'ajax-nonce'))
    {
        wp_send_json_error('Nonce is incorrect', 401);
        die();
    }

    $formdata = [];

    wp_parse_str($_POST['enquiry'], $formdata);

    //Admin Email
    $admin_email = get_option('admin_email');

    //Email headers
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From:' . $admin_email;
    $headers[] = 'Reply-to:' . $formdata['email'];

    //Who are we sending the email to?
    $send_to = $admin_email;

    //Subject
    $subject = 'Enquiry from ' . $formdata['fname'] . ' ' . $formdata['lname'];

    //Message
    $message = '';

    foreach($formdata as $index => $field) {
        $message .= '<strong>' . $index . '</strong>' . $field . '<br/>';
    }

    try {
        if(wp_mail($send_to, $subject, $message, $headers)) {
            wp_send_json_success( 'Email Sent' );
        }
        else {
            wp_send_json_error('Email Error');
        }
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }

    wp_send_json_success($formdata['fname']);
}


// Custom Mail
add_action('phpmailer_init','custom_mailer');

function custom_mailer(PHPMailer $phpmailer) {
    $phpmailer->SetFrom('jerickmalungcut@gmail.com', 'Jerick Malungcut');
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->Port = 587;
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Username = SMTP_LOGIN;
    $phpmailer->Password = SMTP_PASSWORD;
    $phpmailer->IsSMTP();
}