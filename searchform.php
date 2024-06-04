<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <label for="search-field" class="sr-only"><?php _e('Search for:', 'textdomain'); ?></label>
    <input type="search" id="search-field" 
    class="search-input bg-white text-gray-900 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full p-2" 
    placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'textdomain'); ?>" 
    value="<?php echo get_search_query(); ?>" 
    name="s" 
    required/>
    <button type="submit" class="search-button mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><?php _e('Search', 'textdomain'); ?></button>
</form>