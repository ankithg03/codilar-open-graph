<?php

namespace Codilar\OpenGraph\Block;

/**
 * interface SeoBlockInterface
 * @description Extension for Open Graph Tags
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Extension is to Provide OG TAGS
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
