<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_purchasable() ) {
	return;
}
?>

<div class="slicedbread-quote-actions">
	<?php
	// Keep quantity input
	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
		)
	);
	?>

	<a href="#"
	   class="button popmake-36"
	   data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
		Request a Quote
	</a>
</div>
