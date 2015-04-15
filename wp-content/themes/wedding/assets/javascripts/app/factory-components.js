Module( 'Resuta.FactoryComponents', function(FactoryComponents) {

	Resuta.Components = ( Resuta.Components || {} );

	FactoryComponents.create = function(container) {
		container.isExist( '[data-component]', this._constructor.bind( this ) );
	};

	FactoryComponents._constructor = function(elements) {
		elements.each( this._each.bind( this ) );
	};

	FactoryComponents._each = function(index, element) {
		var $el  = jQuery( element )
		  , name = Resuta.Utils.toTitleCase( $el.data( 'component' ) )
		;

		if ( typeof Resuta.Components[name] != 'function' ) {
			return;
		}

		Resuta.Components[name].call( null, $el );
	};

}, {} );
