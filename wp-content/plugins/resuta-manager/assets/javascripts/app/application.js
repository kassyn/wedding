Module( 'Apiki.Application', function(Application) {

	Application.init = function(container) {
		Apiki.FactoryComponents.create( container );
	};

}, {} );
