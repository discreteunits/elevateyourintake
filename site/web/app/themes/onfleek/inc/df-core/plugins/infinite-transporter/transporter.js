(function($){

// Local vars
var Scroller, ajaxurl, stats, type, text, totop, timer;

// IE requires special handling
var isIE = ( -1 != navigator.userAgent.search( 'MSIE' ) );
if ( isIE ) {
	var IEVersion = navigator.userAgent.match(/MSIE\s?(\d+)\.?\d*;/);
	var IEVersion = parseInt( IEVersion[1] );
}

/**
 * Loads new posts when users scroll near the bottom of the page.
 */
Scroller = function( settings ) {
	var self = this;

	// Initialize our variables
	this.id               = settings.id;
	this.body             = $( document.body );
	this.window           = $( window );
	this.element          = ( $( '#' + settings.id ).length ) ? $( '#' + settings.id ) : $( '.' + settings.id );
	this.wrapperClass     = settings.wrapper_class;
	this.ready            = true;
	this.disabled         = false;
	this.page             = 1;
	this.offset           = settings.offset;
	this.currentday       = settings.currentday;
	this.order            = settings.order;
	this.throttle         = false;
	this.handle           = '<div id="infinite-handle"><span>' + text.replace( '\\', '' ) + '</span></div>';
	this.click_handle     = settings.click_handle;
	this.google_analytics = settings.google_analytics;
	this.history          = settings.history;
	this.origURL          = window.location.href;
	this.postID           = settings.postID;
	this.postTitle        = settings.postTitle;
	this.origTitle        = document.title;
	this.postUrl          = settings.postUrl;
	this.curPage          = 0;
	this.the_titles       = [];
	this.the_urls         = [];
	this.debug            = false;
	this.currentPageNum	  = 0;
	// Footer settings
	this.footer           = $( '#infinite-footer' );
	this.footer.wrap      = settings.footer;

	this.the_post_url 	= [];
	this.the_post_title = [];

	// custom for passing cat, cat url, & comment count for sticky
	this.the_cat 		= [];
	this.the_cats 		= [];
	this.the_cat_url 	= [];
	this.the_cat_urls	= [];
	this.the_comment 	= [];
	this.the_comments 	= [];
	this.the_next_title = [];
	this.the_next_titles = [];
	this.the_next_url = [];
	this.the_next_urls = [];

	this.postCat = settings.postCat;
	this.postCatUrl = settings.postCatUrl;
	this.postComment = settings.postComment;
	this.nextTitle = settings.nextTitle;
	this.nextUrl = settings.nextUrl;

	this.title_first;
	this.url_first;
	this.cat_first;
	this.cat_url_first;
	this.comment_count_first;
	this.next_title_first;
	this.next_url_first;
	this.isFirstPageUpdated = false;
	this.email = $('#sticky-share-email');
	this.fb = $('#sticky-share-fb');
	this.twitter = $('#sticky-share-twitter');
	this.linkedin = $('#sticky-share-linkedin');
	this.google = $('#sticky-share-google');
	this.pinterest = $('#sticky-share-pinterest');

	// Core's native MediaElement.js implementation needs special handling
	this.wpMediaelement   = null;

	// We have two type of infinite scroll
	// cases 'scroll' and 'click'

	if ( type == 'scroll' ) {
		// Bind refresh to the scroll event
		// Throttle to check for such case every 300ms

		// On event the case becomes a fact
		this.window.bind( 'scroll.infinity', function() {
			this.throttle = true;
		});

		// Go back top method
		self.gotop();

		setInterval( function() {
			if ( this.throttle ) {
				// Once the case is the case, the action occurs and the fact is no more
				this.throttle = false;
				// Reveal or hide footer
				self.thefooter();
				// Fire the refresh
				self.refresh();
			}
		}, 300 );

		// Ensure that enough posts are loaded to fill the initial viewport, to compensate for short posts and large displays.
		self.ensureFilledViewport();
		this.body.bind( 'post-load', { self: self }, self.checkViewportOnLoad );
		this.body.bind( 'post-load', { self: self }, self.initializeMejs );
	} else if ( type == 'click' ) {
		if ( this.click_handle ) {
			this.element.append( this.handle );
		}

		this.body.delegate( '#infinite-handle', 'click.infinity', function() {
			// Handle the handle
			if ( self.click_handle ) {
				$( '#infinite-handle' ).remove();
			}
			// Fire the refresh
			self.refresh();
		});
	}
};

/**
 * Check whether we should fetch any additional posts.
 */
Scroller.prototype.check = function() {
	var container = this.element.offset();

	// If the container can't be found, stop otherwise errors result
	if ( 'object' !== typeof container ) {
		return false;
	}

	var bottom = this.window.scrollTop() + this.window.height(),
		threshold = container.top + this.element.outerHeight(false) - ( this.window.height() * 2);
		footerHeigth = $('#df-footer-wrapper').position().top;
		newThreshold = this.element.outerHeight(false) - ( ( this.window.height() + footerHeigth ) );

	//console.log("bottom = " + bottom + " || treshold = " + threshold + " || footer height = " + footerHeigth + " new tereshold = " + newThreshold + " || elemet outerHeight = " + this.element.outerHeight(false) )	;	
	return bottom > footerHeigth;
	//return bottom > threshold;
};

/**
 * Renders the results from a successful response.
 */
Scroller.prototype.render = function( response ) {
	this.body.addClass( 'infinity-success' );

	// Check if we can wrap the html
	//this.element.append( response.html );
	$(response.html).insertBefore("#df-footer-wrapper");
	//console.log( this.element );
	this.body.trigger( 'post-load', response );
	dfFramework.reInit();
	this.ready = true;
};

/**
 * Returns the object used to query for new posts.
 */
Scroller.prototype.query = function() {
	return {
		page           : this.page,
		currentday     : this.currentday,
		order          : this.order,
		postID         : window.infiniteScroll.settings.postID,
		postID_order   : this.postID,
		postTitle      : this.postTitle,
		postUrl        : this.postUrl,
		scripts        : window.infiniteScroll.settings.scripts,
		styles         : window.infiniteScroll.settings.styles,
		query_args     : window.infiniteScroll.settings.query_args,
		last_post_date : window.infiniteScroll.settings.last_post_date
	};
};

/**
 * Scroll back to top.
 */
Scroller.prototype.gotop = function() {
	var blog = $( '#infinity-blog-title' );

	blog.attr( 'title', totop );

	// Scroll to top on blog title
	blog.bind( 'click', function( e ) {
		$( 'html, body' ).animate( { scrollTop: 0 }, 'fast' );
		e.preventDefault();
	});
};


/**
 * The infinite footer.
 */
Scroller.prototype.thefooter = function() {
	var self  = this,
		width;

	// Check if we have an id for the page wrapper
	if ( $.type( this.footer.wrap ) === "string" ) {
		width = $( 'body #' + this.footer.wrap ).outerWidth( false );

		// Make the footer match the width of the page
		if ( width > 479 )
			this.footer.find( '.container' ).css( 'width', width );
	}

	// Reveal footer
	if ( this.window.scrollTop() >= 350 )
		self.footer.animate( { 'bottom': 0 }, 'fast' );
	else if ( this.window.scrollTop() < 350 )
		self.footer.animate( { 'bottom': '-50px' }, 'fast' );
};


/**
 * Controls the flow of the refresh. Don't mess.
 */
Scroller.prototype.refresh = function() {
	var	self   = this,
		query, jqxhr, load, loader, color;
	// If we're disabled, ready, or don't pass the check, bail.
	if ( this.disabled || ! this.ready || ! this.check() )
	 return;

	// Let's get going -- set ready to false to prevent
	// multiple refreshes from occurring at once.
	this.ready = false;

	// Create a loader element to show it's working.
	if ( this.click_handle ) {
		if( ! $( '.infinite-loader' ).length ){
			$('<div class="infinite-loader"><div class="item-loader-container"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div></div>').appendTo("#df-content-wrapper .boxed");
			//$( '.site-container' ).append( '<div class="infinite-loader"></div>' );
		}else {

			$('.infinite-loader').remove();
			$('<div class="infinite-loader"><div class="item-loader-container"><div class="la-ball-pulse"><div></div><div></div><div></div></div></div></div>').appendTo("#df-content-wrapper .boxed");
		}
		
		loader = $( '.infinite-loader' );
	}

	// Generate our query vars.
	query = $.extend({
		action: 'infinite_transporter'
	}, this.query() );

	// Fire the ajax request.
	jqxhr = $.get( infiniteScroll.settings.ajaxurl, query );

	// Allow refreshes to occur again if an error is triggered.
	jqxhr.fail( function() {
		if ( self.click_handle ) {
			loader.hide();
		}

		self.ready = true;
	});

	// Success handler
	jqxhr.done( function( response ) {
			// On success, let's hide the loader circle.
			if ( self.click_handle ) {
				loader.hide();
			}

			// Check for and parse our response.
			if ( ! response )
				return;

			response = $.parseJSON( response );

			if ( ! response || ! response.type )
				return;

			// If there are no remaining posts...
			if ( response.type == 'empty' ) {
				// Disable the scroller.
				self.disabled = true;
				// Update body classes, allowing the footer to return to static positioning
				self.body.addClass( 'infinity-end' ).removeClass( 'infinity-success' );

			// If we've succeeded...
			} else if ( response.type == 'success' ) {
				// If additional scripts are required by the incoming set of posts, parse them
				if ( response.scripts ) {
					$( response.scripts ).each( function() {
						var elementToAppendTo = this.footer ? 'body' : 'head';

						// Add script handle to list of those already parsed
						window.infiniteScroll.settings.scripts.push( this.handle );

						// Output extra data, if present
						if ( this.extra_data ) {
							var data = document.createElement('script'),
								dataContent = document.createTextNode( "//<![CDATA[ \n" + this.extra_data + "\n//]]>" );

							data.type = 'text/javascript';
							data.appendChild( dataContent );

							document.getElementsByTagName( elementToAppendTo )[0].appendChild(data);
						}

						// Build script tag and append to DOM in requested location
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = this.src;
						script.id = this.handle;

						// If MediaElement.js is loaded in by this set of posts, don't initialize the players a second time as it breaks them all
						if ( 'wp-mediaelement' === this.handle ) {
							self.body.unbind( 'post-load', self.initializeMejs );
						}

						if ( 'wp-mediaelement' === this.handle && 'undefined' === typeof mejs ) {
							self.wpMediaelement = {};
							self.wpMediaelement.tag = script;
							self.wpMediaelement.element = elementToAppendTo;
							setTimeout( self.maybeLoadMejs.bind( self ), 250 );
						} else {
							document.getElementsByTagName( elementToAppendTo )[0].appendChild(script);
						}
					} );
				}

				// If additional stylesheets are required by the incoming set of posts, parse them
				if ( response.styles ) {
					$( response.styles ).each( function() {
						// Add stylesheet handle to list of those already parsed
						window.infiniteScroll.settings.styles.push( this.handle );

						// Build link tag
						var style = document.createElement('link');
						style.rel = 'stylesheet';
						style.href = this.src;
						style.id = this.handle + '-css';

						// Destroy link tag if a conditional statement is present and either the browser isn't IE, or the conditional doesn't evaluate true
						if ( this.conditional && ( ! isIE || ! eval( this.conditional.replace( /%ver/g, IEVersion ) ) ) )
							var style = false;

						// Append link tag if necessary
						if ( style )
							document.getElementsByTagName('head')[0].appendChild(style);
					} );
				}

				// Increment the page number
				self.page++;

				// Render the results
				self.render.apply( self, arguments );

				// If 'click' type and there are still posts to fetch, add back the handle
				if ( type == 'click' ) {
					if ( response.lastbatch ) {
						if ( self.click_handle ) {
							$( '#infinite-handle' ).remove();
						} else {
							self.body.trigger( 'infinite-transporter-posts-end' );
						}
					} else {
						if ( self.click_handle ) {
							self.element.append( self.handle );
						} else {
							self.body.trigger( 'infinite-transporter-posts-more' );
						}
					}
				}

				// Update currentday to the latest value returned from the server
				if (response.currentday)
					self.currentday = response.currentday;

				if (response.postID) {
					self.postID = response.postID;
					self.postTitle = response.postTitle;
					self.postUrl = response.postUrl;
					self.postCat = response.postCat;
					self.postCatUrl = response.postCatUrl;
					self.postComment = response.postComment;
					self.nextTitle = response.nextTitle;
					self.nextUrl = response.nextUrl;

					self.the_post_url.push( response.postUrl );
					self.the_post_title.push( response.postTitle );
					self.the_cat.push( response.postCat );// new 
					self.the_cat_url.push( response.postCatUrl );
					self.the_comment.push( response.postComment );
					self.the_next_title.push( response.nextTitle );
					self.the_next_url.push( response.nextUrl );
				}

				// Fire Google Analytics pageview
				if ( self.google_analytics ) {
					if( typeof self.postID == 'undefined' ) {
						var ga_url = self.history.path.replace( /%d/, self.page );
					} else {
						var ga_url = response.postPath;
					}

					if ( 'object' === typeof _gaq ) {
						_gaq.push( [ '_trackPageview', ga_url ] );
					}
					if ( 'function' === typeof ga ) {
						ga( 'send', 'pageview', ga_url );
					}
				}
			}
		});

	return jqxhr;
};

/**
 * Core's native media player uses MediaElement.js
 * The library's size is sufficient that it may not be loaded in time for Core's helper to invoke it, so we need to delay until `mejs` exists.
 */
Scroller.prototype.maybeLoadMejs = function() {
	if ( null === this.wpMediaelement ) {
		return;
	}

	if ( 'undefined' === typeof mejs ) {
		setTimeout( this.maybeLoadMejs, 250 );
	} else {
		document.getElementsByTagName( this.wpMediaelement.element )[0].appendChild( this.wpMediaelement.tag );
		this.wpMediaelement = null;

		// Ensure any subsequent IS loads initialize the players
		this.body.bind( 'post-load', { self: this }, this.initializeMejs );
	}
}

/**
 * Initialize the MediaElement.js player for any posts not previously initialized
 */
Scroller.prototype.initializeMejs = function( ev, response ) {
	// Are there media players in the incoming set of posts?
	if ( -1 === response.html.indexOf( 'wp-audio-shortcode' ) && -1 === response.html.indexOf( 'wp-video-shortcode' ) ) {
		return;
	}

	// Don't bother if mejs isn't loaded for some reason
	if ( 'undefined' === typeof mejs ) {
		return;
	}

	// Adapted from wp-includes/js/mediaelement/wp-mediaelement.js
	// Modified to not initialize already-initialized players, as Mejs doesn't handle that well
	$(function () {
		var settings = {};

		if ( typeof _wpmejsSettings !== 'undefined' ) {
			settings.pluginPath = _wpmejsSettings.pluginPath;
		}

		settings.success = function (mejs) {
			var autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
			if ( 'flash' === mejs.pluginType && autoplay ) {
				mejs.addEventListener( 'canplay', function () {
					mejs.play();
				}, false );
			}
		};

		$('.wp-audio-shortcode, .wp-video-shortcode').not( '.mejs-container' ).mediaelementplayer( settings );
	});
}

/**
 * Trigger IS to load additional posts if the initial posts don't fill the window.
 * On large displays, or when posts are very short, the viewport may not be filled with posts, so we overcome this by loading additional posts when IS initializes.
 */
Scroller.prototype.ensureFilledViewport = function() {
	var	self = this,
	   	windowHeight = self.window.height(),
	   	postsHeight = self.element.height()
	   	aveSetHeight = 0,
	   	wrapperQty = 0;

	// Account for situations where postsHeight is 0 because child list elements are floated
	if ( postsHeight === 0 ) {
		$( self.element.selector + ' > li' ).each( function() {
			postsHeight += $( this ).height();
		} );

		if ( postsHeight === 0 ) {
			self.body.unbind( 'post-load', self.checkViewportOnLoad );
			return;
		}
	}

	// Calculate average height of a set of posts to prevent more posts than needed from being loaded.
	$( '.' + self.wrapperClass ).each( function() {
		aveSetHeight += $( this ).height();
		wrapperQty++;
	} );

	if ( wrapperQty > 0 )
		aveSetHeight = aveSetHeight / wrapperQty;
	else
		aveSetHeight = 0;

	// Load more posts if space permits, otherwise stop checking for a full viewport
	if ( postsHeight < windowHeight && ( postsHeight + aveSetHeight < windowHeight ) ) {
		self.ready = true;
		self.refresh();
	}
	else {
		self.body.unbind( 'post-load', self.checkViewportOnLoad );
	}
}

/**
 * Event handler for ensureFilledViewport(), tied to the post-load trigger.
 * Necessary to ensure that the variable `this` contains the scroller when used in ensureFilledViewport(). Since this function is tied to an event, `this` becomes the DOM element the event is tied to.
 */
Scroller.prototype.checkViewportOnLoad = function( ev ) {
	ev.data.self.ensureFilledViewport();
}

/**
 * Identify archive page that corresponds to majority of posts shown in the current browser window.
 */
Scroller.prototype.determineURL = function () {
	var self              = window.infiniteScroll.scroller,
		windowTop           = $( window ).scrollTop(),
		windowBottom        = windowTop + $( window ).height(),
		windowSize          = windowBottom - windowTop,
		setsInView          = [],
		pageNum             = false,
		pageChangeThreshold = 0.1;

	
	// Find out which sets are in view
	$( '.' + self.wrapperClass ).each( function() {
		var id         = $( this ).attr( 'id' ),
			setTop     = $( this ).offset().top,
			setHeight  = $( this ).outerHeight( false ),
			setBottom  = 0,
			setPageNum = $( this ).data( 'page-num' );

		// Account for containers that have no height because their children are floated elements.
		if ( 0 == setHeight ) {
			$( '> *', this ).each( function() {
				setHeight += $( this ).outerHeight( false );
			} );
		}

		// Determine position of bottom of set by adding its height to the scroll position of its top.
		setBottom = setTop + setHeight;

		// Set a value for the post URL, don't leave undefined.
		var tmp_post_url   = typeof self.the_post_url === 'undefined' || typeof  self.the_post_url[0] === 'undefined' ? '' : self.the_post_url[0];
		var tmp_post_title = typeof self.the_post_title === 'undefined' || typeof self.the_post_url[0] === 'undefined' ? '' : self.the_post_title[0];
		var tmp_post_cat = typeof self.the_cat === 'undefined' || typeof self.the_cat[0] === 'undefined' ? '' : self.the_cat[0]; // new 
		var tmp_post_cat_url = typeof self.the_cat_url === 'undefined' || typeof self.the_cat_url[0] === 'undefined' ? '' : self.the_cat_url[0];
		var tmp_post_comment = typeof self.the_comment === 'undefined' ? '' : self.the_comment[0]; 
		var tmp_next_title = typeof self.the_next_title === 'undefined' ? '' : self.the_next_title[0];
		var tmp_next_url = typeof self.the_next_url === 'undefined' ? '' : self.the_next_url[0];

		self.debugInfinity( 'the_post_url: ' + tmp_post_url);
		self.debugInfinity( 'the_post_title: ' + tmp_post_title);
		self.debugInfinity( 'the_cat: ' + tmp_post_cat );// new 
		self.debugInfinity( 'the_cat_url: ' + tmp_post_cat_url );
		self.debugInfinity( 'the_comment: ' + tmp_post_comment );
		self.debugInfinity( 'next title : ' + tmp_next_title );
		self.debugInfinity( 'next_url : ' + tmp_next_url );

		// Populate setsInView object. While this logic could all be combined into a single conditional statement, this is easier to understand.
		if ( setTop < windowTop && setBottom > windowBottom ) { // top of set is above window, bottom is below
			setsInView.push({
					'id': id, 
					'top': setTop, 
					'bottom': setBottom, 
					'pageNum': setPageNum, 
					'post_url': tmp_post_url, 
					'post_title': tmp_post_title,
					'post_cat' : tmp_post_cat, // new 
					'post_cat_url' : tmp_post_cat_url,
					'post_comment' : tmp_post_comment,
					'next_title' : tmp_next_title,
					'next_url' : tmp_next_url
				});
		}
		else if( setTop > windowTop && setTop < windowBottom ) { // top of set is between top (gt) and bottom (lt)
			setsInView.push({
					'id': id, 
					'top': setTop, 
					'bottom': setBottom, 
					'pageNum': setPageNum, 
					'post_url': tmp_post_url, 
					'post_title': tmp_post_title,
					'post_cat' : tmp_post_cat, // new 
					'post_cat_url' : tmp_post_cat_url,
					'post_comment' : tmp_post_comment,
					'next_title' : tmp_next_title,
					'next_url' : tmp_next_url
				});
		}
		else if( setBottom > windowTop && setBottom < windowBottom ) { // bottom of set is between top (gt) and bottom (lt)
			setsInView.push({
					'id': id, 
					'top': setTop, 
					'bottom': setBottom, 
					'pageNum': setPageNum, 
					'post_url': tmp_post_url, 
					'post_title': tmp_post_title,
					'post_cat' : tmp_post_cat, // new
					'post_cat_url' : tmp_post_cat_url,
					'post_comment' : tmp_post_comment,
					'next_title' : tmp_next_title,
					'next_url' : tmp_next_url
				});
		}

	} );
	
	// Parse number of sets found in view in an attempt to update the URL to match the set that comprises the majority of the window.
	if ( 0 == setsInView.length ) {
		self.debugInfinity( 'line 500 Sets in view: ' + setsInView.length);
		pageNum = -1;
		self.debugInfinity( 'pageNum: ' + pageNum);
	} else if ( 1 == setsInView.length ) {
		self.debugInfinity( 'line 504 Sets in view: ' + setsInView.length);
		var setData = setsInView.pop();

		// If the first set of IS posts is in the same view as the posts loaded in the template by WordPress, determine how much of the view is comprised of IS-loaded posts
		self.debugInfinity( '( ' + windowBottom + ' - ' + setData.top + ' ) / ' + windowSize + ' = ' + ( ( windowBottom - setData.top ) / windowSize ) );
		if ( ( ( windowBottom - setData.top ) / windowSize ) < pageChangeThreshold ) {
			pageNum = -1;
			self.debugInfinity( 'pageNum: ' + pageNum);
		}
		else {
			pageNum = setData.pageNum;
			self.debugInfinity( 'pageNum: ' + pageNum);
			post_url = setData.post_url;
			post_title = setData.post_title;
			post_cat = setData.post_cat; // new 
			post_cat_url = setData.post_cat_url;
			post_comment = setData.post_comment;
			next_title = setData.next_title;
			next_url = setData.next_url;
		}
	} else {
		self.debugInfinity( 'line 519 Sets in view: ' + setsInView.length);

		if ( jQuery( '.infinite-view-' + ( self.curPage + 1 ) ).length ) {
			var nextPageTop = jQuery( '.infinite-view-' + ( self.curPage + 1 ) ).offset().top;
			self.debugInfinity( '( ' + windowBottom + ' - ' + nextPageTop + ' ) / ' + windowSize + ' = ' + ( ( windowBottom - nextPageTop ) / windowSize ) );
			if ( ( ( windowBottom - nextPageTop ) / windowSize ) >= pageChangeThreshold ) {
				pageNum    = self.curPage + 1;
				post_url   = typeof self.the_post_url === 'undefined' || typeof  self.the_post_url[0] === 'undefined' ? '' : self.the_post_url[0];
				post_title = typeof self.the_post_title === 'undefined' || typeof self.the_post_url[0] === 'undefined' ? '' : self.the_post_title[0];
				post_cat = typeof self.the_cat === 'undefined' ? '' : self.the_cat[0];
				post_cat_url = typeof self.the_cat_url === 'undefined' ? '' : self.the_cat_url[0];
				post_comment = typeof self.the_comment === 'undefined' ? '': self.the_comment[0];
				next_title = typeof self.the_next_title === 'undefined' ? '' : self.the_next_title[0];
				next_url = typeof self.the_next_url === 'undefined' ? '' : self.the_next_url[0];

				self.debugInfinity( 'new page!' );
				self.debugInfinity( 'pageNum: ' + pageNum);
			}
		}
	}
	self.currentPageNum = ( pageNum ) == -1 ? 0 : pageNum;
	// If a page number could be determined, update the URL
	// -1 indicates that the original requested URL should be used.
	if ( 'number' == typeof pageNum ) {

		self.debugInfinity('current page: ' + self.curPage);
		// console.log( "current page: " +self.curPage );

		if( typeof self.title_first === 'undefined' ){
			// self.title_first = jQuery('.entry-title').text();
			self.title_first = jQuery('.df-sticky-title').text();
		}

		if( typeof self.cat_first === 'undefined' ){
			//self.cat_first = jQuery('ul.df-category li:first a').text();
			self.cat_first = jQuery('.df-sticky-category').text();
		}

		if( typeof self.cat_url_first === 'undefined' ){
			// self.cat_url_first = jQuery('ul.df-category li:first a').attr('href');
			// self.cat_url_first = jQuery('ul.df-category li:first a').attr('href');
			self.cat_url_first = jQuery('.df-sticky-category').attr('href');
		}
		if( typeof self.comment_first === 'undefined' ){
			// var commentContents = jQuery('.df-sticky-comment').contents();

			// self.comment_first = commentContents[commentContents.length - 1].nodeValue;
			self.comment_first = jQuery('.df-sticky-comment').contents().filter( function() {
				return this.nodeType == 3;
			}).text();
		}

		if( typeof self.next_title === 'undefined' ){
			self.next_title_first = jQuery('.df-sticky-next-title').text();
		}

		if( typeof self.next_url === 'undefined' ){
			self.next_url_first = jQuery('.df-sticky-next-title').attr('href');
		}

		if( typeof self.postID == 'undefined' ) {
			if ( pageNum != -1 )
				pageNum++;
				self.updateURL( pageNum );

		} else if( pageNum > self.curPage && window.location.href != post_url ) {

			self.curPage = pageNum;
			self.debugInfinity('self.curPage' + self.curPage);
			self.debugInfinity('pageNum' + pageNum);

			if ( post_url != '' ) {
				history.replaceState( null, null, post_url );
				self.the_urls[pageNum] = post_url;
				self.the_titles[pageNum] = post_title;
				self.the_cats[pageNum] = post_cat; // new
				self.the_cat_urls[pageNum] = post_cat_url;
				self.the_comments[pageNum] = post_comment;
				self.the_next_titles[pageNum] = next_title;
				self.the_next_urls[pageNum] = next_url;

				document.title = post_title;
			}
			
			jQuery('.df-sticky-title').text( self.the_post_title[0] );
			jQuery('.df-sticky-category').text( self.the_cat[0] );
			jQuery('.df-sticky-category').attr('href', self.the_cat_url[0] );
			
			var com1 = jQuery('.df-sticky-comment').contents();
			com1[com1.length - 1].nodeValue = self.the_comment[0];

			jQuery('.df-sticky-next-title').text( self.the_next_title[0] );
			jQuery('.df-sticky-next-title').attr('href', self.the_next_url[0] );
			self.updateStickyShare(self.the_urls[pageNum]);
			self.isFirstPageUpdated = false;
			// console.log( self.the_cat[0] );
			// console.log( self.the_cat_url[0] );
			// console.log( self.the_comment[0] );
			
			// Remove the URL, title from the array.
			if ( typeof self.the_post_url !== 'undefined' ) {
				self.the_post_url.shift();
			}

			if ( typeof self.the_post_title !== 'undefined' ) {
				self.the_post_title.shift();
			}

			if( typeof self.the_cat !== 'undefined' ){
				self.the_cat.shift();
			}

			if( typeof self.the_cat_url !== 'undefined' ){
				self.the_cat_url.shift();
			}

			if( typeof self.the_comment !== 'undefined' ){
				self.the_comment.shift();
			}

			if( typeof self.the_next_title !== 'undefined' ){
				self.the_next_title.shift();
			}
			if( typeof self.the_next_url !== 'undefined' ){
				self.the_next_url.shift();
			}


		} else if ( self.the_urls[pageNum] != window.location.href ) {
			
			if( pageNum == -1 ) {
				if(!self.isFirstPageUpdated){
					self.updateStickyShare(self.origURL);
					history.replaceState( null, null, self.origURL );
					if( self.origTitle != undefined ) {
						document.title = self.origTitle;
					}
					// console.log(post_url)
					jQuery('.df-sticky-title').text( self.title_first );
					jQuery('.df-sticky-category').text( self.cat_first );
					jQuery('.df-sticky-category').attr('href', self.cat_url_first );
					
					var com2 = jQuery('.df-sticky-comment').contents();
					com2[com2.length - 1].nodeValue = self.comment_first;

					jQuery('.df-sticky-next-title').text( self.next_title_first );
					jQuery('.df-sticky-next-title').attr('href', self.next_url_first );
					self.isFirstPageUpdated = true;
				}
				
			 } else {
				self.updateStickyShare(self.the_urls[pageNum]);
			 	history.replaceState( null, null, self.the_urls[pageNum] );
				
			 	if( self.the_titles[pageNum] != undefined ) {
				 	document.title = self.the_titles[pageNum];
				}
				
				jQuery('.df-sticky-title').text( self.the_titles[pageNum] );
				jQuery('.df-sticky-category').text( self.the_cats[pageNum] );
				jQuery('.df-sticky-category').attr('href', self.the_cat_urls[pageNum] );
				
				var com3 = jQuery('.df-sticky-comment').contents();
				com3[com3.length - 1].nodeValue = self.the_comments[pageNum];

				jQuery('.df-sticky-next-title').text( self.the_next_titles[pageNum] );
				jQuery('.df-sticky-next-title').attr('href', self.the_next_urls[pageNum] );
				self.isFirstPageUpdated = false;
			 }

		}
	}
	
}

Scroller.prototype.debugInfinity = function (message) {
	var self = window.infiniteScroll.scroller;

	if (self.debug) {
	}
}

/**
 * Update address bar to reflect archive page URL for a given page number.
 * Checks if URL is different to prevent pollution of browser history.
 */
Scroller.prototype.updateURL = function( page ) {
	var self = this,
		offset = self.offset > 0 ? self.offset - 1 : 0;
		pageSlug = -1 == page ? self.origURL : window.location.protocol + '//' + self.history.host + self.history.path.replace( /%d/, page + offset ) + self.history.parameters;

	if ( window.location.href != pageSlug ) {
		history.pushState( null, null, pageSlug );
	}
}
Scroller.prototype.updateStickyShare = function(url){
	this.email.attr('href','mailto:?Subject=I%20saw%20this%20and%20thought%20of%20you!%20&Body=I%20saw%20this%20and%20thought%20of%20you!%20' + url)
	this.fb.attr('href','https://www.facebook.com/sharer/sharer.php?u='+url);
	this.twitter.attr('href','https://twitter.com/intent/tweet?url='+url);
	this.linkedin.attr('href','http://www.linkedin.com/shareArticle?mini=true&url='+url);
	this.google.attr('href','https://plus.google.com/share?url='+url);
	this.pinterest.attr('href','https://id.pinterest.com/pin/create/button/?url='+url);
}

/**
 * Ready, set, go!
 */
$( document ).ready( function() {
	// Check for our variables
	if ( 'object' != typeof infiniteScroll )
		return;

	// Set ajaxurl (for brevity)
	ajaxurl = infiniteScroll.settings.ajaxurl;

	// Set stats, used for tracking stats
	stats = infiniteScroll.settings.stats;

	// Define what type of infinity we have, grab text for click-handle
	type  = infiniteScroll.settings.type;
	text  = infiniteScroll.settings.text;
	totop = infiniteScroll.settings.totop;

	// Initialize the scroller (with the ID of the element from the theme)
	infiniteScroll.scroller = new Scroller( infiniteScroll.settings );

	/**
	 * Monitor user scroll activity to update URL to correspond to archive page for current set of IS posts
	 * IE only supports pushState() in v10 and above, so don't bother if those conditions aren't met.
	 */
	if ( ! isIE || ( isIE && IEVersion >= 10 ) ) {
		$( window ).bind( 'scroll', function() {
			clearTimeout( timer );
			timer = setTimeout( infiniteScroll.scroller.determineURL , 50 );
		});
	}

});
})(jQuery);