<?php
namespace mp3vibez\Widget;

abstract class Widget_Abstract extends \Pecee\Widget\Widget {
	public function __construct() {
		parent::__construct();

		// Default configuration
		$this->getSite()->setTitle('mp3vibez');
		$this->getSite()->addWrappedCss('style.css');
		$this->getSite()->addWrappedJs('global.js');
	}

	public function showFlash($formName = null) {
		$o=$this->showMessages($this->errorType, $formName);
		$o.=$this->showMessages('warning', $formName);
		$o.=$this->showMessages('info', $formName);
		$o.=$this->showMessages('success', $formName);
		return $o;
	}

	public function showMessages($type, $formName = null) {
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

	public function validationFor($index) {
		if(parent::validationFor($index)) {
			return '<span class="msg error">'.parent::validationFor($index).'</span>';
		}
		return '';
	}
}