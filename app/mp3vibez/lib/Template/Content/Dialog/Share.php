<? /* @var $this \mp3vibez\Widget\Dialog\Share */ ?>
<div class="content">
	<p class="bold">
		<?= lang('For at dele dette lydklip med dine familie, venner og bekendte, skal du først vælge hvilken udbyder, du vil dele det via.')?>
		<?= lang('Her er et par af de mest populære:')?>
	</p>

	<p class="xmargin-top">
		<?= lang('Kan du ikke finde din foretrukne service i listen, kan du til enhver tid trykke på krydset, for at se flere udbydere.')?>
	</p>
	<div class="margin-top xpadding-top" style="text-align:center;">
		<div class="addthis_toolbox custom_images">
		<ul class="share">
			<li><a href="#" title="<?= lang('Del via Facebook'); ?>" class="addthis_button_facebook facebook"><span></span></a></li>
			<li><a href="#" title="<?= lang('Del via Twitter'); ?>" class="addthis_button_twitter twitter"><span></span></a></li>
			<li><a href="#" title="<?= lang('Del via Google'); ?>" class="addthis_button_google google"><span></span></a></li>
			<li><a href="#" title="<?= lang('Del via Gmail'); ?>" class="addthis_button_gmail gmail"><span></span></a></li>
			<li><a href="#" title="<?= lang('Del via Blogger'); ?>" class="addthis_button_blogger blogger"><span></span></a></li>
			<li><a href="#" title="<?= lang('Del via e-mail'); ?>" class="addthis_button_email email"><span></span></a></li>
			<li><a href="#" title="<?= lang('Del via Yahoo'); ?>" class="addthis_button_yahoo yahoo"><span></span></a></li>
			<li><a href="#" title="<?= lang('Find flere udbydere'); ?>" class="addthis_button_more more"><span></span></a></li>
		</ul>
		</div>
	</div>
	<p class="margin-top padding-top bold">
		<?= lang('Du kan også benytte det direkte link til denne sang')?>:
	</p>
	<div class="xmargin-top">
		http://<?= $_SERVER['HTTP_HOST'] ?>/#<?= url('song', '', array('song' => $this->song)); ?>
	</div>
	<script type="text/javascript">
		$(function() {
			$('ul.share a').attr('addthis:url', global.settings.SITE.SHARE_URL + '<?= $this->song?>');
			window.addthis.ost = 0;
			window.addthis.ready();
		});
	</script>
</div>
<div class="footer">
	<a href="javascript:dialog.close();" class="bnt right"><?= lang('Luk')?></a>
	<div class="breaker"></div>
</div>