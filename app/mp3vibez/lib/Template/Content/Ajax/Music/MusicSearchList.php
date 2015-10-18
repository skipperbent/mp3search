<? /* @var $this Widget_Ajax_Music_Search_List */ ?>
<? if($this->results): ?>
	<table class="results xmargin-top">
		<? foreach($this->results->getItems() as $i=>$result) : ?>
		<tr class="row <?= ($i%2==0) ? 'odd' : 'even' ?>">
			<td style="width:16px;">
				<a href="#<?= $result->getID() ?>" rel="<?= $this->ticket; ?>" class="js-play icon play"></a>
			</td>
			<td style="border-right:1px solid #D8D8D8;">
				<?= ($result->getTitle()) ? utf8_encode($result->getTitle()) : lang('Ingen titel'); ?>
			</td>
			<td style="border-right:1px solid #D8D8D8;">
				<?= ($result->getArtist() && $result->getArtist()) ? $result->getArtist() : lang('Ukendt kunstner'); ?>
			</td>
			<td>
				<div style="position:relative;">
					<?= ($result->getAlbum()) ? utf8_encode($result->getAlbum()) : lang('Ukendt album');?>
					<a href="<?= url('music', 'download', array('song' => base64_encode($result)))?>" rel="new" class="icon download js-download" title="<?= lang('Gem denne sang på din computer');?>"></a>
				</div>
			</td>
		</tr>
		<? endforeach;?>
	</table>
	<? if($this->pageIndex > 0) : ?>
	<div class="js-preload"></div>
	<? endif; ?>
<? endif;?>