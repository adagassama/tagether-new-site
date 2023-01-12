<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}

$context = Timber::get_context();
$context['blog_fields'] = get_fields(12);

// Get the category
$context['current_category'] = new TimberTerm();
$cat_id = $context['current_category']->id;

if($context['isMobile']) {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    // 'post__not_in'  => get_option( 'sticky_posts' ),
    'cat' => $cat_id
  );
}
else {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged,
    // 'post__not_in'  => get_option( 'sticky_posts' ),
    'cat' => $cat_id
  );

  // Get popular posts
  $popular_posts = array( 
    'posts_per_page' => 3,
    'meta_key' => 'wpb_post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'ignore_sticky_posts' => 1,
    'cat' => $cat_id
  );
  $context['popular_posts'] = new Timber\PostQuery($popular_posts);
}

// Get highlighted post
$stiky_posts = array(
  'posts_per_page' => 1,
  'post__in'  => get_option( 'sticky_posts' ),
  'ignore_sticky_posts' => 1
);
$context['stiky_posts'] = new Timber\PostQuery($stiky_posts);

// Get all categories
$context['categories'] = Timber::get_terms('category');

$context['posts'] = new Timber\PostQuery($args);
Timber::render( 'pages/blog.twig', $context );