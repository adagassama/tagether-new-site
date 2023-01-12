<?php
/**
 * Template Name: Blog Page
 * Description: All blog publications
 */

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}



$context = Timber::get_context();

/**
 * Get Page Fields
 */

$context['page'] = new Timber\Post();
$context['blog_fields'] = get_fields(12);
  
if($context['isMobile']) {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'paged' => $paged,
    'post__not_in'  => get_option( 'sticky_posts' )
  );
}
else {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 12,
    'paged' => $paged,
    'post__not_in'  => get_option( 'sticky_posts' )
  );

  // Get popular posts
  $popular_posts = array( 
    'posts_per_page' => 3,
    'meta_key' => 'wpb_post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'ignore_sticky_posts' => 1
  );
  $context['popular_posts'] = new Timber\PostQuery($popular_posts);

  // Get fact
  $fact = array(
    'post_type' => 'post',
    'posts_per_page' => 1,
    'post__not_in'  => get_option( 'sticky_posts' ),
    'meta_query' => array(
      array(
        'key' => 'post_fact_display',
        'value' => true,
        'compare' => 'LIKE'
      )
    ) 
  );
  $context['fact'] = new Timber\PostQuery($fact);
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

// $context['pagination'] = $context['posts']->pagination($pagination_prefs);
    
Timber::render( 'pages/blog.twig', $context );