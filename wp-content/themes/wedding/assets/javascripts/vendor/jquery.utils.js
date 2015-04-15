;(function($) {

	$.fn.byElement = function(name) {
		return this.find( '[data-element-' + name + ']' );
	};

	$.fn.isExist = function(selector, callback) {
		var element = this.find( selector );

		if ( element.length && typeof callback == 'function' ) {
			callback.call( null, element, this );
		}

		return element.length;
	};

	$.fn.isEmptyValue = function() {
		return !( $.trim( this.val() ) );
	};

	$.fn.valInt = function() {
		return parseInt( this.val(), 10 );
	};

	$.fn.addClassReFlow = function(name) {
		this.css( 'display', 'block' );
		//force reflow
		this[0].offsetWidth;
		this.addClass( name );
	};

})( jQuery );
