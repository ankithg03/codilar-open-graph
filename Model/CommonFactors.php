<?php

namespace Codilar\OpenGraph\Model;

use Magento\Catalog\Helper\ImageFactory;
use Magento\CatalogGraphQl\Model\Resolver\Products\DataProvider\Image\Placeholder;
use Magento\Store\Model\StoreManager;

/**
 * Class CommonFactors
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Provides Common Functionality to the Other Class
 */

class CommonFactors
{
    /**
     * @var StoreManager
     */
    private $storeManager;
    /**
     * @var ImageFactory
     */
    private $helperImageFactory;
    /**
     * @var Placeholder
     */
    private $placeholder;

    /**
     * CommonFactors constructor.
     * @param StoreManager $storeManager
     * @param Placeholder $placeholder
     */
    public function __construct(
        StoreManager $storeManager,
        Placeholder $placeholder
    ) {
        $this->storeManager = $storeManager;
        $this->placeholder = $placeholder;
    }

    /**
     * @return mixed
     */
    public function getPlaceholder()
    {
        return $this->placeholder->getPlaceholder('image');
    }
}
