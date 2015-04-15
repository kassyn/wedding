jQuery(function() {
	var context = jQuery( 'body' )
	  , module  = context.data( 'route' )
	;

	Resuta.vars = {
		body   : context,
		module : module
	};

	//set route in application
	Dispatcher( Resuta.Application, module, [context] );
});