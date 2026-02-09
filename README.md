# Slicedbread Interview Task

This repository contains platform-specific implementations
of the Slicedbread PDP for comparison purposes.

## Structure
- /wordpress – WooCommerce PDP implementation
- /shopify – Shopify PDP implementation

---

## Shopify PDP Implementation

### “Others Like You Also Bought” (Above the Fold)

The Shopify PDP includes a configurable **“Others Like You Also Bought”** module
positioned within the main product information column (beside the product image
gallery and below the primary PDP details).

This module is implemented as a **custom block inside the `main-product` section**
to ensure it renders within the PDP’s right-hand content area rather than as a
full-width section below the page.

#### Configuration Options (Theme Editor)
The block supports two merchant-selectable modes:

- **Automatic mode**
  - Merchant selects a collection.
  - Two products are selected dynamically from that collection using a rotating,
    time-based offset to provide a “randomized” storefront experience.
  - The currently viewed product is excluded from results.

- **Manual mode**
  - Merchant selects up to two specific products directly within the PDP’s
    admin settings.
  - Duplicate products and the current product are automatically excluded.

All configuration is managed via the **Theme Editor** without requiring any code
changes.

#### Rendering & UX
- Uses Dawn’s native `card-product` snippet for visual and behavioral consistency.
- Renders inline within the PDP’s main information column to match the provided
  reference design.
- No page reloads or navigation are required when interacting with the module.

---

## WordPress Plugins

The following third-party plugins are used for the WordPress portion of this test
and are installed via the WordPress admin. These plugins are not committed to
this repository.

- WooCommerce
- Advanced Custom Fields (ACF) – Free
- Contact Form 7 (Quote Request form)

---

Each platform follows best practices for version control,
deployment, and CMS-first configurability, with all PDP content
and behavior designed to be manageable by non-technical users.
