<?php
declare(strict_types=1);


namespace Codilar\OpenGraph\Block;

use Magento\Framework\View\Element\Template;
use Codilar\OpenGraph\Model\AdapterInterface;

class OpenGraph extends Template implements SeoBlockInterface
{
    const XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE_ENABLE = 'seo_open_graph_section/general/core_module_enable';
    /**
     * @var AdapterInterface
     */
    private $adapter;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * OpenGraph constructor.
     * @param Template\Context $context
     * @param AdapterInterface $adapter
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        AdapterInterface $adapter,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->adapter = $adapter;
        $this->scopeConfig = $scopeConfig;
    }

    /**
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
    public function isOpenGraphModuleEnabled(){
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return ((bool)$this->scopeConfig->getValue(self::XML_PATH_FOR_SEO_OPEN_GRAPH_MODULE_ENABLE, $storeScope));
    }
}
