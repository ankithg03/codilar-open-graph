<?php

namespace Codilar\OpenGraph\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;

/**
 * Class CurrentProduct
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Provides Current Product Related Information which can be used In the Other Classes
 */

class CurrentProduct
{
    /**
     * @var ProductInterface
     */
    private $product;
    /**
     * @var ProductInterfaceFactory
     */
    private $productFactory;
    public function __construct(ProductInterfaceFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }
    public function set(ProductInterface $product)
    {
        $this->product = $product;
    }
    public function get()
    {
        return $this->product ? $this->product : $this->createNullProduct();
    }
    private function createNullProduct()
    {
        return $this->productFactory->create();
    }
}
