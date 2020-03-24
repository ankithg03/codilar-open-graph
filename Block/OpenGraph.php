<?php


namespace Codilar\OpenGraph\Block;

use Codilar\OpenGraph\Model\Adapter\CustomPage;
use Codilar\OpenGraph\Model\AdapterInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Class OpenGraph
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 * Extension is to Provide OG TAGS
 *
 */

class OpenGraph extends Template implements SeoBlockInterface
{
    const XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE
        = 'seo_open_graph_section/general/';
    const FACEBOOK_APP_ID_FROM_BACKEND_CONFIG
        = 'seo_open_graph_section/general/facebook_app_id';
    /**
     * AdapterInterface Object
     *
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * ScopeConfigInterface Object
     *
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * CustomPage Object
     *
     * @var CustomPage
     */
    private $customPage;

    /**
     * OpenGraph constructor.
     *
     * @param Context              $context     object of the Context Class
     * @param AdapterInterface     $adapter     object of AdapterInterface
     * @param ScopeConfigInterface $scopeConfig object of ScopeConfigInterface
     * @param CustomPage           $customPage  object for accessing the custom pages
     * @param array                $data        object of array
     */
    public function __construct(
        Context $context,
        AdapterInterface $adapter,
        ScopeConfigInterface $scopeConfig,
        CustomPage $customPage,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->adapter = $adapter;
        $this->scopeConfig = $scopeConfig;
        $this->customPage = $customPage;
    }

    /**
     * Method to fetch meta data with it's property of any page
     *
     * @return string
     */
    public function getMetaData()
    {
        $property = $this->adapter->getProperty();
        $openGraph = $property
            ->setPrefix('og:')
            ->setMetaAttributeName('property')
            ->toHtml();

        $productInformation = $property
            ->setMetaAttributeName('property')
            ->toHtml('product');

        return sprintf(
            '%s%s',
            $openGraph,
            $productInformation
        );
    }

    /**
     * Method to fetch meta data with it's property of any Custom pages
     *
     * @return string
     */
    public function getMetaDataForCustomPages()
    {
        $property = $this->customPage->getProperty();
        $openGraph = $property
             ->setPrefix('og:')
             ->setMetaAttributeName('property')
             ->toHtml();

        $productInformation = $property
            ->setMetaAttributeName('property')
            ->toHtml('product');

        return sprintf(
            '%s%s',
            $openGraph,
            $productInformation
        );
    }

    /**
     * Method to check the status of OG Extension
     *
     * @return bool
     */
    public function isOpenGraphModuleEnabled()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        return (
            (bool)$this->scopeConfig->getValue(
                self::XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE . 'core_module_enable',
                $storeScope
            )
        );
    }

    /**
     * @return mixed
     */
    public function getFacebookAppID()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(
            self::FACEBOOK_APP_ID_FROM_BACKEND_CONFIG,
            $storeScope
        );
    }
}
