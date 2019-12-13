<?php
declare(strict_types=1);


namespace Codilar\OpenGraph\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Config
 * @package Codilar\OpenGraph\Model
 */
class Config
{
    const XML_PATH_OpenGraph_GOOGLE_SITE_VERIFICATION_CODE = 'OpenGraph/verifications/google';
    const XML_PATH_OpenGraph_BING_SITE_VERIFICATION_CODE = 'OpenGraph/verifications/bing';
    const XML_PATH_OpenGraph_PINTEREST_SITE_VERIFICATION_CODE = 'OpenGraph/verifications/pinterest';
    const XML_PATH_OpenGraph_YANDEX_SITE_VERIFICATION_CODE = 'OpenGraph/verifications/yandex';
    const XML_PATH_OpenGraph_TWITTER_DEFAULT_TYPE = 'OpenGraph/twitter_card/type';
    const XML_PATH_OpenGraph_TWITTER_DEFAULT_SITE = 'OpenGraph/twitter_card/site';
    const XML_PATH_OpenGraph_TWITTER_DEFAULT_CREATOR = 'OpenGraph/twitter_card/creator';
    const XML_PATH_ROBOTS_CONTENT = 'OpenGraph/robots/content';
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getGoogleSiteVerificationCode(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_GOOGLE_SITE_VERIFICATION_CODE);
    }

    public function getBingSiteVerificationCode(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_BING_SITE_VERIFICATION_CODE);
    }

    public function getPinterestSiteVerificationCode(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_PINTEREST_SITE_VERIFICATION_CODE);
    }

    public function getYandexSiteVerificationCode(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_YANDEX_SITE_VERIFICATION_CODE);
    }

    public function getDefaultTwitterCardType(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_TWITTER_DEFAULT_TYPE);
    }

    public function getDefaultTwitterCardSite(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_TWITTER_DEFAULT_SITE);
    }

    public function getDefaultTwitterCardCreator(): string
    {
        return $this->getConfigValue(self::XML_PATH_OpenGraph_TWITTER_DEFAULT_CREATOR);
    }

    public function getRobotsContent(): string
    {
        return $this->getConfigValue(self::XML_PATH_ROBOTS_CONTENT);
    }

    public function isActive(string $configPath): bool
    {
        return $this->scopeConfig->isSetFlag(
            $configPath,
            ScopeInterface::SCOPE_STORE
        );
    }

    private function getConfigValue(string $configPath) : string
    {
        $result = $this->scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE
        );
        return $result ?? '';
    }
}
