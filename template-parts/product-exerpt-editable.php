<?php global $product; ?>
<div class="product-exerpt-editable product-editor-form">
<!-- 	<div class="product-name"><?php echo $product['product_name'] ?></div>
	<div class="product-slug"><?php echo $product['product_slug'] ?></div>
	<div class="product-description"><?php echo $product['product_description'] ?></div>
	<div class="product-status"><?php echo $product['product_status'] ?></div> -->

	<input type="hidden" name="action" value="update-product">
	<input type="hidden" name="id" value="<?php echo $product['ID'] ?>">
	<input type="text" name="name" value="<?php echo $product['product_name'] ?>">
	<input type="text" name="slug" value="<?php echo $product['product_slug'] ?>">
	<textarea rows="4" cols="50" name="description"><?php echo $product['product_description'] ?></textarea>
	<select name="status">
		<?php $statuses = get_status_options();

		foreach ($statuses as $key => $name ): 
			?>
			<option value="<?php echo $key ?>" <?php echo ( $product['product_status'] == $key ) ? 'selected' : '' ?> ><?php echo $name ?></option>
		<?php endforeach; ?>
	</select>
	<div class="save-product btn">Update</div>

</div>