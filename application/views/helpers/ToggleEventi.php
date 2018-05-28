<?php
class Zend_View_Helper_ToggleEventi extends Zend_View_Helper_HtmlElement
{
	
	public function toggleEventi($jsFile)
	{	
		$tag = '<script src="' . $this->view->baseUrl('js/' . $jsFile) . '"></script>';
		return $tag;
	}
}