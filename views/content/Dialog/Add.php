<? /* @var $this \mp3vibez\Widget\Dialog\Add */ ?>
<div class="content">
	<p>
		<?= lang('Vi indekserer hele tiden internettet for nyt musik, men vi kan naturligvis ikke garantere at alt
		kan findes på vores side. Derfor kan vi, med din hjælp, blive endnu bedre.')?><br/><br/>
		<span class="bold"><?= lang('Indtast URL-adressen til den mp3-fil du ønsker at tilføje og tryk på Gem:')?></span>
	</p>
	<?= $this->form()->start('addUrl')->addAttribute('class', 'margin-top')?>
	<?= $this->form()->input('url', 'text')?>
	<?= $this->form()->input('', 'button', lang('Tilføj flere'))?>
	<div class="margin-top">
		<?= $this->form()->submit('submit', lang('Gem'))?>
	</div>
	<?= $this->form()->end();?>
</div>