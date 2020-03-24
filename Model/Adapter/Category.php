<?php

namespace Codilar\OpenGraph\Model\Adapter;

use Codilar\OpenGraph\Block\OpenGraph;
use Codilar\OpenGraph\Model\AdapterInterface;
use Codilar\OpenGraph\Model\CommonFactors;
use Codilar\OpenGraph\Model\Property;
use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Catalog\Model\Category as MagentoCategoryModel;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Category
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Which Provides Category Information to Og Tags
 */

class Category implements AdapterInterface
{
    /**
     * @var array
     */
    private $messageAttributes = [
        'meta_description',
        'description'
    ];
    /**
     * @var PropertyInterface
     */
    private $property;
    /**
     * @var Resolver
     */
    private $category;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var CommonFactors
     */
    private $commonFactors;

    /**
     * Category constructor.
     *
     * @param PropertyInterface $property
     * @param ScopeConfigInterface $scopeConfig
     * @param CommonFactors $commonFactors
     * @param Resolver $category
     */
    public function __construct(
        PropertyInterface $property,
        ScopeConfigInterface $scopeConfig,
        CommonFactors $commonFactors,
        Resolver $category
    ) {
        $this->property = $property;
        $this->category = $category;
        $this->scopeConfig = $scopeConfig;
        $this->commonFactors = $commonFactors;
    }

    /**
     * @return PropertyInterface
     * @throws LocalizedException
     */
    public function getProperty()
    {
        /**
         * @var $category MagentoCategoryModel
         */
        $category =$this->category->get()->getCurrentCategory();
        if ($category->getData("url_path")!=null) {
            $isMetaData = $this->scopeConfig
                ->getValue(OpenGraph::XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE . 'meta_information');
            if ($isMetaData) {
                if ($category->getMetaTitle()!=null) {
                    $this->property->setTitle((string) $category->getMetaTitle());
                }
                if ($category->getMetaDescription()!=null) {
                    $this->property->setDescription((string) $category->getMetaDescription());
                }
            } else {
                $this->property->setTitle((string) $category->getName());
                if ($category->getDescription()!=null) {
                    $this->property->setDescription((string) $category->getDescription());
                }
            }
            $this->property->setUrl((string) $category->getUrl());
            if ($category->getImageUrl()) {
                $this->property->setImage((string) $category->getImageUrl());
            } else {
                $this->property->setImage((string)$this->commonFactors->getPlaceholder());
            }
            $this->property
                ->addProperty(
                    'item',
                    $category->getData(),
                    Property::META_DATA_GROUP
                );
        }
        return $this->property;
    }
}
