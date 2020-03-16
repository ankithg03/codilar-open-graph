<?php

declare(strict_types=1);

namespace Codilar\OpenGraph\Block;
/**
 * Interface SeoBlockInterface
 *
 * @category SEO
 * @package  Codilar\OpenGraph\Block
 * @author   Codilar ThriveOn Team <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 */
interface SeoBlockInterface
{
    /**
     * Method to fetch meta data with it's property of any page
     *
     * @return string
     */
    public function getMetaData();
}
