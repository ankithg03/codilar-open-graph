<?php
declare(strict_types=1);


namespace Codilar\OpenGraph\Model\Adapter;

use Exception;
use Magento\Cms\Model\Page as CmsPage;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\UrlInterface;
use Codilar\OpenGraph\Model\AdapterInterface;
use Codilar\OpenGraph\Model\Property;
use Codilar\OpenGraph\Model\PropertyInterface;
use Magento\Theme\Block\Html\Header\Logo;

/**
 * Class Page
 *
 * @category SEO
 * @package  Codilar\OpenGraph\Model\Adapter
 * @author   Codilar ThriveOn Team <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
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
     * Page constructor.
     * @param CmsPage $page
     * @param UrlInterface $url
     * @param FilterProvider $filterProvider
     * @param PropertyInterface $property
     * @param Logo $logo
     */
    public function __construct(
        CmsPage $page,
        UrlInterface $url,
        FilterProvider $filterProvider,
        PropertyInterface $property,
        Logo $logo
    ) {
        $this->property = $property;
        $this->page = $page;
        $this->url = $url;
        $this->filterProvider = $filterProvider;
        $this->logo = $logo;
    }

    /**
     * @return PropertyInterface
     */
    public function getProperty() : PropertyInterface
    {
        if ($this->page->getId()) {
            $this->property->setTitle((string) $this->page->getTitle());
                if($this->page->getMetaDescription()!=null){
                    $this->property->setDescription(
                        $this->page->getMetaDescription()
                    );
                }
            $this->property->setImage((string)$this->logo->getLogoSrc());
            $this->property->setUrl((string) $this->url->getUrl($this->page->getIdentifier()));
            $this->property->addProperty('item', $this->page->getData(), Property::META_DATA_GROUP);
        }
        return $this->property;
    }
}
