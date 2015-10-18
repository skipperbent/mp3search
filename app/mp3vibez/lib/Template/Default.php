<?php /* @var $this \mp3vibez\Widget\WidgetSite */ ?><?= \Pecee\UI\Site::GetInstance()->getDocType(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?= $this->printHeader(); ?>
		<script type="text/javascript">
			global.init(function() {
				var s = global.settings;
				s.SITE.SHARE_URL = 'http://<?= $_SERVER['HTTP_HOST'] ?>/#<?= url('song', null, array('song' => '')); ?>';
				s.TEXT.LOADING = '<?= lang('Arbejder, vent venligst...'); ?>';
				s.TEXT.DOWNLOAD = '<?= lang('Hent');?>';
				s.TEXT.SHARE = '<?= lang('Del'); ?>';
				s.TEXT.SHARE_TITLE = '<?= lang('Del med dine venner'); ?>';
				s.TEXT.PLAYLIST_SEARCH_NO_RESULTS = '<?= lang('Ingen resultater fundet.'); ?>';
				s.TEXT.PLAYLIST_NO_SONGS = '<?= lang('Du har endnu ikke tilføjet nogle sange til din afspilningsliste') ?>';
				s.TEXT.PLAY_ERROR = '<?= lang('Fejl: sangen kan ikke afspilles i øjeblikket.'); ?>';
				s.TEXT.OPTIONS_PLAY = '<?= lang('Afspil nu'); ?>';
				s.TEXT.OPTIONS_PLAY_AFTER = '<?= lang('Afspil efter nuværende'); ?>';
				s.TEXT.OPTIONS_PLAYLIST_ADD = '<?= lang('Tilføj til afspilningsliste'); ?>';
				s.TEXT.DIALOG_NOW_PLAYING = '<?= lang('Nu afspilles') ?>:';
				s.TEXT.DIALOG_PLAY_NEXT = '<?= lang('vil blive afspillet efter nuværende') ?>';
				s.TEXT.DIALOG_PLAYLIST_REMOVE = '<?= lang('er fjernet fra din afspilningsliste')?>';
				s.TEXT.DIALOG_PLAYLIST_ADD = '<?= lang('er tilføjet til din afspilningsliste')?>';
				s.TEXT.DIALOG_PLAYLIST_MULTIPLE_ADD = '<?= lang('sange er blevet tilføjet til din afspilningsliste'); ?>';
				s.TEXT.DIALOG_FLASH_PLAYER = '<?= lang('Flash ikke installeret eller opdatering påkrævet'); ?>';
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
			<?= lang('Sprog')?>:
			<?= $this->form()->selectStart('language', new mp3vibez\Dataset\DatasetLanguages(), \Pecee\Locale::getInstance()->getLocale());?>
		</div>
				<span class="copyright">
					&copy; <?= date('Y')?> <a href="http://www.pecee.dk" rel="new">Pecee</a>
				</span>
		<ul>
			<li><a href="<?= url('dialog', ['terms'])?>" title="<?= lang('Vilkår for anvendelse');?>" rel="dialog"><?= lang('Vilkår for anvendelse')?></a></li>
			<li><a href="<?= url('dialog', ['about'])?>" title="<?= lang('Om mp3vibez');?>" rel="dialog"><?= lang('Om')?></a></li>
			<li class="last"><a href="<?= url('dialog', ['contact'])?>" title="<?= lang('Kontakt');?>" rel="dialog"><?= lang('Kontakt')?></a></li>
		</ul>
		<div class="breaker"></div>
	</div>
	<div class="player-bar">
		<div style="position:relative;">
			<ul class="buttons">
				<li><a href="#" class="bnt js-playlist"><?= lang('Afspilningsliste')?></a></li>
			</ul>
			<div class="playlist">
				<div class="filter">
					<?= $this->form()->input('playlist-query', 'text', lang('Filtrer efter søgeord...'))->addAttribute('ID', 'song-query')?>
				</div>
				<div class="empty padding">
					<?= lang('Du har endnu ikke tilføjet nogle sange til din afspilningsliste.')?>
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