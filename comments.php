<?php
// If the post is password protected and the visitor has not yet entered the password, return early without loading the comments.
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area my-8">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title text-2xl font-bold text-gray-800 mb-4">
            <?php
            printf(
                /* translators: 1: number of comments, 2: post title */
                _nx(
                    '%1$s Comment on "%2$s"',
                    '%1$s Comments on "%2$s"',
                    get_comments_number(),
                    'comments title',
                    'textdomain'
                ),
                number_format_i18n(get_comments_number()),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h2>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ul',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback' => 'custom_comments'
            ));
            ?>
        </ul>

        <?php the_comments_navigation(); ?>

    <?php endif; // Check for have_comments(). ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments text-gray-600"><?php _e('Comments are closed.', 'textdomain'); ?></p>
    <?php endif; ?>

    <?php comment_form(array(
        'class_submit' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded',
        'title_reply' => '<span class="text-2xl font-bold text-gray-800">' . __('Leave a Reply', 'textdomain') . '</span>',
        'comment_field' => '<p class="comment-form-comment mb-4"><textarea id="comment" name="comment" class="form-textarea mt-1 block w-full" rows="5" required="required"></textarea></p>',
        'fields' => array(
            'author' => '<p class="comment-form-author mb-4"><input id="author" name="author" class="form-input mt-1 block w-full" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required="required" placeholder="' . __('Name', 'textdomain') . '" /></p>',
            'email' => '<p class="comment-form-email mb-4"><input id="email" name="email" class="form-input mt-1 block w-full" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" placeholder="' . __('Email', 'textdomain') . '" /></p>',
            'url' => '<p class="comment-form-url mb-4"><input id="url" name="url" class="form-input mt-1 block w-full" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" placeholder="' . __('Website', 'textdomain') . '" /></p>',
        ),
    )); ?>
</div>