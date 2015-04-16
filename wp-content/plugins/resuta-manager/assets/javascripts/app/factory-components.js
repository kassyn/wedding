Module( 'Apiki.FactoryComponents', function(FactoryComponents) {

	Apiki.Components = ( Apiki.Components || {} );

	FactoryComponents.create = function(container) {
		container.isExist( '[data-component]', this._constructor.bind( this ) );
	};

	FactoryComponents._constructor = function(elements) {
		elements.each( this._each.bind( this ) );
	};

	FactoryComponents._each = function(index, element) {
		var $el  = jQuery( element )
		  , name = Apiki.Utils.toTitleCase( $el.data( 'component' ) )
		;

		if ( typeof Apiki.Components[name] != 'function' ) {
			return;
		}

		Apiki.Components[name].call( null, $el );
	};

}, {} );
