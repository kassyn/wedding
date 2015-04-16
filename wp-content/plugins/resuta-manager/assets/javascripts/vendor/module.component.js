Module.wrapper( 'Module.ComponentWrapper', function(namespace, callback) {

	Module( 'Apiki.Components.' + namespace, function(Model) {

		Model.fn.initialize = function(container) {
			this.$el = container;
			this.assign();
			this.init();
		};

		Model.fn.assign = function() {
      		var attrs = this.$el.data();

      		for ( var name in attrs ) {
        		this[name] = attrs[name];
      		}
    	};

    	Model.fn.init = function() {

    	};

		callback( Model );

	});

});
