Module( 'Resuta.Application', function(Application) {

	Application.init = function(container) {
		Resuta.FactoryComponents.create( container );
	};

	Application.home = function(container) {
		Application.setGenericActions();
		Application.setDefaultMenu();
		Application.setMenu();
	};

	Application.setGenericActions = function() {
		var wrapper = jQuery( '#wrapper' );
		
		Resuta.vars.body.on( 'click', '[data-action=confirm]', function(event) {
			event.preventDefault();
			wrapper.toggleClass( 'active-form' );
		});
	};

	Application.setMenu = function() {
		var menu = jQuery( '.navigation' );

		menu.find( 'a:not([data-action=confirm])' ).scrollToPage();

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
