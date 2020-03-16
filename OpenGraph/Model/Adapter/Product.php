<?php
declare(strict_types=1);

namespace Codilar\OpenGraph\Model\Adapter;

use Codilar\CustomStockStatus\Helper\Data;
use Codilar\OpenGraph\Logger\Logger;
use Codilar\OpenGraph\Model\AdapterInterface;
use Codilar\OpenGraph\Model\Property;
use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

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
     * @var Data
     */
    private $dataHelper;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var Logger
     */
    private $logger;

    /**
     * Product constructor.
     * @param PropertyInterface $property
     * @param StoreManagerInterface $storeManager
     * @param Logger $logger
     * @param Data $dataHelper
     */
    public function __construct(
        PropertyInterface $property,
        StoreManagerInterface $storeManager,
        Logger $logger,
        Data $dataHelper
    ) {
        $this->property = $property;
        $this->dataHelper = $dataHelper;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
    }

    /**
     * @return PropertyInterface
     * @throws NoSuchEntityException
     */
    public function getProperty(): PropertyInterface
    {
        $product = $this->dataHelper->getCurrentProduct();
        $store = $this->storeManager->getStore();
        if ($product->getId()) {
            $this->property->addProperty('og:type', 'og:product', 'product');
            $this->property->setTitle((string)$product->getName());
            if ($product->getMetaDescription() != null) {
                $this->property->setDescription((string)$product->getMetaDescription());
            }
            try {
                if ($product->getData('thumbnail') != null) {
                    $this->property->setImage(
                        $store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) .
                        'catalog/product' .
                        (string)$product->getData('thumbnail')
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
