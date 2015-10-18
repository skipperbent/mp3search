<?php
namespace mp3vibez\Widget;
use Pecee\Widget\Widget;

class WidgetSite extends Widget {

	const TICKET_NAME = 'SITE_TICKET';
	protected $ticket=-1;
	protected $globalMenu=null;
	protected $userMenu=null;

	public function __construct() {
		parent::__construct();

		$this->getSite()->addWrappedCss('style.css');
		$this->getSite()->addWrappedJs('jquery-1.6.2.min.js');
		$this->getSite()->addWrappedJs('global.js');
		$this->getSite()->setTitle('mp3vibez.com');

		$this->globalMenu = new \Pecee\UI\Menu\Menu();
		$this->globalMenu->addItem(lang('Søg'), '#'. url())->addClass('active');

		if(\Pecee\Cookie::Get('Locale') && in_array(strtolower(\Pecee\Cookie::Get('Locale')), Helper::$Locales)) {
			\Pecee\Locale::Instance()->setLocale(\Pecee\Cookie::Get('Locale'));
		}
	}
}