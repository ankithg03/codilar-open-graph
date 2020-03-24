<?php

namespace Codilar\OpenGraph\Model;

/**
 * Interface PropertyInterface
 *
 * @category SEO
 * @package  Codilar\OpenGraph\Api\Data
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 * @api
 */

interface PropertyInterface
{
    /**
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix);

    /**
     * @param string $attributeName
     * @return $this
     */
    public function setMetaAttributeName(string $attributeName);

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title);

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description);

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url);

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image);

    /**
     * @param string $imageAlt
     * @return $this
     */
    public function setImageAlt(string $imageAlt);

    /**
     * @param string $key
     * @param string|array $value
     * @param string $group
     * @return string
     */
    public function addProperty(string $key, $value, string $group = Property::DEFAULT_GROUP);

    /**
     * @param string $key
     * @param string $group
     * @return string
     */
    public function getProperty(string $key, string $group = Property::DEFAULT_GROUP);

    /**
     * @param string $key
     * @param string $group
     * @return $this
     */
    public function removeProperty(string $key, string $group = Property::DEFAULT_GROUP);

    /**
     * @param string $group
     * @return string
     */
    public function toHtml(string $group = Property::DEFAULT_GROUP);

    /**
     * @param string $group
     * @return bool
     */
    public function hasData(string $group = Property::DEFAULT_GROUP);
}
