$(document).ready(function() {
	$('form.search-small input.q').attr('autocomplete','off');
	$('table.results tr.row').bind('mouseenter', function() {
		$(this).addClass('active');
	}).bind('mouseleave', function() {
		$(this).removeClass('active');
	}).click(function(e) {
		if($(e.target).is('a')) {
			return;
		} else {
			$('table.results tr.row').removeClass('current');
			$(this).addClass('current');
			$(this).find('a.js-play:first').click();
		}
	});
	$.bindSuggestions();
	$.resizePlayer = function() {
		$('#player object').attr('width', ($(window).width()-$('div.player-bar ul').outerWidth()-2));
	};
	$.loadPlayer = function(song, ticket, fn) {
		url = encodeURI(song);
		$('#player').flash({
			swf: '/js/player/player.swf',
			wmode: 'transparent',
			height: 24,
			width: '100%',
			flashvars:{ height: 24,
						soundFile: url,
						autostart: 'yes',
						animation: 'no'} }).addClass('something');
		if(fn!=null) {
			fn();
		}
	};
	$('.js-play').click(function(e) {
		var song = $(this).attr('href').substr(1);
		var ticket = $(this).attr('rel');
		if(song!=null && ticket != null) {
			$.loadPlayer(song,ticket,function() {
				$.resizePlayer();
				$('.player-bar').show();
			});
		}
		e.preventDefault();
	});
	$(window).resize(function() {
		$.resizePlayer();
	});
});