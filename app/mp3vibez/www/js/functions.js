$(function() {

	var ajaxResponse = null;
	var timer = null;

	var firstRun=false;
	var filterDefaultValue=null;
	var AJAX_URL='/ajax';
	var CONTENT_CONTAINER = '#callback-container';
	player.init();
	var t = global.settings.TEXT;
	var bindDialogLinks = function(el) {
		el = (el==null)?'':el;
		$(el+' a[rel="dialog"]').click(function(e) {
			dialog.showByUrl($(this).attr('title'), $(this).attr('href'));
			e.preventDefault();
		});
	};
	bindDialogLinks();
	$('#header .col1 ul:first li a').click(function() {
		$('#header .col1 ul:first li').removeClass('active');
		$(this).parent('li').addClass('active');
	});
	$('a[rel="new"]').click(function(e) {
		window.open($(this).attr('href'));
		e.preventDefault();
	});
	$('select[name="language"]').bind('change', function() {
		top.location.href='/language/'+$(this).val()+'/?path='+global.utils.getPath();
	});
	$('a.js-playlist').click(function(e) {
		if($(this).hasClass('active')) {
			$('.playlist').hide();
			$(this).removeClass('active');
		} else {
			$(this).addClass('active');
			$('.playlist').show();
			$('ul.songs').scrollTop($('ul.songs').outerHeight());
			$('.player-bar #song-query').focus();
		}
		player.resize();
		e.preventDefault();
	});
	$('.filter input').focus(function() {
		if(filterDefaultValue == null || filterDefaultValue==$(this).val()) {
			filterDefaultValue = $(this).val();
			$(this).val('');
			$(this).addClass('active');
		}
	}).blur(function() {
		if(filterDefaultValue !=null && $(this).val()=='') {
			$(this).val(filterDefaultValue);
			$(this).removeClass('active');
		}
	});
	/* Playlist search */
	$('.player-bar #song-query').bind('keyup', function(e) {
		var val=$(this).val();
		var s = $('.playlist ul.songs');
		$('.playlist #song-results').remove();
		if(player.playlist.songs.length > 0 && val.length > 0) {
			s.hide();
			var results=new Array();
			for(var i=0;i<player.playlist.songs.length;i++) {
				if(player.playlist.songs[i].Title.toLowerCase().indexOf(val.toLowerCase()) > -1) {
					results.push( player.playlist.songs[i] );
				}
			}
			if(results.length>0) {
				var o='<ul class="songs" id="song-results" style="display:block;">';
				for(var i=0;i<results.length;i++) {
					o+='<li><a href="#'+results[i].Song+'" class="item js-item">'+results[i].Title+'</a></li>';
				}
				o+='</ul>';
			} else {
				var o='<div id="song-results" class="padding"><span>'+t.PLAYLIST_SEARCH_NO_RESULTS+'</span></div>';
			}
			$('.playlist').append(o);
			$('.playlist ul#song-results li a').bind('click', function(e) {
				var href = $(this).attr('href');
				var el = $('.playlist ul.songs#songs a[href="'+href+'"]');
				if(el.length > 0) {
					el.click();
				}
				e.preventDefault();
			});
		} else {
			s.show();
		}
	});

	var bindSuggestions = function() {
		$('input.js-query').bind('blur', function() {
			$('ul.suggestions').slideUp(100, function() {
				$(this).remove();
			});
		});

		$('input.js-query').bind('keyup', function(e) {
			var c = (e.keyCode ? e.keyCode : e.which);
			if(c!=38 && c!=40 && c!=13) {
				var search = $(this).val();
				if($(this).val().length == 0) {
					$('ul.suggestions').slideUp(100, function() {
						$(this).remove();
					});
					firstRun=true;
				}

				if(ajaxResponse != null) {
					ajaxResponse.abort();
					ajaxResponse = null;
				}

				clearTimeout(timer);

				var query = $(this).val();

				timer = setTimeout(function() {
					ajaxResponse = $.getJSON('/json/search/?query=' + query, function(d) {
						$('ul.suggestions').remove();
						if(d!=null) {
							if(d.Titles!=null && d.Titles.length > 0) {
								if(d.Titles.length > 0) {
									var o = '';
									for(var i=0;i<d.Titles.length;i++) {
										if(d.Titles[i] != null) {
											o+='<li><a href="#" rel="'+d.OriginalTitles[i]+'">'+ d.Titles[i].replace(new RegExp("("+d.query+")", "gi"),'<span class="highlight">$1</span>')+'</a></li>';
										}
									}
									$('.input').append('<ul class="suggestions" style="display:none;">'+o+'</ul>');
									if(firstRun) {
										$('ul.suggestions').slideDown(100);
										firstRun=false;
									} else {
										$('ul.suggestions').show();
									}
									$('ul.suggestions li a').click(function(e) {
										$('input.js-query').val($(this).attr('rel'));
										$('form[name="search"]').submit();
										firstRun=false;
										e.preventDefault();
									});
								}
							}
						}
					});
				}, 1000);
			}
		});
	};

	var keyNav = function() {
		$(document).bind('keyup', function(e) {
			var ignoreTags = new Array('input', 'select', 'option', 'textarea');
			var c = (e.keyCode ? e.keyCode : e.which);
			if(typeof(e.target.tagName) != 'undefined' && !$.inArray(e.target.tagName.toLowerCase(), ignoreTags)){
				if(e.target.name == 'search_query') {
					var el = $('ul.suggestions');
					if(c==40||c==38) {
						var f = el.find('li.active');
						f = (f.length==0) ? el.find('li:first') : ((c==40)) ? f.next('li') : f.prev('li');
						if(f!=null && f.length > 0) {
							$('ul.suggestions li').removeClass('active');
							f.addClass('active');
						}
						e.preventDefault();
					}
					if(c==13) {
						var f = el.find('li.active a');
						if(f.length > 0) {
							f.click();
							e.preventDefault();
						}
					}
				}
				return;
			}
			var el = $('table.results');
			/* Up/down */
			if(c==40||c==38) {
				var f = el.find('tbody tr.current');
				f = (f.length==0 || f.length > 1) ? el.find('tbody tr.row:first') : ((c==40)) ? f.next('tr.row') : f.prev('tr.row');
				if(f!=null && f.length > 0) {
					$('table.results tbody tr.row').removeClass('current');
					f.addClass('current');
				}
				e.preventDefault();
			}
			/* Return */
			if(c==13) {
				var r = $('table.results tbody tr.row.current');
				if(r.length == 1) {
					r.click();
					e.preventDefault();
				}
			}
		});
	};
	keyNav();
	var bindPage = function() {

		if(ajaxResponse != null) {
			ajaxResponse.abort();
			ajaxResponse = null;
		}

		clearTimeout(timer);
		timer = null;

		var q = $('input.js-query');
		q.attr('autocomplete','off');
		q.focus();
		/* Remove stuff if we click away */
		$(document).click(function() {
			$('#context-menu').remove();
			$('ul.suggestions').slideUp(100, function() {
				$(this).remove();
			});
		});
		$('table.results tbody tr.row').bind('mouseenter', function(e) {
			$('table.results tbody tr.row').removeClass('active');
			$(this).addClass('active');
			/* Custom context-menu */
			$(document).unbind('contextmenu');
			$(document).bind('contextmenu', function(e) {
				$('ul#context-menu').remove();
				$('body').append('<ul id="context-menu" class="options-menu"></ul>');
				c = $('ul#context-menu');
				var r = $('table.results tbody tr.row.current');
				c.append((r.length == 1) ? r.find('ul.options-menu').html() : '<li><a href="#" onclick="return player.playlist.playSelected();">'+t.OPTIONS_PLAY+'</a></li><li><a href="#" onclick="return player.playlist.addSelected(true);">'+t.OPTIONS_PLAY_AFTER+'</a></li><li><a href="#" onclick="return player.playlist.addSelected();">'+t.OPTIONS_PLAYLIST_ADD+'</a></li>').css('top', e.pageY + 5 + 'px').css('left', e.pageX).show();
				bindDialogLinks('ul#context-menu');
				e.preventDefault();
	        });
		}).bind('mouseleave', function() {
			$(this).removeClass('active');
			$(document).unbind('contextmenu');
		}).bind('mousedown', function(e) {
			/* If right mouse is clicked */
			if(e.which == 3 && !$(this).hasClass('current')) {
				$('table.results tr.row').removeClass('current');
				$(this).addClass('current');
			}
		}).click(function(e) {
			if($(e.target).is('a')) {
				return;
			} else if(e.metaKey) {
				if($(this).hasClass('current')) {
					$(this).removeClass('current');
				} else {
					$(this).addClass('current');
				}
			} else {
				$('table.results tr.row').removeClass('current');
				$(this).addClass('current');
				$(this).find('a.js-play:first').click();
				e.preventDefault();
			}
		});
		$(document).unbind('contextmenu');
		$('#callback-container a[rel="new"]').click(function(e) {
			window.open($(this).attr('href'));
			e.preventDefault();
		});
		bindDialogLinks('#callback-container');
		/* Button click effect */
		$('input.bnt').bind('mousedown', function() {
			$(this).addClass('active');
		}).bind('mouseup', function() {
			$(this).removeClass('active');
		});
		/* Search forms */
		$('form.js-search').submit(function() {
			if(ajaxResponse != null) {
				ajaxResponse.abort();
				ajaxResponse = null;
			}

			clearTimeout(timer);
			timer = null;

			top.location.href='#/'+$(this).attr('action')+'?'+$(this).serialize();
			return false;
		});
		/* Options menu */
		var options = null;
		var optionsHideTimeout = 70;
		var optionsShowTimeout = 120;
		$('a.js-options-menu').bind('click', function(e) {
			$('ul.options-menu').hide(optionsHideTimeout);
			var o = $(this).parent('div').find('ul.options-menu');
			if(o.is(':visible')) {
				o.hide(optionsHideTimeout);
				$(this).removeClass('active');
			} else {
				o.stop().show(120);
				$(this).addClass('active');
			}
			e.preventDefault();
		});
		$('ul.options-menu li a').bind('click', function() {
			clearTimeout(options);
			$('a.js-options-menu').removeClass('active');
			$('ul.options-menu').hide(optionsHideTimeout);
		});
		/* Ensure nothing happens when the element is clicked */
		$('ul.options-menu').bind('click', function() {
			return false;
		}).bind('mouseenter', function() {
			clearTimeout(options);
		}).bind('mouseleave', function() {
			var el = $(this);
			options = setTimeout(function() {
				$('a.js-options-menu').removeClass('active');
				el.hide(optionsHideTimeout);
			},800);
		});
		/* Options menu end */
		$('.js-play').click(function(e) {
			var song = global.utils.getSong($(this).attr('href'));
			if(song!=null) {
				player.play(song,false,$(this).attr('rel'));
			}
			e.preventDefault();
		});
	};
	/* Player stuff */
	$('.js-player .prev').bind('click', function(e) {
		player.playlist.previous();
		e.preventDefault();
	});
	$('.js-player .next').bind('click', function(e) {
		player.playlist.next();
		e.preventDefault();
	});
	$(window).hashchange(function() {
		var path = global.utils.getPath('');
		path = (path==''||path=='/') ? '/home' : path;
		var h = $('#header');
		if(!h.find('div.loader').length) {
			h.prepend('<div class="loader">'+t.LOADING+'</div>');
			global.utils.center('#header div.loader');
		}
		$.ajax({ url: AJAX_URL+path+global.utils.setDelimiter(path)+'ticket='+global.settings.SITE.TICKET, success: function(d) {
			$(CONTENT_CONTAINER).html(d);
			bindPage();
			h.find('div.loader').remove();
			player.resize();
			bindSuggestions();
		} });
	});
	$(window).resize(function() {
		player.resize();
		global.utils.center('#header div.loader');
	});
	$(window).hashchange();
});