<?php
	declare(strict_types=1);
	/**
	 * Trybugs Hello CustomPrice Observer
	 *
	 * @category    Trybugs
	 * @package     Trybugs_ProductCustomCost
	 * @author      Trybugs Software Private Limited
	 *
	 */
	namespace Trybugs\ProductCustomCost\Observer;
 
	use Magento\Framework\Event\ObserverInterface;
	use Magento\Framework\App\RequestInterface;
 
	class CustomPrice implements ObserverInterface
	{
		public function execute(\Magento\Framework\Event\Observer $observer) {
			
			$item = $observer->getEvent()->getData('quote_item');				
			$item = ( $item->getParentItem() ? $item->getParentItem() : $item );
			// $price = $optionValue; //set your price here
			$_product = $observer->getEvent()->getData('product');         
			$_attributeValue =$_product->getResource()->getAttribute('additional_cost')->getFrontend()->getValue($_product);
			
			$price = $_attributeValue; //set your price here
			$item->setCustomPrice($price);
			$item->setOriginalCustomPrice($price);
			$item->getProduct()->setIsSuperMode(true);
			return $this;
			
		}
 
	}