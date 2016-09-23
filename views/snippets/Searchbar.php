<?= $this->form()->start('search', 'get', url('music', ['search']))->addAttribute('class', 'search-small js-search')?>
<div class="input">
	<?= $this->form()->input('query', 'text', $this->query)->addAttribute('class', 'q js-query')?>
	<?= $this->form()->input('cache', 'hidden', uniqid())?>
	<?= $this->form()->submit('submit', lang('Search.Search'))->addAttribute('class', 'bnt')?>
</div>
<?= $this->form()->end();?>