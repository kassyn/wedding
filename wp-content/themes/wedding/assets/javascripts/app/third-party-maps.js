Module( 'Resuta.ThirdParty.Maps', function(Maps) {

	Maps.callbacks          = [];
	Maps._isExecuteCallback = false;

	Maps.getScriptService = function(context, method) {
		if ( this._isExecuteCallback ) {
			jQuery.proxy( context, method ).call( null );
			return;
		}

		this.callbacks.push( jQuery.proxy( context, method ) );
		this.getScript();
	};

	Maps.isExistScript = function() {
		return ( document.getElementById( 'google-service-maps' ) );
	};

	Maps.getScript = function() {
		if ( this.isExistScript() ) {
			return;
		}

		var params = {
			'callback' : 'Resuta.ThirdParty.Maps.onLoadScript',
			'key'      : 'AIzaSyDUX1SdMjfsjl30ycd9-yqmrMaa-FqPWgw',
			'v'		   : '3.exp'
		};

		jQuery( '<script>', {
			src : Resuta.Utils.addQueryVars( params, 'http://maps.googleapis.com/maps/api/js' ),
			id  : 'google-service-maps'
		}).insertBefore( 'script:first' );	
	};

	Maps.onLoadScript = function() {
		( this.callbacks || [] ).forEach(function(callback) {
			( callback || jQuery.noop ).call( null );
		});

		this._isExecuteCallback = true;
	};

}, {});