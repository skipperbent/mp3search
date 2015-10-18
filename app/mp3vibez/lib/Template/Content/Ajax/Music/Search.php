<? /* @var $this \mp3vibez\Widget\Ajax\Music\Search */ ?>
<table class="results">
	<tr>
		<td class="col1 search-options">
			<? if($this->artists): ?>
			<h4><?= lang('Kunstnere')?></h4>
			<ul class="margin-bottom">
				<li<?= (!$this->artist) ? ' class="active"' : '' ?>><a href="#<?= url('music', 'search', array('search_query' => $this->query))?>"><?= lang('Alle')?></a></li>
				<? foreach($this->artists as $artist) : ?>
				<? if(strip_tags($artist)):?>
				<li<?= ($this->artist == $artist) ? ' class="active"' : '' ?>><a href="#<?= url('music', 'search', array('search_query' => $this->query, 'artist' => urlencode($artist)))?>"><?= ucwords($artist); ?></a></li>
				<? endif;?>
				<? endforeach; ?>
			</ul>
			<? endif; ?>
			<? /*<h4><?= lang('Kvalitet')?></h4>
			<ul class="margin-bottom">
				<li><b><?= lang('Alle')?></b></li>
				<li><?= lang('Lav')?></li>
				<li><?= lang('Mellem')?></li>
				<li><?= lang('Høj')?></li>
				<li><?= lang('Fremragende')?></li>
			</ul>
			<h4><?= lang('Længde')?></h4>
			<ul>
				<li><b><?= lang('Alle')?></b></li>
				<li>&gt; 1 min.</li>
				<li>&gt; 3 min.</li>
			</ul> */ ?>
		</td>
		<td class="col2">
			<?= $this->snippet('Searchbar.php')?>
			<? if($this->results):?>
			<div class="info-bar">
				<div class="left xmargin-top">
				</div>
				<!-- <div class="right xmargin-top"></div>  -->
				<div class="breaker"></div>
			</div>
			<? endif; ?>
			<div class="results-container">
				<? if(!$this->results): ?>
				<div class="xmargin-top padding">
					<h4><?= lang('Ingen resultater')?>.</h4>
					<p>
						<?= lang('Vi kunne desværre ikke finde det du ledte efter.')?>
					</p>
					<div class="xmargin-top" style="font-size:13px;font-weight:bold;">
						<?= lang('Prøv følgende')?>:
					</div>
					<ul class="list">
						<li><?= lang('Gør søgningen mindre præcis, for eksempel ved at undlade kunstner')?>.</li>
						<li><?= lang('Forsøg med alternative søgeord')?>.</li>
					</ul>
				</div>
				<? else: ?>
				<div class="wrapper xmargin-top">
					<table class="results" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th style="width:20px;"></th>
								<th><?= lang('Titel')?></th>
								<th style="text-align:center;width:50px;"><?= lang('Længde'); ?></th>
								<th style="text-align:center;width:50px;"><?= lang('Bitrate'); ?></th>
								<th style="text-align:center;"><?= lang('Størrelse')?></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<? /* @var $result mp3vibez\Service\mp3skull\mp3skullResult */
						foreach($this->results as $i=>$result) : ?>
							<tr class="row <?= ($i%2==0) ? 'odd' : 'even' ?>">
								<td style="padding:0px!important;text-align:center;">
									<a href="#<?= $result->url; ?>" class="js-play icon play" rel="<?= addslashes($result->title); ?>"></a>
								</td>
								<td>
									<?= ($result->title) ? $result->title : lang('Ingen titel'); ?>
								</td>
								<td align="center">
									<?= $result->length; ?>
								</td>
								<td align="center">
									<?= $result->bitrate; ?>
								</td>
								<td align="center">
									<?= $result->size; ?>
								</td>
								<td style="padding:0px;width:30px;text-align:center;">
									<div style="position:relative;height:16px;width:16px;">
										<a href="#" class="icon options js-options-menu"></a>
										<ul class="options-menu">
											<li><a href="javascript:void(0);" onclick="return player.playlist.add('<?= addslashes($result->title); ?>', '<?= $result->id; ?>', true);" class="js-playlist"><?= lang('Afspil efter nuværende')?></a></li>
											<li><a href="javascript:void(0);" onclick="return player.playlist.add('<?= addslashes($result->title); ?>', '<?= $result->id; ?>');" class="js-playlist"><?= lang('Tilføj til afspilningsliste')?></a></li>
											<li><a href="<?= $result->url;?>" target="_blank" rel="new"><?= lang('Hent')?></a></li>
											<li><a href="<?= url('dialog',['share'], array('song' => $result->url))?>" title="<?= lang('Del med dine venner')?>" rel="dialog"><?= lang('Del')?></a></li>
										</ul>
									</div>
								</td>
							</tr>
						<? endforeach;?>
						</tbody>
					</table>
				</div>

				<? endif;?>
			</div>
		</td>
	</tr>
</table>