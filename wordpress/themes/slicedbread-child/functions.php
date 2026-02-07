<?php

/**
 * Enqueue child theme styles
 */
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'slicedbread-child',
    get_stylesheet_uri(),
    array(),
    '1.0.0'
  );
});

/**
 * PDP customisations
 */
add_action('wp', function () {
  // Only run on single product pages with WooCommerce active
  if (!function_exists('is_product') || !is_product()) {
    return;
  }
});
