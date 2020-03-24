<?php

namespace Codilar\OpenGraph\Model\Adapter;

use Codilar\OpenGraph\Block\OpenGraph;
use Codilar\OpenGraph\Logger\Logger;
use Codilar\OpenGraph\Model\AdapterInterface;
use Codilar\OpenGraph\Model\CommonFactors;
use Codilar\OpenGraph\Model\ProductInformation;
use Codilar\OpenGraph\Model\Property;
use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Catalog\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Product
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Provides Product Information to Og Tags
 */

class Product implements AdapterInterface
{
    /**
     * @var array
     */
    private $messageAttributes = [
        'meta_description',
        'short_description',
        'description'
    ];
    /**
     * @var PropertyInterface
     */
    private $property;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var Session
     */
    private $catalogSession;
    /**
     * @var ProductInformation
     */
    private $productInformation;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var CommonFactors
     */
    private $commonFactors;

    /**
     * Product constructor.
     * @param PropertyInterface $property
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     * @param CommonFactors $commonFactors
     * @param Logger $logger
     * @param ProductInformation $productInformation
     */
    public function __construct(
        PropertyInterface $property,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        CommonFactors $commonFactors,
        Logger $logger,
        ProductInformation $productInformation
    ) {
        $this->property = $property;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->productInformation = $productInformation;
        $this->scopeConfig = $scopeConfig;
        $this->commonFactors = $commonFactors;
    }

    /**
     * @return PropertyInterface
     * @throws NoSuchEntityException
     */
    public function getProperty()
    {
        $product = $this->productInformation->getCurrentProduct();
        $store = $this->storeManager->getStore();
        if ($product->getId()!=null) {
            $this->property->addProperty('og:type', 'og:product', 'product');
            $isMetaData = $this->scopeConfig
                ->getValue(OpenGraph::XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE . 'meta_information');
            $metaTitle = $product->getMetaTitle();
            $metaDescription = $product->getMetaDescription();
            $Description = $product->getDescription();
            if ($isMetaData) {
                if (isset($metaTitle)) {
                    $this->property->setTitle((string)$metaTitle);
                } else {
                    $this->property->setTitle((string)$product->getName());
                }
                if (isset($metaDescription)) {
                    $this->property->setTitle((string)$metaDescription);
                } elseif (isset($Description)) {
                    $this->property->setTitle((string)$Description);
                }
            } else {
                $this->property->setTitle((string)$product->getName());
                if (isset($Description)) {
                    $this->property->setDescription((string)$Description);
                }
            }
            try {
                if ($product->getData('thumbnail') != null) {
                    $this->property->setImage(
                        $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) .
                        'catalog/product' .
                        (string)$product->getData('thumbnail')
                    );
                } else {
                    $this->property->setImage(
                        (string)$this->commonFactors->getPlaceholder()
                    );
                }
            } catch (\Exception $exception) {
                $this->logger->info($exception->getMessage());
            }
            $this->property->setUrl($product->getProductUrl());
            if ($product->getFormatedPrice() != null) {
                $this->property->addProperty('og:price', (string)$product->getFormatedPrice(), 'product');
            }
            $this->property->addProperty('item', $product->getData(), Property::META_DATA_GROUP);
        }
        return $this->property;
    }
}
