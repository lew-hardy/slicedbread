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

// Add stock status flag to single product summary, before price/quote button
add_action('woocommerce_single_product_summary', function () {
  global $product;

  if (!$product) return;

  $in_stock = $product->is_in_stock();

  echo '<div class="sb-stock-flag sb-stock-flag--' . ($in_stock ? 'in' : 'out') . '">';
  echo $in_stock ? 'IN STOCK' : 'OUT OF STOCK';
  echo '</div>';
}, 6);


// Accordions for additional product info, using ACF fields for content. Only show if content exists, and allow title-only accordions to support legacy content without needing updates.
add_action('woocommerce_single_product_summary', function () {
  if (!function_exists('get_field')) {
    return;
  }

  $product_id = get_the_ID();
  if (!$product_id) return;

  $items = array();

  for ($i = 1; $i <= 3; $i++) {
    $title   = get_field("accordion_{$i}_title", $product_id);
    $content = get_field("accordion_{$i}_content", $product_id);

    // Only render when there is content (titles alone can be misleading)
    if (!empty($content)) {
      $items[] = array(
        'title'   => !empty($title) ? $title : "Details {$i}",
        'content' => $content,
      );
    }
  }

  if (empty($items)) return;

  echo '<div class="sb-accordions" aria-label="Product information">';

  $rendered = 0;
  foreach ($items as $item) {
    $open_attr = ($rendered === 0) ? ' open' : '';

    echo '<details class="sb-accordion"' . $open_attr . '>';
    echo '<summary class="sb-accordion__title">' . esc_html($item['title']) . '</summary>';
    echo '<div class="sb-accordion__content">' . wp_kses_post($item['content']) . '</div>';
    echo '</details>';

    $rendered++;
  }

  echo '</div>';
}, 35);
