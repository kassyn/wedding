;(function($, window) {
	
	var HTML = '<span style="display: block;" class="spinner"></span>';

	$.fn.spinnerShow = function(insertion) {
		this[insertion].call( this, HTML );
	};

	$.fn.spinnerHide = function() {
		this.siblings( '.spinner' )
		    	.remove()
		    .end()	
		    .find( '.spinner' )
		    	.remove()
		;
	};

})( jQuery, window );