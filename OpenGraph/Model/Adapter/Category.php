<?php

declare(strict_types=1);

namespace Codilar\OpenGraph\Model\Adapter;

use Amasty\Shopby\Helper\Category as AmastyCategoryHelper;
use Codilar\OpenGraph\Model\AdapterInterface;
use Codilar\OpenGraph\Model\BlockParser;
use Codilar\OpenGraph\Model\Property;
use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Catalog\Model\Category as MagentoCategoryModel;
use Magento\Framework\Exception\LocalizedException;

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
     * @var BlockParser
     */
    private $blockParser;
    /**
     * @var AmastyCategoryHelper
     */
    private $category;

    /**
     * Category constructor.
     *
     * @param PropertyInterface    $property
     * @param BlockParser          $blockParser
     * @param AmastyCategoryHelper $category
     */
    public function __construct(
        PropertyInterface $property,
        BlockParser $blockParser,
        AmastyCategoryHelper $category
    ) {
        $this->property = $property;
        $this->blockParser = $blockParser;
        $this->category = $category;
    }

    /**
     * @return PropertyInterface
     * @throws LocalizedException
     */
    public function getProperty() : PropertyInterface
    {
        /**
         * @var $category MagentoCategoryModel
         */
        $category =$this->category->getLayer()->getCurrentCategory();
        if ($category->getData("url_path")!=null) {
            $this->property->setTitle((string) $category->getName());
            $this->property->setUrl((string) $category->getUrl());
            if ($category->getMetaDescription()!=null) {
                $this->property->setDescription((string) $category->getMetaDescription());
            }
            if ($category->getImageUrl()) {
                $this->property->setImage((string) $category->getImageUrl());
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
