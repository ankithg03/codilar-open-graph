<?php

declare(strict_types=1);

namespace Codilar\OpenGraph\Model;

/**
 * Class Adapter
 *
 * @category SEO
 * @package  Codilar\OpenGraph\Model
 * @author   Codilar ThriveOn Team <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
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
    public function getProperty() : PropertyInterface
    {
        foreach ($this->adapters as $item) {
            /** @var AdapterInterface $item */
            $property = $item->getProperty();
            if ($property->hasData())
            {
                return $property;
            }
        }
        return $this->property;
    }
}