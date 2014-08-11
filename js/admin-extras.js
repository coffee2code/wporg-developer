/**
 * Admin extras backend JS.
 */
//window.wp = window.wp || {};

( function( window, $, undefined ) {
	var editorOuter  = $( '#wporg_editor_outer' ),
		ticketNumber = $( '#wporg_parsed_ticket' ),
		fetchButton  = $( '#wporg_ticket_fetch' ),
		ticketInfo   = $( '#wporg_parsed_ticket_info' ),
		nonce        = $( '#wporg-get-ticket-nonce' );

	var fetchTicket = function( event ) {
		event.preventDefault();

		var data = {
			action: 'wporg_fetch_ticket',
			ticket: ticketNumber.val(),
			nonce:  $(this).data( 'nonce' )
		};

		// Preserve this.
		var $this = $(this);

		$.post( wporg.ajaxURL, data, function( resp ) {
			console.log( resp );
			// Message or ticket title.
			ticketInfo.text( resp.message );

			// Update the nonce.
			$this.data( 'nonce', resp.new_nonce );

			// Handle the response.
			if ( resp.type && 'success' == resp.type ) {
				// Show the parsed content editor.
				editorOuter.show();

				// Set the ticket link icon
				$( '#ticket_info_icon' ).addClass( 'dashicons dashicons-external' );

				// Set the ticket number as readonly while a ticket is attached.
//				ticketNumber.prop( 'readonly', 'readonly' );

				// Update the button to detach.
//				fetchButton.text( wporg.detachText );
			} else {
				fetchButton.text( wporg.retryText );
			}
		}, 'json' );
	};

	fetchButton.on( 'click', fetchTicket );

} )( this, jQuery );
