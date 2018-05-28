<?php
class Zend_View_Helper_Img extends Zend_View_Helper_HtmlElement
{
	
	public function img($imgFile)
	{
		if (empty($imgFile)) {
			$imgFile = 'default.jpg';
		}
		
		$tag = '<img src="' . $this->view->baseUrl('images/' . $imgFile) . '">';
		return $tag;
	}
}