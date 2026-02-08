# Slicedbread Interview Task

This repository contains platform-specific implementations
of the Slicedbread PDP for comparison purposes.

## Structure
- /wordpress – WooCommerce PDP implementation
- /shopify – Shopify PDP implementation

## Shopify PDP Image Management (Color Variants)

For products with Color variants, PDP images are managed directly through the
Shopify Product CMS.

To associate images with a specific color:
- Add a **Color** option to the product (e.g. `Black`, `Rustic Brown`)
- For each product image, set the **image ALT text** in the format:
  - `Color: Black`
  - `Color: Rustic Brown`

When a customer selects a color on the PDP, the product image gallery updates
client-side to show only images associated with the selected color, without
reloading the page.

This approach keeps image management fully CMS-driven and avoids the need for
duplicate products or hardcoded image mappings.

## WordPress Plugins

The following third-party plugins are used for the WordPress portion of this test
and are installed via the WordPress admin. These plugins are not committed to
this repository.

- WooCommerce
- Advanced Custom Fields (ACF) – Free
- Contact Form 7 (Quote Request form)

Each platform follows best practices for version control
and deployment.
