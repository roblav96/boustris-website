//

$( document ).ready( function () {
	$( '#collapse' ).on( 'shown.bs.collapse', function () {
		$( "section" ).click( function () {
			$( "#collapse" ).collapse( 'hide' )
		} )
		$( "a" ).click( function () {
			$( "#collapse" ).collapse( 'hide' )
		} )
	} )

	$( function () {
		$( '[data-toggle="tooltip"]' ).tooltip()
	} )


} );



function recaptchaz() {
	$( "#submitz" ).removeAttr( 'disabled' );
}

