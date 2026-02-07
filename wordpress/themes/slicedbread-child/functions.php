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

add_action('woocommerce_single_product_summary', function () {
  global $product;

  if (!$product) return;

  $in_stock = $product->is_in_stock();

  echo '<div class="sb-stock-flag sb-stock-flag--' . ($in_stock ? 'in' : 'out') . '">';
  echo $in_stock ? 'IN STOCK' : 'OUT OF STOCK';
  echo '</div>';
}, 6);
