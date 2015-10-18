var player = {
	container: null,
	init: function() {
		$('.js-player a.pause').css('display','block');
		this.container = $("#player").jPlayer({
			swfPath: '/js/player/',
			supplied: 'mp3',
			cssSelectorAncestor: '',
			solution: 'flash',
			cssSelector: {
				play : '.js-player a.play',
				pause : '.js-player a.pause',
				seekBar : '.js-player .seek',
				playBar : '.js-player .play-bar',
				/*mute : '.js-player-mute',
				unmute : '.js-player-unmute',*/
				volumeBar : '.js-player .volume',
				volumeBarValue : '.js-player .volume .value',
				currentTime : '.js-player .time',
				duration : '.js-player .duration'
			},
			ended: this.ended,
			error: this.error
		});
		this.resize();
	},
	settings: {
		SHUFFLE: false,
		REPEAT: false,
		REPEAT_ONE: false
	},
	current: {
		song: null,
		playlist: false,
		playlistIndex: null,
		playing: false
	},
	playlist: {
		songs: new Array(),
		hasNext: function() {
			var hasNext = false;
			if(player.current.playlistIndex != null) {
				hasNext = ($('.playlist ul.songs li:eq('+(player.current.playlistIndex+1)+')').length == 1);
			}
			return hasNext;
		},
		hasPrev: function() {
			var hasPrev = false;
			if(player.current.playlistIndex != null) {
				hasPrev = ($('.playlist ul.songs li:eq('+(player.current.playlistIndex-1)+')').length == 1);
			}
			return hasPrev;
		},
		setControls: function() {
			if(this.hasNext()) {
				$('.js-player .next-disabled').removeClass('next-disabled');
			} else {
				$('.js-player .next').addClass('next-disabled');
			}
			if(this.hasPrev()) {
				$('.js-player .prev-disabled').removeClass('prev-disabled');
			} else {
				$('.js-player .prev').addClass('prev-disabled');
			}
		},
		update: function() {
			this.setControls();
			$('.playlist ul.songs li').each(function(i) {
				$(this).find('a.js-remove').unbind();
				$(this).find('a.js-item').unbind();
				$(this).find('a.js-item').bind('click', function(e) {
					player.playlist.play(i);
					e.preventDefault();
				});
				$(this).find('a.js-remove').bind('click', function(e) {
					player.playlist.remove(i);
					e.preventDefault();
				});
			});
		},
		playSelected: function() {
			this.removeAll();
			this.addSelected();
			this.play(0);
			return false;
		},
		addSelected: function(next) {
			next = (next==null) ? false: next;
			var el = $('table.results tr.row.current').each(function() {
				var a = $(this).find('a.js-play:first');
				player.playlist.add(a.attr('rel'), global.utils.getSong(a.attr('href')), next, false);
			});
			global.gui.message.show(el.length +' '+  global.settings.TEXT.DIALOG_PLAYLIST_MULTIPLE_ADD, 5000);
			return false;
		},
		add: function(title, song, next, showDialog) {
			next = (next==null) ? false: next;
			showDialog = (showDialog==null) ? true : showDialog;
			this.songs.push({ Title: title, Song: song });
			$('.playlist .empty').remove();
			var s = $('.playlist ul.songs');
			var h = '<li><a href="#'+song+'" class="item js-item">' +title+ '</a><a href="#" class="icon remove js-remove">Fjern</a></li>';
			/* If the song should be played next */
			var c = s.find('li.current');
			if(next) {
				player.current.playlistIndex=(player.current.playlistIndex==null) ? -1 : player.current.playlistIndex;
				player.current.playlist=true;
				if(c.length > 0) {
					c.after(h).show();
				} else {
					s.prepend(h).show();
				}
				if(showDialog) {
					global.gui.message.show(title+' '+global.settings.TEXT.DIALOG_PLAY_NEXT, 5000);
				}
			} else {
				s.append(h).show();
				if(showDialog) {
					global.gui.message.show(title+' '+global.settings.TEXT.DIALOG_PLAYLIST_ADD, 5000);
				}
			}
			player.playlist.update();
		},
		removeAll: function() {
			$('.playlist ul.songs li').remove();
			$('.playlist').append('<div class="empty padding">'+global.settings.TEXT.PLAYLIST_NO_SONGS+'</div>');
			$('.playlist ul.songs').hide();
		},
		remove: function(index, showDialog) {
			showDialog = (showDialog==null) ? true : showDialog;
			if(index == player.current.playlistIndex) {
				player.current.playlistIndex = player.current.playlistIndex-1;
			}
			var e = $('.playlist ul.songs');
			var c = e.find('li:eq('+index+')');
			if(this.songs.length > 0) {
				var newSongs=new Array();
				for(var i=0;i<this.songs.length;i++) {
					var song = global.utils.getSong(c.find('a').attr('href'));
					if(this.songs[i].Song != song) {
						newSongs.push(this.songs[i]);
					}
				}
				this.songs = newSongs;
			}
			if(c.length > 0 && showDialog) {
				global.gui.message.show(c.find('a.item').html()+' '+global.settings.TEXT.DIALOG_PLAYLIST_REMOVE, 5000);
			}
			c.remove();
			if( e.find('li').length == 0 ) {
				$('.playlist').append('<div class="empty padding">'+global.settings.TEXT.PLAYLIST_NO_SONGS+'</div>');
				$('.playlist ul.songs').hide();
			}
			this.setControls();
			player.playlist.update();
		},
		play: function(index) {
			var e = $('.playlist ul.songs');
			e = e.find('li:eq('+index+') a.js-item');
			if(e.length > 0) {
				/* Set styles */
				$('.playlist ul.songs li').removeClass('current');
				e.parent('li').addClass('current');
				var song = global.utils.getSong(e.attr('href'));
				player.current.playlistIndex=index;
				player.play(song, true, e.html());
				this.setControls();
			}
		},
		next: function() {
			if(player.current.playlistIndex != null) {
				var e = $('.playlist ul.songs li:eq('+(player.current.playlistIndex+1)+') a.js-item');
				if(e.length > 0) {
					player.current.playlistIndex=player.current.playlistIndex+1;
					this.play(player.current.playlistIndex);
				} else {
					player.current.playlist=false;
					player.ended();
				}
			}
		},
		previous: function() {
			if(player.current.playlistIndex > -1) {
				var e = $('.playlist ul.songs li:eq('+(player.current.playlistIndex-1)+') a.js-item');
				if(e.length > 0) {
					player.current.playlistIndex=player.current.playlistIndex-1;
					this.play(player.current.playlistIndex);
				}
			}
		}
	},
	ended: function() {
		player.current.playing=false;
		if(player.settings.REPEAT_ONE) {
			player.play(player.current.song, player.current.playlist);
		} else {
			if(player.current.playlist) {
				player.playlist.next();
			}
		}
	},
	play: function(song,playlist,title) {
		playlist=(playlist==null)?false:playlist;
		$('.js-player .loader').addClass('loading');
		$('.js-player a.play-disabled').removeClass('play-disabled');
		this.container.jPlayer('setMedia', { mp3: global.settings.SITE.STREAM_HOST+'/music/stream/?song='+song+'&ticket='+global.settings.SITE.TICKET }).jPlayer('play');
		this.current.song=song;
		this.current.playlist=playlist;
		this.current.playing=true;
		$('.player-bar ul.buttons li#download').remove();
		$('.player-bar ul.buttons').append('<li id="download"><a href="'+global.settings.SITE.STREAM_HOST+'/music/download/?song='+song+'&ticket='+global.settings.SITE.TICKET+'" onclick="window.open(this.href);return false;" class="bnt">'+global.settings.TEXT.DOWNLOAD+'</a></li>');
		this.resize();
		if(title!=null) {
			global.gui.message.show(global.settings.TEXT.DIALOG_NOW_PLAYING+' '+title, 5000);
		}
		if(!playlist) {
			$('.playlist ul.songs li').removeClass('current');
			this.current.playlistIndex=null;
			this.playlist.setControls();
		}
	},
	stop: function() {
		player.container.jPlayer('stop');
		$('.js-player .loader').removeClass('loading');
		$('.js-player .pause').hide();
		$('.js-player .play').addClass('play-disabled').show();
	},
	error: function(e) {
		player.stop();
		switch(e.jPlayer.error.type) {
			default:
			case $.jPlayer.error.URL: {
				global.gui.message.show(global.settings.TEXT.PLAY_ERROR, 4000);
				setTimeout(function() {
					if(player.current.playlist) {
						player.playlist.next();
					}
				}, 4500);
				break;
			}
			case $.jPlayer.error.FLASH: {
				dialog.showByUrl(global.settings.TEXT.DIALOG_FLASH_PLAYER, '/dialog/flash');
				break;
			}
		}
	},
	resize: function() {
		$('.js-player').css('width', ($(window).width()-$('div.player-bar ul.buttons').outerWidth()-2));
	}
};