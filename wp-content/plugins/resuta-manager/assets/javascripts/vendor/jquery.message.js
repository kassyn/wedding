;(function($, window) {

	var HTML = '<div class="[type] render-message"><p><strong>[message]</strong></p></div>';

	function compile(type, message) {
		return HTML.replace( /\[type\]/, type ).replace( /\[message\]/, message );
	};

	$.fn.messageShowAfter = function(type, message, isRemove) {
		( isRemove && this.messageHideAfter() );
		this.after( compile( type, message ) );
	};

	$.fn.messageShowBefore = function(type, message, isRemove) {
		( isRemove && this.messageHideBefore() );
		this.before( compile( type, message ) );
	};

	$.fn.messageHideBefore = function() {
		this.prev( '.render-message' ).remove();
	};

	$.fn.messageHideAfter = function() {
		this.next( '.render-message' ).remove();
	};

})( jQuery, window );
