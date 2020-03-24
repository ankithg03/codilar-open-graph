<?php

namespace Codilar\OpenGraph\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ProductInformation
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Provides Product Related Information which can be used In the Other Classes
 */

class ProductInformation extends AbstractHelper
{
    const XML_PATH_ENABLED = 'custom_product_badge/general/is_enabled';
    const XML_PATH_DISPLAY = 'custom_product_badge/general/display';
    const XML_PATH_DISPLAYON = 'custom_product_badge/general/displayon';

    protected $_storeManager;

    protected $_productAttributeRepository;

    /**
     * @var currentProduct
     */
    private $currentProduct;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        Context $context,
        \Magento\Catalog\Model\Product\Attribute\Repository $productAttributeRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CurrentProduct $currentProduct,
        ProductRepositoryInterface $productRepository
    ) {
        $this->_productAttributeRepository = $productAttributeRepository;
        $this->_storeManager = $storeManager;
        $this->currentProduct = $currentProduct;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    /**
     * Get store identifier
     *
     * @return  int
     * @throws NoSuchEntityException
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    /**
     * Get website identifier
     *
     * @return string|int|null
     * @throws NoSuchEntityException
     */
    public function getWebsiteId()
    {
        return $this->_storeManager->getStore()->getWebsiteId();
    }

    /**
     * Get Store code
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }

    /**
     * Get Store name
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getStoreName()
    {
        return $this->_storeManager->getStore()->getName();
    }

    /**
     * Get current url for store
     *
     * @param bool|string $fromStore Include/Exclude from_store parameter from URL
     * @return string
     * @throws NoSuchEntityException
     */
    public function getStoreUrl($fromStore = true)
    {
        return $this->_storeManager->getStore()->getCurrentUrl($fromStore);
    }

    /**
     * Check if store is active
     *
     * @return boolean
     * @throws NoSuchEntityException
     */
    public function isStoreActive()
    {
        return $this->_storeManager->getStore()->isActive();
    }

    public function getConfigValue($field, $storeId = null)
    {
        $storeId = $storeId ?: $this->getStoreId();

        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * get icon image url
     *
     * @param $icon
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImageUrl($icon)
    {
        $mediaUrl = $this->_storeManager
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $mediaUrl . 'productbadge/icon/' . $icon;
        return $imageUrl;
    }

    /**
     * Check if store is active
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->getConfigValue(self::XML_PATH_ENABLED);
    }

    /**
     * getDisplaySetting
     *
     * @return Int|null
     */
    public function getDisplaySetting()
    {
        return $this->getConfigValue(self::XML_PATH_DISPLAY);
    }

    /**
     * getDisplayOnSetting
     *
     * @return Int|null
     */
    public function getDisplayOnSetting()
    {
        return $this->getConfigValue(self::XML_PATH_DISPLAYON);
    }

    public function getProductOptions($code)
    {
        if ($code != '') {
            $options = $this->_productAttributeRepository->get($code)->getOptions();
            $values = [];
            foreach ($options as $option) {
                $values[] = [
                    'value' => $option->getValue(),
                    'label' => $option->getLabel()
                ];
            }

            return $values;
        }

        return [];
    }

    public function getCurrentProduct()
    {
        $product = $this->currentProduct->get();
        return $product ?: false;
    }

    public function getProductById($productId)
    {
        if ($productId > 0) {
            $product = $this->productRepository->getById($productId);

            return $product;
        }

        return false;
    }
}
