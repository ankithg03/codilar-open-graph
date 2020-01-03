<?php
declare(strict_types=1);

namespace Codilar\OpenGraph\Model;
/**
 * Class Adapter
 * @package Codilar\OpenGraph\Model
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
