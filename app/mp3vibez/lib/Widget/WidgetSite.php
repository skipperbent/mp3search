<?php
namespace mp3vibez\Widget;
use mp3vibez\Helper;
use Pecee\Cookie;
use Pecee\Language;
use Pecee\Locale;
use Pecee\Widget\Widget;

class WidgetSite extends Widget {

	const TICKET_NAME = 'SITE_TICKET';
	protected $ticket=-1;
	protected $globalMenu=null;
	protected $userMenu=null;

	public function __construct() {

		if(Cookie::get('Locale') && in_array(strtolower(Cookie::get('Locale')), Helper::$Locales)) {
			Locale::getInstance()->setLocale(Cookie::get('Locale'));
		}

		parent::__construct();

		$this->getSite()->addWrappedCss('style.css');
		$this->getSite()->addWrappedJs('jquery-1.6.2.min.js');
		$this->getSite()->addWrappedJs('global.js');
		$this->getSite()->setTitle('mp3vibez.com');

		$this->globalMenu = new \Pecee\UI\Menu\Menu();
		$this->globalMenu->addItem(lang('Search/Search'), '#'. url())->addClass('active');
	}
}