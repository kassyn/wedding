Module( 'Resuta.Utils', function(Utils) {

	Utils.toTitleCase = function(text) {
	    text = text.replace(/(?:^|-)\w/g, function(match) {
	        return match.toUpperCase();
	    });

	    return text.replace(/-/g, '');
	};	

	Utils.addQueryVars = function(params, url) {
		var listParams = [];

		for ( var item in params ) {
			listParams.push( item + '=' + params[ item ] );
		}

		return url + ( url.match(/\/\?/) ? '&' : '?' ) + listParams.join( '&' );
	};

	Utils.getUrlAjax = function() {
		return ( window.SiteGlobalVars || {} ).urlAjax;
	};

}, {} );