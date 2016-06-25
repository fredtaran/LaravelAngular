$( document ).ready( function() {

	$( '.loading' ).hide();

	$( 'form[id="uploadFile"]' ).on( 'submit', function( event ) {

		event.preventDefault();

		$( '.loading' ).show();

		var formData = new FormData();
		formData.append( 'fileToUpload', $('input[type=file')[0].files[0] );

		$.ajax({
			'url': window.location.origin,
			'type': 'POST',
			'data': formData,
			'headers': { 'X-CSRF-TOKEN': $( 'input[name="_token"]' ).val() },
			'contentType': false,
			'processData': false
		})
		.done( function( response ) {
			$( '.loading' ).hide();
			$('#fileToUpload').val('')
			$( '#errorMessage' ).text( response.fileToUpload );
		});

	});

});

