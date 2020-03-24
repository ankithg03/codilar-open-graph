<?php


namespace Codilar\OpenGraph\Model;

/**
 * Class Adapter
 *
 * @description SEO
 * @author   Codilar Team Player <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 * @copyright Copyright © 2020 Codilar Technologies Pvt. Ltd.. All rights reserved
 *
 * Adapter for the Complete OG Tag
 */

class Adapter implements AdapterInterface
{
    /**
     * @var array
     */
    private $adapters;
    /**
     * @var PropertyInterface
     */
    private $property;

    /**
     * Adapter constructor.
     * @param PropertyInterface $property
     * @param array $adapters
     */
    public function __construct(
        PropertyInterface $property,
        array $adapters
    ) {
        $this->adapters = $adapters;
        $this->property = $property;
    }

    /**
     * @return PropertyInterface
     */
    public function getProperty()
    {
        foreach ($this->adapters as $item) {
            /** @var AdapterInterface $item */
            $property = $item->getProperty();
            if ($property->hasData()) {
                return $property;
            }
        }
        return $this->property;
    }
}
