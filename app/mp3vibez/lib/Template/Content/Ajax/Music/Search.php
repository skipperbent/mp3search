<? /* @var $this \mp3vibez\Widget\Ajax\Music\Search */ ?>
<table class="results">
	<tr>
		<td>
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
					<h4><?= lang('Search/NoResults')?>.</h4>
					<p>
						<?= lang('Search/NoResultsDescription')?>
					</p>
					<div class="xmargin-top" style="font-size:13px;font-weight:bold;">
						<?= lang('Search/TryTheFollowing')?>
					</div>
					<ul class="list">
						<li><?= lang('Search/SearchTip1')?></li>
						<li><?= lang('Search/SearchTip2')?></li>
					</ul>
				</div>
				<? else: ?>
				<div class="wrapper xmargin-top">
					<table class="results" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th style="width:20px;"></th>
								<th><?= lang('Search/Title'); ?></th>
								<th style="text-align:center;width:50px;"><?= lang('Search/Duration'); ?></th>
								<th style="text-align:center;width:80px;"><?= lang('Search/Bitrate'); ?></th>
								<th style="text-align:center;width:50px;"><?= lang('Search/Size')?></th>
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
									<?= ($result->title) ? $result->title : lang('Search/NoTitle'); ?>
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
											<li><a href="javascript:void(0);" onclick="return player.playlist.add('<?= addslashes($result->title); ?>', '<?= $result->id; ?>', true);" class="js-playlist"><?= lang('Options/PlayAfter')?></a></li>
											<li><a href="javascript:void(0);" onclick="return player.playlist.add('<?= addslashes($result->title); ?>', '<?= $result->id; ?>');" class="js-playlist"><?= lang('Options/PlaylistAdd')?></a></li>
											<li><a href="<?= $result->url;?>" target="_blank" rel="new"><?= lang('Download')?></a></li>
											<li><a href="<?= url('dialog',['share'], array('song' => $result->url))?>" title="<?= lang('Share')?>" rel="dialog"><?= lang('Share')?></a></li>
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