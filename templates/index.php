<?php get_header(); ?>

<div class="page">
	<section class="products products-edit">
		<div id="product-list">
			<?php get_template_part('product-list'); ?>
		</div>

		<?php get_template_part('add-product'); 

		// global $db;
		//  $last_id = $db->get_row('SELECT `ID` FROM `products` ORDER BY `ID` DESC', ARRAY_A);
		// print_r( $last_id ); 

		the_pagination(); ?>

	</section>
</div>
<?php get_footer();