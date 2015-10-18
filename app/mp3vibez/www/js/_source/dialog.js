var dialog = {
	dialogTypes: {
		AJAX: 'ajax',
		HTML: 'html',
		IFRAME: 'iframe'
	},
	settings: {
		FADEIN_TIMEOUT: 200,
		FADEOUT_TIMEOUT: 110,
		TYPE: null,
		HTML: '',
		URL: '',
		TITLE: null,
		TEXT: {
			CLOSE: ''
		}
	},
	init: function() {
		this.settings.TYPE = this.dialogTypes.AJAX;
		return this;
	},
	overlay: {
		close: function() {
			var o = $('body div.screenoverlay');
			o.fadeOut(dialog.settings.FADEOUT_TIMEOUT, function() {
				o.remove();
				$('html').css('overflow', 'auto');
			});
		},
		show: function(fn) {
			var o = $('body div.screenoverlay');
			if(o.length) {
				fn();
			} else {
				$('html').css('overflow', 'hidden');
				$('body').prepend('<div class="screenoverlay dialog-bg"></div>');
				$('body div.screenoverlay').fadeIn(dialog.settings.FADEIN_TIMEOUT, function() {
					fn();
				});
				$('body div.screenoverlay').css('height', $(document).height());
			}
		}
	},
	showByHtml: function(title, html) {
		this.settings.TITLE = title;
		this.settings.TYPE = this.dialogTypes.HTML;
		this.settings.HTML = html;
		this.show();
	},
	showByUrl: function(title, url) {
		this.settings.TITLE = title;
		this.settings.URL = url;
		this.settings.TYPE = this.dialogTypes.AJAX;
		this.show();
	},
	replace: function(title, url) {
		 $('.dialog').remove();
		 this.showByUrl(title, url);
	},
	show: function() {
		this.overlay.show(function() {
			$('body div.screenoverlay').prepend('<div class="dialog"><div class="container"></div></div>');
			var d = $('.dialog');
			if(dialog.settings.TITLE != null) {
				d.find('.container').append('<div class="header"><h3>'+dialog.settings.TITLE+'</h3> <div class="close"><a href="#">'+dialog.settings.TEXT.CLOSE+'</a></div></div>');
			}
			var c = dialog.getContent();
			d.find('.container').append('<div class="contents" id="dialog_content">'+c+'</div>');
			d.find('.contents a[rel="dialog"]').live('click', function(e) {
				dialog.replace($(this).attr('title'), $(this).attr('href'));
				e.preventDefault();
			});
			d.find('.container div.close a').bind('click', function(e) {
				dialog.close();
				e.preventDefault();
			});
			dialog.center();
			$(window).resize(function() {
				dialog.center();
			});
			d.fadeIn(dialog.settings.FADEIN_TIMEOUT);
		});
	},
	close: function() {
		this.overlay.close();
		$('.dialog').remove();
	},
	center: function() {
		global.utils.center('.dialog');
	},
	setUrl: function(url) {
		this.settings.URL = url;
	},
	getContent: function() {
		switch(this.settings.TYPE) {
			default:
			case this.dialogTypes.AJAX: {
				var o = '';
				$.ajax({url: this.getUrl(), 
					async:false,
					success: function(r) {
						o=r;
					}, error: function(r,t,e) {
						o=e;
					}
				});
				return o;
				break;
			}
			case this.dialogTypes.HTML:
				return this.settings.HTML;
				break;
			case this.dialogTypes.IFRAME: {
				return '<iframe src="'+this.getUrl()+'"></iframe>';
				break;
			}
		}
	},
	getUrl: function() {
		return this.settings.URL + global.utils.setDelimiter(this.settings.URL) + 'ticket=' + global.settings.SITE.TICKET;
	},
	setHTML: function(html) {
		this.settings.HTML = html;
	}
};