<?php
/**
 * The template for displaying search form
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <input type="text" class="search-input" value="<?php echo get_search_query(); ?>" name="s" id="s"
           placeholder="<?php esc_attr_e( 'Search', 'foundationpress' ); ?>">

    <button type="submit" class="search-submit" aria-label="Search" title="Search">
        <span class="fa fa-search"></span>
    </button>
</form>
