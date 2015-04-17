Module.ComponentWrapper( 'Presence', function(Presence) {

	Presence.fn.init = function() {
		this.send    = this.$el.byElement( 'send' );
		this.message = this.$el.byElement( 'message' );
		this.lock    = false;
		this.load();
	};

	Presence.fn.load = function() {
		this.addEventListener();
	};

	Presence.fn.addEventListener = function() {
		this.$el.on( 'submit', this._onSendInServer.bind( this ) );
	};

	Presence.fn._onSendInServer = function(event) {
		event.preventDefault();

		if ( this.lock || !this.isValidate() ) {
			return;
		}

		this.request();
	};

	Presence.fn.request = function() {
		var ajax = jQuery.ajax({
			type     : 'POST',
			url      : Resuta.Utils.getUrlAjax(),
			data     : this.$el.serialize(),
			dataType : 'json'
		});

		this._before();

		ajax.done( this._done.bind( this ) );
		ajax.fail( this._fail.bind( this ) );
	};

	Presence.fn.clear = function() {
		this.$el
			.find( '[type=text], [type=number]' )
				.val( '' )
		;

		this.send.val( 'Confirmar Presença' );		
	};

	Presence.fn._before = function() {
		this.send.val( 'Aguarde...' );
		this.lock = true;
	};

	Presence.fn._done = function(response) {
		this.message
			.text( response.message )
			.addClass( 'show' )
		;
		
		this.clear();
		this.lock = false;
	};

	Presence.fn._fail = function(throwError, status) {
		this.message
			.text( 'Ops! Ocorreu um erro, tente novamente.' )
			.addClass( 'show' )
		;

		this.lock = false;
	};

	Presence.fn.isValidate = function() {
		var name   = this.$el.find( '[type=text]' )
		  , number = this.$el.find( '[type=number]' )
		;  

		this._clearValidate();

		if ( name.isEmptyValue() ) {
			name.addClass( 'error-validate' );
			return false;
		}

		if ( !number.valInt() ) {
			number.addClass( 'error-validate' );
			return false;
		}

		return true;
	};

	Presence.fn._clearValidate = function() {
		this.$el
			.find( '.error-validate' )
				.removeClass( 'error-validate' )
		;

		this.message.removeClass( 'show' );
	};

});