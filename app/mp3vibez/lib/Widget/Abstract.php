<?php
namespace mp3vibez\Widget;

abstract class Widget_Abstract extends \Pecee\Widget\Widget {
	public function __construct() {
		parent::__construct();

		// Default configuration
		$this->getSite()->setTitle('Test site');
		$this->getSite()->addWrappedCss('style.css');
		$this->getSite()->addWrappedJs('global.js');
	}

	public function showFlash($formName=NULL) {
		$o=$this->showMessages('error', $formName);
		$o.=$this->showMessages('warning', $formName);
		$o.=$this->showMessages('info', $formName);
		$o.=$this->showMessages('success', $formName);
		return $o;
	}

	public function showMessages($type, $formName = NULL) {
		if(is_null($formName) || is_null($this->getFormName()) || $formName == $this->getFormName()) {
			if($this->hasMessages($type)) {
				$iconMap=array('info' => '*', 'warning' => '!', 'error' => 'X', 'success' => '=');
				$o = sprintf('<div class="msg %s"><div class="txt">', $type);
				$msg=array();
				/* @var $error \Pecee\UI\Form\FormMessage */
				foreach($this->getMessages($type) as $error) {
					$msg[] = sprintf('%s', $error->getMessage());
				}

				$o .= join('<br/>', $msg) . '</div></div>';
				return $o;
			}
		}
		return '';
	}

	protected function validationFor($name) {
		if($this->form()->validationFor($name)) {
			return '<span class="msg error">'.$this->form()->validationFor($name).'</span>';
		}
		return '';
	}
}