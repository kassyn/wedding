jQuery(function() {
	var context = jQuery( 'body' );

	Apiki.vars = {
		body : context
	};

	//set route in application
	Dispatcher( Apiki.Application, window.pagenow, [context] );
});
