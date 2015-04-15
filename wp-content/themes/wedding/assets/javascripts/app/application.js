Module( 'Resuta.Application', function(Application) {

	Application.init = function(container) {
		Resuta.FactoryComponents.create( container );
	};

	Application.home = function(container) {
		Application.setDefaultMenu();
		Application.setMenu();
	};

	Application.setMenu = function() {
		var menu = jQuery( '.navigation' );

		menu.find( 'a' ).scrollToPage();

		Resuta.vars.body.on( 'scrolltopage-animated', function(e, target, href) {
			menu.find( '.active' ).removeClass( 'active' );
			target.parent( 'li' ).addClass( 'active' );
		});
	};

	Application.setDefaultMenu = function() {
		var hash = window.location.hash;		  

		if ( !hash ) {
			return;
		}

		jQuery( '.navigation li:has([href=' + hash + '])' ).addClass( 'active' );
	};

}, {} );
