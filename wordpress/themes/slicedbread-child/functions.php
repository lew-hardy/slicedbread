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

  // Remove default Add to Cart
  remove_action(
    'woocommerce_single_product_summary',
    'woocommerce_template_single_add_to_cart',
    30
  );

  // Add Request a Quote button
  add_action('woocommerce_single_product_summary', function () {
    echo '<a href="#" class="button popmake-37">Request a Quote</a>';
  }, 30);
});
