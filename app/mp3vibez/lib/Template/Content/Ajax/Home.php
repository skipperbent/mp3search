<? /* @var $this mp3vibez\Widget\Ajax\Home */ ?>

<?= $this->form()->start('search', 'get', url('music', ['search']))->addAttribute('class', 'search-large js-search')?>
	<div class="logo margin-bottom padding-bottom">
		<a href="#" title="<?= lang('mp3vibez.com') ?>"><img src="/img/logo-white.jpg" alt="" class="margin-bottom" /></a>
	</div>
	<div class="input">
		<?= $this->form()->input('query', 'text')->addAttribute('class', 'q js-query')?>
		<?= $this->form()->submit('search', lang('Søg'))->addAttribute('class', 'bnt')?>
	</div>
	<div class="margin-top padding-top" style="text-align:center;color:#999;">
		<?= lang('Søger blandt flere millioner sange')?>.
		<div class="padding-top margin-top">
			<iframe class="margin-top" src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.mp3vibez.com&amp;layout=standard&amp;show_faces=false&amp;width=400&amp;action=like&amp;font=tahoma&amp;colorscheme=light&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:35px;" allowTransparency="true"></iframe>
		</div>
	</div>
<?= $this->form()->end();?>