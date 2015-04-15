Module.ComponentWrapper( 'Place', function(Place) {

	Place.fn.init = function() {
		this.canvas = this.$el.byElement( 'canvas' );
		this.maps   = null;
		this.load();
	};

	Place.fn.load = function() {
		this.getService();
	};

	Place.fn.getService = function() {
		Resuta.ThirdParty.Maps.getScriptService( this, 'finallyService' );
	};	

});