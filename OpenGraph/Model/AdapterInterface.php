<?php

declare(strict_types=1);

namespace Codilar\OpenGraph\Model;

/**
 * Interface AdapterInterface
 *
 * @category SEO
 * @package  Codilar\OpenGraph\Model
 * @author   Codilar ThriveOn Team <ankith@codilar.com>
 * @license  Open Source
 * @link     https://github.com/ankithg03/codilar-open-graph
 */
interface AdapterInterface
{
    /**
     * Method to Get the Property of Og Meta Tag
     *
     * @return \Codilar\OpenGraph\Model\Property
     */
    public function getProperty();
}
