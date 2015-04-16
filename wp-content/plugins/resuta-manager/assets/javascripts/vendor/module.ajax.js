Module.wrapper( 'Module.AjaxWrapper', function(namespace, callback) {

	Module( 'Apiki.Ajax.' + namespace, function(Model) {

		Model.fn.initialize = function() {
			this.emitter();
		};

		Model.fn.emitter = function() {
			var emitter = jQuery({});
			this.on     = jQuery.proxy( emitter, 'on' );
			this.fire   = jQuery.proxy( emitter, 'trigger' );
		};

		Model.fn._done = function(identifier, response) {
			this.fire( 'ajax.done' + identifier, [ response ] );
		};

		Model.fn._fail = function(identifier, throwError, status) {
			this.fire( 'ajax.fail' + identifier, [ throwError.responseJSON, status ] );
		};

		callback( Model );

	});

});
