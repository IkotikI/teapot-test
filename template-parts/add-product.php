<div class="product-editor-form add-product">
	<input type="hidden" name="action" value="add-product">
	<input type="text" name="name" placeholder="Name">
	<input type="text" name="slug" placeholder="Slug">
	<textarea rows="4" cols="50" name="description" placeholder="Description"></textarea>
	<select name="status">
		<option value="publish">Publish</option>
		<option value="private">Private</option>
	</select>
	<button id="add-product" class="btn">Add</button>
</div>