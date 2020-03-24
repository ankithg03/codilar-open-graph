<?php

namespace Codilar\OpenGraph\Observer;

use Codilar\OpenGraph\Model\CurrentProduct;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Event\Observer as Event;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class RegisterCurrentProductObserver
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Is a Observer
 */

class RegisterCurrentProductObserver implements ObserverInterface
{
    /**
     * @var CurrentProduct
     */
    private $currentProduct;
    public function __construct(CurrentProduct $currentProduct)
    {
        $this->currentProduct = $currentProduct;
    }
    public function execute(Event $event)
    {
        /** @var ProductInterface $product */
        $product = $event->getData('product');
        $this->currentProduct->set($product);
    }
}
