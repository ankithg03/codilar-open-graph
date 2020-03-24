<?php

namespace Codilar\OpenGraph\Model\Adapter;

use Codilar\OpenGraph\Block\OpenGraph;
use Codilar\OpenGraph\Model\AdapterInterface;
use Codilar\OpenGraph\Model\Property;
use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Cms\Model\Page as CmsPage;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\UrlInterface;
use Magento\Theme\Block\Html\Header\Logo;

/**
 * Class Page
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Provides Page Information to Og Tags
 */

class Page implements AdapterInterface
{
    /**
     * @var PropertyInterface
     */
    private $property;
    /**
     * @var CmsPage
     */
    private $page;
    /**
     * @var UrlInterface
     */
    private $url;
    /**
     * @var FilterProvider
     */
    private $filterProvider;
    /**
     * @var Magento\Theme\Block\Html\Header\Logo
     */
    private $logo;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Page constructor.
     * @param CmsPage $page
     * @param UrlInterface $url
     * @param FilterProvider $filterProvider
     * @param PropertyInterface $property
     * @param ScopeConfigInterface $scopeConfig
     * @param Logo $logo
     */
    public function __construct(
        CmsPage $page,
        UrlInterface $url,
        FilterProvider $filterProvider,
        PropertyInterface $property,
        ScopeConfigInterface $scopeConfig,
        Logo $logo
    ) {
        $this->property = $property;
        $this->page = $page;
        $this->url = $url;
        $this->filterProvider = $filterProvider;
        $this->logo = $logo;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return PropertyInterface
     */
    public function getProperty()
    {
        if ($this->page->getId()) {
            $isMetaData = $this->scopeConfig
                ->getValue(OpenGraph::XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE . 'meta_information');
            $metaTitle = $this->page->getMetaTitle();
            $metaDescription = $this->page->getMetaDescription();
            $Description = $this->page->getDescription();
            if ($isMetaData) {
                if (isset($metaTitle)) {
                    $this->property->setTitle((string)$metaTitle);
                } else {
                    $this->property->setTitle((string)$this->page->getTitle());
                }
                if (isset($metaDescription)) {
                    $this->property->setTitle((string)$metaDescription);
                } elseif (isset($Description)) {
                    $this->property->setTitle((string)$Description);
                }
            } else {
                $this->property->setTitle((string)$this->page->getTitle());
                if (isset($Description)) {
                    $this->property->setDescription((string)$Description);
                }
            }
            $this->property->setImage((string)$this->logo->getLogoSrc());
            $this->property->setUrl((string) $this->url->getUrl($this->page->getIdentifier()));
            $this->property->addProperty('item', $this->page->getData(), Property::META_DATA_GROUP);
        }
        return $this->property;
    }
}
