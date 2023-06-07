$( document ).ready(function() {
		var name, slug, description, status, action, data, form;
	$('#add-product').click(function() {
		name = $('.add-product input[name="name"]').val();
		slug = $('.add-product input[name="slug"]').val();
		description = $('.add-product textarea[name="description"]').val();
		status = $('.add-product select[name="status"]').val();
		action = $('.add-product input[name="action"]').val();

		data = {action: action, name: name, slug: slug, description: description, status: status};

		console.log('action: ' + action, ', name: ' + name);

		$.ajax({
			url: window.location.origin + '/actions.php',
			method: 'post',
			data: data,
			beforeSend: function() {
				console.log('Ajax beforeSend', data);
			},
			complete: function( result ) {
				console.log('Ajax complete', result );
				// console.log('Ajax complete', result.responseJSON );
				// console.log(result.responseText);
				
			},
			success: function( result ) {
				console.log('Ajax succsess', result );
				$('#product-list').html(result.refreshed_contents);
			},
			error: function( result ) {
				console.log('Ajax error', result );
			}
		});

	});

	function set_variables( _form ) {
		form = $(_form).closest('.product-editor-form');
		id = form.find('input[name="id"]').val();
		name = form.find('input[name="name"]').val();
		slug = form.find('input[name="slug"]').val();
		description = form.find('textarea[name="description"]').val();
		status = form.find('select[name="status"]').val();
		action = form.find('input[name="action"]').val();
	}

	function update_ajax() {

		data = {id: id, action: action, name: name, slug: slug, description: description, status: status};

		console.log(data);

		$.ajax({
			url: window.location.origin + '/actions.php',
			method: 'post',
			data: data,
			beforeSend: function() {
				console.log('Ajax beforeSend', data);
			},
			complete: function( result ) {
				console.log('Ajax complete', result );
				// console.log('Ajax complete', result.responseJSON );
				// console.log(result.responseText);
				
			},
			success: function( result ) {
				console.log('Ajax succsess', result );
				$('#product-list').html(result.refreshed_contents);
				set_handlers();
			},
			error: function( result ) {
				console.log('Ajax error', result );
			}
		});
	}

	function set_handlers() {
		$('.save-product').click(function() {
			// form = $(this).closest('.product-editor-form');
			set_variables(this);
			update_ajax();
		});
	}

	set_handlers();

});