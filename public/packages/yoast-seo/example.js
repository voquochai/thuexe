var SnippetPreview = require( "./js/snippetPreview" );
var App = require( "./js/app" );

var forEach = require( "lodash/forEach" );
var escape = require( "lodash/escape" );

/**
 * Set the locale.
 *
 * @returns {void}
 */
var setLocale = function() {
	this.config.locale = document.getElementById( "locale" ).value;
	this.initializeAssessors( this.config );
	this.initAssessorPresenters();
	this.refresh();
};

/**
 * Binds the renewData function on the change of input elements.
 *
 * @param {YoastSEO.App} app The YoastSEO.js app.
 *
 * @returns {void}
 */
var bindEvents = function( app ) {
	var elems = [ "content", "focusKeyword", "locale" ];
	for ( var i = 0; i < elems.length; i++ ) {
		document.getElementById( elems[ i ] ).addEventListener( "input", app.refresh.bind( app ) );
	}
	document.getElementById( "locale" ).addEventListener( "input", setLocale.bind( app ) );
};

window.onload = function() {
	var snippetPreview = new SnippetPreview( {
		targetElement: document.getElementById( "snippet" ),
	} );

	var app = new App( {
		snippetPreview: snippetPreview,
		targets: {
			output: "output",
			contentOutput: "contentOutput",
		},
		callbacks: {
			getData: function() {
				return {
					keyword: document.getElementById( "focusKeyword" ).value,
					text: document.getElementById( "content" ).value,
				};
			},
		},
		marker: function( paper, marks ) {
			var text = paper.getText();

			forEach( marks, function( mark ) {
				text = mark.applyWithReplace( text );
			} );

			document.getElementsByClassName( "marked-text" )[ 0 ].innerHTML = text;

			document.getElementsByClassName( "marked-text-raw" )[ 0 ].innerHTML = escape( text );
		},
	} );

	bindEvents( app );

	app.refresh();

	var refreshAnalysis = document.getElementById( "refresh-analysis" );

	refreshAnalysis.addEventListener( "click", function() {
		app.getData();
		app.runAnalyzer();
	} );
};