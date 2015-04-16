Module.ComponentWrapper( 'Place', function(Place) {

	Place.fn.init = function() {
		this.canvas = this.$el.byElement( 'canvas' );
		this.maps   = null;
		this.marker = null;
		this.load();
	};

	Place.fn.load = function() {
		this.getService();
	};

	Place.fn.getService = function() {
		Resuta.ThirdParty.Maps.getScriptService( this, 'finallyService' );
	};

	Place.fn.finallyService = function() {		
		this.render();
	};

	Place.fn.render = function() {
		var options = this.getMapsArgs();

		this.maps = new google.maps.Map(
  			  this.canvas.get(0)
  			, options
  		);

  		this.marker = new google.maps.Marker({
		    position : options.center,
		    map      : this.maps,
		    icon     : this.icon,
		    title    : 'Catedral de Santo Antônio'
		});
	};

	Place.fn.getMapsArgs = function() {
		return {
			center      : new google.maps.LatLng( this.lat, this.lng ),
			scrollwheel : false,
			zoom        : 17
		};
	};

});