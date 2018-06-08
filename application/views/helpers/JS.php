<?php
class Zend_View_Helper_JS extends Zend_View_Helper_HtmlElement
{
	
	public function jS($jsFile)
	{	
		$tag = '<script src="' . $this->view->baseUrl('js/' . $jsFile) . '"></script>';
		return $tag;
	}
}