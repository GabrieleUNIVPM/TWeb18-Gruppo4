<?php
class Zend_View_Helper_Price extends Zend_View_Helper_Abstract
{
	public function price($product)
	{
		$currency = new Zend_Currency();
		$formatted = '<h2>' . $currency->toCurrency($product->getPrice($product->sconto)) . '</h2>';
		if ($product->sconto!=0) {
			$formatted .= '<div class="sconto">Prezzo iniziale <del>'
			             . $currency->toCurrency($product->prezzo)
			             . '</del></div><br>Sconto ' . $product->sconto . '%';
		}
		return $formatted;
	}
}
