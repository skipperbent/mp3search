<?php /* @var $this \mp3vibez\Widget\WidgetSite */ ?><?= \Pecee\UI\Site::GetInstance()->getDocType(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?= $this->printHeader(); ?>
		<script type="text/javascript">
			global.init(function() {
				var s = global.settings;
				s.SITE.SHARE_URL = 'http://<?= $_SERVER['HTTP_HOST'] ?>/#<?= url('song', null, array('song' => '')); ?>';
				s.TEXT.LOADING = '<?= lang('WorkingPleaseWait'); ?>';
				s.TEXT.DOWNLOAD = '<?= lang('Download');?>';
				s.TEXT.SHARE = '<?= lang('Share'); ?>';
				s.TEXT.SHARE_TITLE = '<?= lang('ShareWithFriends'); ?>';
				s.TEXT.PLAYLIST_SEARCH_NO_RESULTS = '<?= lang('Playlist/NoResultsFound'); ?>';
				s.TEXT.PLAYLIST_NO_SONGS = '<?= lang('Playlist/NoSongs') ?>';
				s.TEXT.PLAY_ERROR = '<?= lang('Play/Error'); ?>';
				s.TEXT.OPTIONS_PLAY = '<?= lang('Options/Play'); ?>';
				s.TEXT.OPTIONS_PLAY_AFTER = '<?= lang('Options/PlayAfter'); ?>';
				s.TEXT.OPTIONS_PLAYLIST_ADD = '<?= lang('Options/PlaylistAdd'); ?>';
				s.TEXT.DIALOG_NOW_PLAYING = '<?= lang('Dialog/NowPlaying') ?>:';
				s.TEXT.DIALOG_PLAY_NEXT = '<?= lang('Dialog/PlayNext') ?>';
				s.TEXT.DIALOG_PLAYLIST_REMOVE = '<?= lang('Dialog/PlaylistRemove')?>';
				s.TEXT.DIALOG_PLAYLIST_ADD = '<?= lang('Dialog/PlaylistAdd')?>';
				s.TEXT.DIALOG_PLAYLIST_MULTIPLE_ADD = '<?= lang('Dialog/PlaylistMultipleAdd'); ?>';
				s.TEXT.DIALOG_FLASH_PLAYER = '<?= lang('Dialog/FlashRequired'); ?>';
			});
		</script>
	</head>
	<body>
	<div id="header">
		<div class="content-container columns50x2">
			<div class="col1">
				<?= $this->globalMenu;?>
			</div>
			<div class="col2">
				<?= $this->userMenu; ?>
			</div>
			<div class="breaker"></div>
		</div>
	</div>
	<div class="content-container">
		<?= $this->getContentHtml(); ?>
	</div>
	<div id="footer" class="content-container padding">
		<div class="languages">
			<?= lang('Language')?>:
			<?= $this->form()->selectStart('language', new mp3vibez\Dataset\DatasetLanguages(), \Pecee\Locale::getInstance()->getLocale());?>
		</div>
				<span class="copyright">
					&copy; <?= date('Y')?> <a href="http://www.pecee.dk" rel="new">Pecee</a>
				</span>
		<ul>
			<li><a href="<?= url('dialog', ['terms'])?>" title="<?= lang('TermsForUsage');?>" rel="dialog"><?= lang('TermsForUsage')?></a></li>
			<li class="last"><a href="<?= url('dialog', ['contact'])?>" title="<?= lang('Contact/Contact');?>" rel="dialog"><?= lang('Contact/Contact')?></a></li>
		</ul>
		<div class="breaker"></div>
	</div>
	<div class="player-bar">
		<div style="position:relative;">
			<ul class="buttons">
				<li><a href="#" class="bnt js-playlist"><?= lang('Playlist/Playlist')?></a></li>
			</ul>
			<div class="playlist">
				<div class="filter">
					<?= $this->form()->input('playlist-query', 'text', lang('Playlist/Filter'))->addAttribute('ID', 'song-query')?>
				</div>
				<div class="empty padding">
					<?= lang('Playlist/NoSongs')?>
				</div>
				<ul class="songs" id="songs"></ul>
			</div>
			<div id="player"></div>
			<table class="js-player">
				<tr>
					<td style="width:80px;" align="center">
						<ul class="controls">
							<li><a href="#" class="prev prev-disabled"></a></li>
							<li><a href="#" class="play play-disabled"></a></li>
							<li><a href="#" class="pause"></a></li>
							<li><a href="#" class="next next-disabled"></a></li>
						</ul>
					</td>
					<td valign="top">
						<div class="loader">
							<div class="overlay">
								<span class="time"></span>/<span class="duration"></span>
							</div>
							<div class="seek"></div>
							<div class="play-bar">&nbsp;</div>
						</div>
					</td>
					<td style="width:100px;" valign="top">
						<div class="volume">
							<div class="value"></div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4dab55cc10c12cbe"></script>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-22846931-1']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	</body>
</html>